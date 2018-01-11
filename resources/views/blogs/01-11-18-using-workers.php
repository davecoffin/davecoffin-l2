<div>

    <p>I hate worrying about performance. It's the least fun part of development. It's hard enough writing code that works, are we really expected to make it work well on all devices? </p>
</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://media.giphy.com/media/Fjr6v88OPk7U4/giphy.gif" style="width: 80%; max-width: 300px;" /></div>

<div>
    <p>In my app Daily Nanny, there's a feature that allows nannies and parents to manage the nanny's hours. In one of the views, it lists all their shifts in history, and I do some pretty complex data operations before I display the array: </p>

</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://cl.ly/omHC/Screen%20Shot%202018-01-11%20at%208.33.52%20AM.png" style="width: 80%; max-width: 500px;" /></div>

<div>
    <p>I use <a href="https://momentjs.com/" target="_blank">moment.js</a> to do some date related operations, like figuring out how long the shift was in minutes and hours based on a Date object for start time and end time, then do a bunch of math to calculate the amount earned based on their hourly rate, if any overtime pay should be applied, assemble shifts into weeks with a header including aggregate data, all based on an array of simple shift objects I get back from my API.</p>

    <p>Over time, nannies are building up their history of shifts, some having almost a year of data, so hundreds of shifts. Doing this math for every record takes up time. When you execute complex data operations like this in NativeScript, by default it's run on the same thread as the UI. This means that while the device is doing these complex JavaScript operations, your UI is "frozen".</p>
</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://media.giphy.com/media/23BST5FQOc8k8/giphy.gif" style="width: 80%; max-width: 300px;" /></div>

<div>
    <p>In my tests, this could take up to 10 seconds in the most extreme cases! Totally unacceptable. Enter <a href="https://docs.nativescript.org/core-concepts/multithreading-model" target="_blank">Workers</a>. A worker executes on an isolated background thread, allowing the UI to render uninhibited by complex JavaScript operations.</p>

    <p>There's plenty of documentation on workers, but I found none of it went beyond the most basic example, so I'm writing this to provide a little more context. Let's get into the code.</p>
</div>

<div>
    <h2>Creating a Worker</h2>

    <p>Create a folder in your <code>app</code> folder called <code>workers</code> (or whatever you want), and create a file for your operation. In my case, I am processing shifts, so I called it <code>process-shifts.js</code>. In that file, throw this code in there:</p>

<xmp style="width: 100%; overflow: auto;">// process-shifts.js
require('globals');
global.onmessage = function(workerMsg) {
    var request = workerMsg.data;
    console.dir(request);
}
</xmp>
    <p>require('globals') is necessary to get this working on a new thread. Then <code>global.onmessage</code> is what <i>receives</i> a message from your main thread. The terminology here is that the threads are communicating with each other through "messages". I find it helpful to think of it like a Promise. You do something, and when that thing is done, your code continues executing in the <code>.then</code> method. In the context of Workers, <code>postMessage</code> is like calling resolve() in a Promise.</p>

<xmp style="width: 100%; overflow: auto;">// process-shifts.js
require('globals');
global.onmessage = function(workerMsg) {
    var request = workerMsg.data;
    var shifts = request.shifts;
    console.dir(request);

    var sectonedShifts = processData();

    var responseMsg = {
        success: true,
        sectionedShifts: sectonedShifts
    }
    global.postMessage(responseMsg)
}

function processData(shifts) {
    // do all the complicated work here.
    return shifts;
}
</xmp>

    <p>So that receives data from your main thread in the message. In the above code, workerMsg.data contains the data you send to the worker from the main thread. Then it sends a message back to the main thread with postMessage. So let's look at how to call this from the main thread:</p>

<xmp style="width: 100%; overflow: auto;">// shifts-view-model.js
function processAllShifts(shifts) {
    var worker = new Worker('~/workers/process-shifts');
    worker.postMessage({ 
        shifts: shifts
    });
    worker.onmessage = function(msg) {
        if (msg.data) {
            var resp = msg.data.response;
            var sectionedShifts = resp.sectionedShifts;
            // here is where i update my UI with the response from the worker, like set my Observable Array to the sectionedShifts returned from the worker.
            worker.terminate();
        }
    }
    worker.onerror = function(err) {
        console.log(`An unhandled error occurred in worker: ${err.filename}, line: ${err.lineno} :`);
        console.log(err.message);
    }
}

</xmp>

    <p>I'm using the worker to do the heavy lifting, and it returns an array with all the data that I need, then I just set the Observable Array that's the source for my ListView to the response from the worker.</p>

    <p>When the heavy lifting is done, kill the background process using worker.terminate()</p>
</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://media.giphy.com/media/7TtvTUMm9mp20/giphy.gif" style="width: 80%; max-width: 300px;" /></div>

<div>
    <p>This approach is crucial for apps that do some computationally complex operations. It's not always necessary, but don't be afraid to employ workers. In my case, when developing the app I didn't really experience any lag because I wasn't yet working with a large data set. But since my app has a bunch of users now generating a bunch of data, it's more important to think about what operations may slow down the UI as the app scales.</p>
</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://media.giphy.com/media/jaSDPkXTgX7ws/giphy.gif" style="width: 80%; max-width: 300px;" /></div>

<div>

    <p>Reach out to me with any questions/comments, and thanks for reading!</p>
</div>



<style type="text/css">
xmp {
    font-size: 13px;
    background-color: #333;
    color: white;
    padding: 10px;
    border-radius: 10px;
    width: 100%; 
    overflow: auto;
}
</style>

<br /><br /><br />