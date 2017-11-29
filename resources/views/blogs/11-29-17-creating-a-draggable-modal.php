<div>
    <!-- <p class="blognote">My daughter is turning 4 next week and we are hosting a unicorn party this weekend, hence my inspirational header image.</p> -->

    <p>Remember when Steve Jobs insisted that <a href="http://www.businessinsider.com/steve-jobs-was-wrong-about-big-phones-2014-9" target="_blank">big phones are stupid</a>? The iPhone 5 was designed to be as big as possible while still allowing a user's finger to touch controls anywhere on the screen. I totally agreed with that, and sort of still do, but when I hold an iPhone 5 it feels like a sad little baby phone. In fact my next phone will probably be a plus model.</p>

    <p>While I've embraced big phones for their media consumption gusto, I still drop my phone on my face in bed often, reaching for that effing done button. Or have to shimmy the phone down my one handed grip to tap some control in the nav bar while my other hand holds my iced coffee.</p>

</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://media.giphy.com/media/hOWlbO2YFVobK/giphy.gif" style="width: 80%; max-width: 500px;" /></div>

<div>

    <p>That's why I love it when devs keep all that in mind when designing their interfaces. Apple to some degree has dealt with this problem by making the slide to the right the defacto gesture for going back, you don't have to reach up to the Navigation Bar to go back a page. They also introduced <a href="https://9to5mac.com/2014/09/09/a-look-at-apples-reachability-one-hand-mode-for-larger-iphone-6-video/" target="_blank">Reachability</a>, which seemed like a really dumb concept but I use it daily.</p>

    <p>One of my favorite examples of an app caring about people dropping their phone on their nose is in Overcast. When you view the podcast you are listening to, you can drag down from any area, and it collapses. I wanted to created this in one of my apps, so I set out to do it.</p>

    <p>Most of you will find yourselves in a situation where you want to show some information in a modal. You can use the native modals for this, and <a href="https://docs.nativescript.org/angular/code-samples/modal-page" target="_blank">NativeScript has a super easy way to get this running cross platform</a>. But I'm not a huge fan of those, they take you out of context a bit, they're not easily dismissable, and you need to implement a communication method between the modal view and your parent view that just adds a bit of overhead you may not want to deal with.</p>

    <p>So I created my own "modal", really just a layout that sits on top of my main content, but is hidden by default, and I show it when necessary. I wanted to animate it in, give a control to close it that animates it out, and let the user drag it down to dismiss it.</p>
    
    <p>Here's what I came up with:</p>
    <center>
        <blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr"><a href="https://twitter.com/NativeScript?ref_src=twsrc%5Etfw">@NativeScript</a> <a href="https://twitter.com/jenlooper?ref_src=twsrc%5Etfw">@jenlooper</a> <a href="https://twitter.com/BradWayneMartin?ref_src=twsrc%5Etfw">@BradWayneMartin</a> My new favorite mobile paradigm, drag and drop to dismiss. Hate reaching to tap Done <a href="https://twitter.com/hashtag/nativescript?src=hash&amp;ref_src=twsrc%5Etfw">#nativescript</a> <a href="https://t.co/Qhbv1qu9Li">pic.twitter.com/Qhbv1qu9Li</a></p>&mdash; Dave Coffin (@davecoffin) <a href="https://twitter.com/davecoffin/status/887710588129988609?ref_src=twsrc%5Etfw">July 19, 2017</a></blockquote>
        <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
    </center>

    <p>There's a lot going on there behind the scenes, but it works. But recently I got sick of recreating this logic all over my app, so I took the time to separate it out into a helper function that I can call easily from anywhere, I just need to setup the UI elements, and call a <code>show</code> method.</p>

    <p class="blognote">My insecurity just informed me that I need to include a disclaimer here: There are probably better ways to do this. But I threw it together in the way I knew how, and it may evolve over time. Use what you find useful.</p>

    <h2>The UI Elements</h2>

<xmp style="width: 100%; overflow: auto;"><GridLayout [visibility]="showingCreateTicket ? 'visible' : 'collapsed'" style="z-index: 99;" >
    <GridLayout #createTicketDimmer></GridLayout>
    <Label text="DROP TO DISMISS" class="dismiss_note" #dismissNote opacity="0" verticalAlignment="top"></Label>
    <StackLayout row="1" col="1" class="mypOverlay" #createTicketContainer>
        <GridLayout rows="50" columns="50, *, 50" id="mypOverlayHeader">
            <Image [src]="themeImg" height="100%" colSpan="3" stretch="aspectFill" style="height: 100%; border-radius: 10 10 0 0;"></Image>
            <Label text="Create Support Ticket" verticalAlignment="middle" col="1" class="title"></Label>
            <Button class="fa" text="&#xf078;" col="2" id="closeMypOverlayButton" style="color: white; width: 50;" horizontalAlignment="right"></Button>
        </GridLayout>
        <StackLayout id="mypOverlayContent">
            <ScrollView #mypOverlayScroller [visibility]="loadingTicket ? 'collapsed' : 'visible'">
                <StackLayout class="inputGroups" paddingTop="20">
                    <Label class="label" text="Enter a brief description of your problem."></Label>
                    <TextField hint="Subject..." [(ngModel)]="subject" #subjectField marginBottom="15"></TextField>
                    // more form fields go here...
                    <Button class="addBtn" text="Submit" (tap)="submitTicket()" marginBottom="30"></Button>
                </StackLayout>
            </ScrollView>
        </StackLayout>
    </StackLayout>
</GridLayout>
</xmp>

    <p>The code above are the layout elements for the modal I'm going to display. Some CSS accompanies it to add some rounded corners, margin, padding etc, but this can look like anything. I'm going to focus more on the gesture logic here than the UI, but there are some important pieces of the puzzle here.</p>

    <p>For this approach, the GridLayout needs to be somewhere in the UI where it sits on top of your page content. A good thing to do is to build the UI without hiding it at first so you can quickly spin up a nice looking view, then hide it using a property in your binding context, in this case <code>showingCreateTicket</code>.</p>

    <p>The notable pieces of this UI are the dimmer (<code>#createTicketDimmer</code>), the container (<code>#createTicketContainer</code>), the header (<code>id="mypOverlayHeader"</code>), the close button (<code>id="closeMypOverlayButton"</code>), the main content section (<code>id="mypOverlayContent"</code>), and the dissmiss note (<code>#dismissNote</code>).<p>

    <br /><br />
    <h3>The Container</h3>
    <p>The container is the element that should animate when opened, closed, and dragged. It contains the header and the main content. I'm using angular so I added the angular way of targeting UI elements in your view and access it using @ViewChild.</p>

    <code>@ViewChild("createTicketContainer") createTicketContainer: ElementRef;</code>

    <br /><br />
    <h3>The Dimmer</h3>
    <p>This is an element that sits underneath the container and dims the content behind it. In this case I am using the <a href="https://www.npmjs.com/package/nativescript-blur" target="_blank">nativescript-blur plugin</a>, made by yours truly, to blur the background on iOS and darken it on android. I also use @ViewChild to grab it in my TypeScript file.</p>

    <br /><br />
    <h3>The Dismiss Note</h3>
    <p>This is simply a Label that will show when the user has dragged the overlay down an appropriate amount, indicating that if they remove their finger, the overlay will close.</p>

</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://cl.ly/nzx9/Screen%20Shot%202017-11-29%20at%2011.31.43%20AM.png" style="width: 80%; max-width: 300px;" /></div>

<div>

    <br /><br />
    <h3>The Header</h3>
    <p>This is a GridLayout, given a specific ID (mypOverlayHeader), and its the header for the modal, containing a title and a close button. I use an ID here, which I will explain in a minute.</p>

    <br /><br />
    <h3>The Content</h3>
    <p>This is a StackLayout containing the content of my modal. In this case its a ScrollView containing some form data. I identify it with @ViewChild, I'll explain why soon.</p>

    <br /><br />
    <h3>The Close Button</h3>
    <p>This is a button that closes the modal. If you are Andre the Giant from The Princess Bride, you may be able to easily tap it, and maybe you prefer to dragging down. All these things are possible. I use an ID for it, you'll find out why soon.</p>

    <br /><br /><br />

    <p>Ok, I've outlined the necessary UI components, now lets see how they all work together.</p>

    <h3>The general approach</h3>
    <p>I've got a helpers file that contains some simple helper functions I use throughout my app. Eventually I hope to make this into a plugin, but for now the logic is stored in helpers.ts.</p>

    <p>From my parent view, I call a function that accepts some arguments and shows the modal, and the helper function handles the panning gestures, the close button, the drop to dismiss note, and callback for when its shown and closed. Here is the interface for the arguments:</p>

<xmp style="width: 100%; overflow: auto;">export interface mypOverlayArgs {
    container: StackLayout,
    dimmer: GridLayout,
    dimmerTitle: string, // this is necessary for the blur plugin.
    dismissNote: Label,
    scrollView?: ScrollView, // if theres a scrollview in your content, you need to include it a reference to it here.
    shownCallback?: Function,
    closeCallback?: Function
}</xmp>

    <p>And heres my show function:</p>

<xmp style="width: 100%; overflow: auto;">var readyToDrop = false;
var dropping = false;
let blur = new Blur();
let buzz: any = false;
if (platformModule.isIOS && !(parseFloat(platformModule.device.osVersion) < 10)) buzz = UISelectionFeedbackGenerator.new();
let shownOverlayArgs: mypOverlayArgs;
export function showMypOverlay(args: mypOverlayArgs) {
    shownOverlayArgs = args;
    if (!platformModule.isIOS) {
        android.on(AndroidApplication.activityBackPressedEvent, (data: AndroidActivityBackPressedEventData) => {
            data.cancel = true;
            if (shownOverlayArgs.closeCallback) shownOverlayArgs.closeCallback();
        });
    }
    blur.on(shownOverlayArgs.dimmer, shownOverlayArgs.dimmerTitle);
    let deviceHeight = platformModule.screen.mainScreen.heightDIPs;
    shownOverlayArgs.container.translateY = deviceHeight + 30;
    shownOverlayArgs.container.animate({
        translate: {x: 0, y: 0},
        duration: 400,
        curve: AnimationCurve.cubicBezier(0.1, 0.1, 0.1, 1)
    }).then(() => {
        if (shownOverlayArgs.shownCallback) shownOverlayArgs.shownCallback();
    })

    shownOverlayArgs.container.getViewById('closeMypOverlayButton').on('tap', () => closeMypOverlay());
    shownOverlayArgs.container.getViewById('mypOverlayHeader').on('pan', (event) => panMypOverlay(event));
    shownOverlayArgs.container.getViewById('mypOverlayContent').on('pan', (event) => panMypOverlay(event));
}</xmp>


    <ul>
        <li>First I save the args so I can use them in my pan and close functions. 
        <li>Then I do something cool where if the user is on Android and they tap the back button, it will close the overlay. 
        <li>Then I blur (or dim) the background (the plugin animates this). 
        <li>Then I place the overlay below the view, so I can animate it such that it slides into view from the bottom. 
        <li>Then I do exactly that and call the shownCallback after if its included in the arguments, and I set up the tap and pan events for the elements in the overlay.
    </ul>

    <p>And then, all the @ViewChild's I set up above come into play when I actually want to show the overlay. Here's how I call showMypOverlay:</p>

<xmp style="width: 100%; overflow: auto;">let args: helpers.mypOverlayArgs = {
    container: this.createTicketContainer.nativeElement,
    dimmer: this.createTicketDimmer.nativeElement,
    dimmerTitle: 'createTicketDimmer',
    dismissNote: this.dismissNote.nativeElement,
    scrollView: this.mypOverlayScroller.nativeElement,
    closeCallback: () => {
        this.zone.run(() => {
            this.showingCreateTicket = false;
        })
    },
    shownCallback: () => {
        this.zone.run(() => {
            console.log('overlay shown');
        })
    }
};

helpers.showMypOverlay(args);
</xmp>


    <p>That passes the elements the function needs to handle all the overlay interactions.</p>

    <p>Pretty straightforward! Now lets look at the close function:</p>

<xmp style="width: 100%; overflow: auto;">export function closeMypOverlay() {
    if (!platformModule.isIOS) android.off(AndroidApplication.activityBackPressedEvent);
    if (shownOverlayArgs.container) {
        blur.off(shownOverlayArgs.dimmerTitle).catch(() => {
            // its not blurry.
        });
        dropping = true;
        shownOverlayArgs.container.animate({
            translate: {x: 0, y: platformModule.screen.mainScreen.heightDIPs},
            duration: 400,
            curve: AnimationCurve.cubicBezier(0.1, 0.1, 0.1, 1)
        }).then(() => {
            dropping = false;
            readyToDrop = false;
            if (shownOverlayArgs.closeCallback) shownOverlayArgs.closeCallback();
            delete shownOverlayArgs.container;
        })
    }
}</xmp>

    <ul>
        <li>So first I remove the back pressed event handler for android so it returns to its native behavior. 
        <li>Then I make sure that theres a container saved, if not theres no overlay shown.
        <li>Then I turn off the blur (or un dim).
        <li>Then I set a global variable of <code>dropping</code> to true, to indicate that the overlay is currently being animated off the screen.
        <li>Then I animate the overlay down the height of the device, which animates it off the screen.
        <li>Then I handle my booleans, I'll go over <code>readyToDrop</code> in a minute.
        <li>Then I call the close callback if there is one.
        <li>Then I remove the container from my saved arguments so this logic isnt executed if theres no container in view.
    </ul>

    <p>You'll notice the close button in the UI (<code>id="closeMypOverlayButton"</code>) calls this function, so right now we have a modal overlay that looks good, animates in, animates out, and displays a dimmer underneath it. That's pretty good, but the whole point here was to be able to drag it out of view. Let's take a look at that logic. This is a long function, so I'm going to break it up and comment in between.</p>

<xmp style="width: 100%; overflow: auto;">export function panMypOverlay(event) {
    let scrollerDragPosition = 0;
    if (shownOverlayArgs.scrollView) scrollerDragPosition = (shownOverlayArgs.scrollView.verticalOffset*-1) + shownOverlayArgs.scrollView.verticalOffset*-1.5;
</xmp>
    <p>The reason I need the ScrollView Element is because I am watching the pan gesture on the overall container. So that gesture will return values regardless of if the scroll view is scrolled down at all. The problem this creates is you could be at the end of your scroll view, trying to scroll back up to the top, and that pan gesture would drag the overlay down. We dont want the overlay to drag down until the scrollview inside it is scrolled all the way to the top. So if there is a scroll view in the content, I set the drag position. On iOS, the scrollview's vertical offset becomes negative when the user engages the elastic behavior of scrollviews, so we turn that number positive, and multiply it by a little, because the nature of the elasticity is such that the scrollview wont pull down as far as your finger goes, giving the impression that there is resistance at the top. So the variable scrollerDragPosition is the position that the container should drag down to, which is 50% more than the position the scrollview drags down to.</p>

<xmp style="width: 100%; overflow: auto;">
    if (event.object.id == 'mypOverlayHeader' && event.deltaY >= 0 && !dropping) {
        shownOverlayArgs.container.translateY = event.deltaY;
</xmp>

    <p>This if clause evaluates a few difference scenarios. The first one above is if the user is dragging the header. The reason this is important is because we want the user to able to drag the overlay down and out of view even if the scrollview is at a position other than all the way at the top (<code>scrollView.verticalOffset <= 0</code>). So if they are dragging the header, they are dragging down (<code>event.deltaY >= 0</code>), and the overlay isnt currently dropping, then translate the overlay to wherever the user's finger is. In other words, the user is straight up dragging the overlay down, it responds exactly to the user's finger movements.</p>

<xmp style="width: 100%; overflow: auto;">
    } else if (shownOverlayArgs.scrollView && shownOverlayArgs.scrollView.verticalOffset < 0 && event.deltaY >= 0 && !dropping) {
        shownOverlayArgs.container.translateY = scrollerDragPosition;
</xmp>

    <p>In this case, a ScrollView does exist, and the verticalOffset is less than 0 (meaning the user is engaging the elasitic behavior), the user is pulling down, and the overlay is not currently dropping. In other words, they've scrolled all the way up in the ScrollView, so we need to drag the overlay down. The reason we need to use scrollerDragPosition here is because if we use deltaY on the pan geseture event, the overlay will JUMP down once the scrollview reaches the top. This isnt a problem if the user is at the top when they engage the pan gesture, but imagine the user is a little bit down the scrollview. They scroll up, engaging the pan gesture. The pan gesture's deltaY value starts at 0, but is at 22 by the time the scrollview's verticalOffset gets to 0, so the overlay will JUMP down to 22. Using the scrollerDragPosition, it uses the negative value of the verticalOffset, so the overlay will mostly follow your finger.</p>

<xmp style="width: 100%; overflow: auto;">
    } else if (shownOverlayArgs.scrollView && shownOverlayArgs.scrollView.scrollableHeight == 0 && event.deltaY >= 0 && !dropping) {
        shownOverlayArgs.container.translateY = event.deltaY;
</xmp>

    <p>In this case, there is a scrollview, but the content inside it is shorter than the view itself, so the scrollview doesnt scroll! We use scrollableHeight to check that. So this case is similar to as if there were no scrollview at all.</p>

<xmp style="width: 100%; overflow: auto;">
    } else if (!shownOverlayArgs.scrollView && event.deltaY >= 0 && !dropping) {
        shownOverlayArgs.container.translateY = event.deltaY;
    }
</xmp>

    <p>And finally, if theres no scrollview, the overlay just follows the user's finger, as long as its moving downward (deltaY is greater than or equal to 0.)</p>


    <p>This next fairly large block of code handles the drop to dismiss note. If scrollerDragPosition is greater than 0, we need to watch that value to know when its appropriate to drop the overlay. If not, it means there is no scrollview or its content doesnt scroll, so we need to watch the pan gesture's deltaY value.</p>

    <p>I haven't mentioned <code>buzz</code> yet, this is a simple fun little addition. Once the user drags the overlay down past the point where it will dismiss if they let go, it vibrates a little bit as an extra indicator. Only on iOS though (Brad Martin rolls his eyes).</p>

    <p>Also in this block of code we toggle the readyToDrop boolean, which we will evaluate in the next block.</p>

<xmp style="width: 100%; overflow: auto;">
    // handle the drop to dismiss note
    if (scrollerDragPosition > 0) {
        if (scrollerDragPosition > 150) {
            readyToDrop = true;
            if (shownOverlayArgs.dismissNote.opacity == 0) {
                if (buzz) buzz.selectionChanged();
                shownOverlayArgs.dismissNote.animate({
                    opacity: 1,
                    duration: 50
                })
            }    
        } else {
            readyToDrop = false;
            if (shownOverlayArgs.dismissNote.opacity == 1) {
                shownOverlayArgs.dismissNote.animate({
                    opacity: 0,
                    duration: 50
                })
            }
        }
    } else {
        if (event.deltaY > 150) {
            readyToDrop = true;
            if (shownOverlayArgs.dismissNote.opacity == 0) {
                if (buzz) buzz.selectionChanged();
                shownOverlayArgs.dismissNote.animate({
                    opacity: 1,
                    duration: 50
                })
            }    
        } else {
            readyToDrop = false;
            if (shownOverlayArgs.dismissNote.opacity == 1) {
                shownOverlayArgs.dismissNote.animate({
                    opacity: 0,
                    duration: 50
                })
            }
        }
    }
</xmp>

    <p>The pan gesture comes with a state property that gives you clues into what is happening. A state of 3 means they lifted their finger off the screen. That's useful to know! So we set readyToDrop to true if they dragged it down more than 150 points, and set it to false if they didn't. So, if readyToDrop is false and they let go, we animate it back up to the top. If its true and they let go, we drop that sucker. Hide the Drop To Dismiss note, call the close function (see above), and celebrate.</p>

<xmp style="width: 100%; overflow: auto;">
    if (event.state == 3 && !readyToDrop) {
        shownOverlayArgs.container.animate({
            translate: {x: 0, y: 0},
            duration: 300,
            curve: AnimationCurve.cubicBezier(0.1, 0.1, 0.1, 1)
        })
    } else if (event.state == 3) {
        dropping = true;
        shownOverlayArgs.dismissNote.animate({
            opacity: 0,
            duration: 50
        })
        closeMypOverlay()
    }
}
</xmp>

    <p>That's pretty much it! There's more logic in my parent view, for example in the close callback I am doing a few clean up things like toggling the boolean that hides the whole GridLayout etc. The nice thing about this approach to is I can call the close function from my view as well, so in this case when they submit the form, I show a spinner and then close the overlay programmatically once the http request comes back. So I just call helpers.mypCloseOverlay(), and it already has my close callback saved from when I showed it.</p>

    <p>Here it is in all its glory:</p>

    <video src="/images/draggablemodal.mp4" autoplay="true" loop="true" width="400"></video><br /><br />
    <p>Here's the whole function:</p>
    <script src="https://gist.github.com/davecoffin/32f5918e1e991feae343b49b4cceea93.js"></script>

    <p>As always, I am open to suggestions, questions, whatever. Hit me up on the {N} slack channel, <a href="mailto:dave@davecoffin.com">email me</a>, <a href="https://twitter.com/davecoffin" target="_blank">tweet at me</a>, or comment below.</p>
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