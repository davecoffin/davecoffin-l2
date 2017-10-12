<div>
    <p>As you all have heard by now, the 10th anniversary iPhone is coming out soon. It's called the iPhone X, and it has a controversial new design element they are calling the "notch." I personally think it looks ridiculous and is a horrible design decision, but as responsible devs we are tasked with handling it in the way that Apple recommends.</p>
</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://d3vv6lp55qjaqc.cloudfront.net/items/0H2b3B2a212M1s0f1Q1H/Image%202017-09-25%20at%2011.51.24%20AM.png?X-CloudApp-Visitor-Id=196928" style="width: 80%; max-width: 300px;" /></div>

<div>
    <p>Apple is <a href="http://bgr.com/2017/09/14/iphone-x-features-face-id-notch/" target="_blank">claiming this is a full screen device</a>. And they are asking devs to <a href="https://developer.apple.com/ios/human-interface-guidelines/overview/iphone-x/" target="_blank">pretend its a full screen device</a>.</p>
    <blockquote style="border-left: 2px solid #0088cc; margin: 20px; padding: 10px;">
        Don't mask or call special attention to key display features. Don't attempt to hide the device's rounded corners, sensor housing, or indicator for accessing the Home screen by placing black bars at the top and bottom of the screen. Don't use visual adornments like brackets, bezels, shapes, or instructional text to call special attention to these areas either.
    </blockquote>
    
</div>
<div style="text-align: center; margin: 50px 0px;"><img src="https://d3vv6lp55qjaqc.cloudfront.net/items/3Z3a2e2o0G3V0y0T070p/iphone-x-hiding-the-notch_720.jpg" style="width: 80%; max-width: 600px;" /></div>

<div>
    <p>I am a NativeScript developer. NativeScript is a framework that allows you to use your web dev skills to make cross platform apps. Its incredibly powerful. So the rest of this article will be about my experience loading my NativeScript app into the iPhone X Simulator for the first time.</p>

    <p>The iPhone X is basically the first mainstream non-square mobile UI available for mobile phone app developers. From a NativeScript perspective, at least right now, it requires a lot of UI massaging for this specific device.</p>

    <p>To deal with the "notch" appropriately, you need to embed it in your application wherever possible. If you use the standardized <code>ActionBar</code> in all your apps, this may not be a huge problem for you. If you use some custom navigation controls, you have some work ahead of you. Here's an example of how I have a custom ActionBar in one of my apps:</p>

    <xmp style="width: 100%; overflow: auto;">
<GridLayout #navbar id="navbar" rows="auto, 35" columns="100, *, 100" top="0" left="0" style="color: white; background-color: rgba(0,0,0,0.3);">
    <StackLayout orientation="horizontal" row="1" (tap)="goback()" marginLeft="5">
        <Button text="&#xf053;" (tap)="goback()" class="fa"></Button><Button (tap)="goback()" text="Products" style="font-size: 16;"></Button>
    </StackLayout>
    <Image  row="1" src="res://presonus_logo" width="100" col="1"></Image>
</GridLayout>
    </xmp>

    <p>Naturally I need to deal with the status bar on any iOS device, by setting my <code>Page</code> margin to <code>margin-top: -20</code>, extending my UI behind the status bar. But that means my custom <code>ActionBar</code> will look different on the iPhone X. The iPhone X requires about 69pt of veritcal space for the status bar and the notch to have an appropriate margin between your content and the bottom of the notch.</p>

    <p>Here it is looking bad:</p>
</div>
<div style="text-align: center; margin: 50px 0px;"><img src="https://d3vv6lp55qjaqc.cloudfront.net/items/1i1g3R1i3E1N2J0j3p2o/Screen%20Shot%202017-10-02%20at%207.43.19%20PM.png?X-CloudApp-Visitor-Id=196928" style="width: 80%; max-width: 400px;" /></div>
<div>

    <p>So if we are on an iPhone X, the padding at the top of my navbar will be different than a regular old iPhone.<p>

    <xmp style="width: 100%; overflow: auto;">
#navbar {
    padding-top: 25;
}

.iphonex #navbar {
    padding-top: 44;
}
    </xmp>

    <p>Hold up though, where did that <code>.iphonex</code> class come from? Is there some awesome sugar built into NativeScript that appends device specific classes? Or even a plugin that handles this? Nope. Well at least not right now. Nathanael Anderson needs to update his platform-css and orientation plugins to support NativeScript 3.0, which hopefully everyone is on by now, and maybe when he does he will add a class for the iPhone X. <a href="https://twitter.com/CongoCart">Bug him about it</a>!</p>

    <p>The quickest way to determine if what is running your app is an iPhone X is to sniff out the device's dimensions. Right now, the only iOS device with the following dimensions are the iPhone X: 2436 x 1125</p>

    <p>Here's how I did it:</p>

    <xmp style="width: 100%; overflow: auto;">
let width = platformModule.screen.mainScreen.widthPixels;
let height = platformModule.screen.mainScreen.heightPixels; 
if (platformModule.isIOS && ((height == 2436 && width == 1125) || (height == 1125 && width == 2436))) {
    this.page.className = 'iphonex';
    applicationSettings.setBoolean('iPhoneX', true);
} else {
    applicationSettings.setBoolean('iPhoneX', false);
}
    </xmp>

    <p>Here it is looking better:</p>
</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://d3vv6lp55qjaqc.cloudfront.net/items/1U3L3G3k2x0w0u3t1M1f/Screen%20Shot%202017-10-02%20at%207.52.39%20PM.png?X-CloudApp-Visitor-Id=196928" style="width: 80%; max-width: 400px;" /></div>

<div>
    <p>Ok, looks pretty good. Until...</p>

</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://cl.ly/mqgg/Screen%20Shot%202017-10-02%20at%207.54.00%20PM.png" style="width: 80%; max-width: 600px;" /></div>

<div>
    <p>The margins in landscape have to be different to accommodate the notch and the rounded corners. For this, the quickest way I could come up with to deal with this is to write a function that sets up appropriate classes to append to <code>Page</code> and handle it all in CSS. I extracted my code above into a helpers file, and import the functions when I need them:</p>

    
    <xmp style="width: 100%; overflow: auto;">
export function setClasses(page) {
    let width = platformModule.screen.mainScreen.widthPixels;
    let height = platformModule.screen.mainScreen.heightPixels; 
    if (platformModule.isIOS && ((height == 2436 && width == 1125) || (height == 1125 && width == 2436))) {
        if (height > width) {
            page.className = 'iphonex portrait';
        } else {
            page.className = 'iphonex landscape';
        }
        applicationSettings.setBoolean('iPhoneX', true);
        application.off(application.orientationChangedEvent);
        application.on(application.orientationChangedEvent, (args) => {
            page.className = args.newValue + ' iphonex';
        })
    } else {
        applicationSettings.setBoolean('iPhoneX', false);
    }
}
    </xmp>

    <p>Then in my custom navbar I add a left and right margin of about 30 points. Also, notice I have a <code>Repeater</code> listing some videos to watch. I have a left and right margin of 5pts on them, but all my content now needs about 45pts of margin on both sides to make sure that my app content is not concealed or obstructed by the notch.</p>

    <p>So I created a class to apply to any content in my app that needs those extra margins:</p>

    <xmp style="width: 100%; overflow: auto;">
.iphonex.landscape .contentContainer {
    padding-left: 45;
    padding-right: 45;
}
    </xmp>

</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://cl.ly/n3zG/Screen%20Shot%202017-10-12%20at%2011.53.38%20AM.png" style="width: 80%; max-width: 600px;" /></div>

<div>
    <p>Looking better! So whenever I need classes set up for my view, I run helpers.setClasses(page) and my UI adjusts beautifully.</p>

    <p>One last note: the work involved in setting up the classes you'll need to handle the new UI will likely be addressed by the NativeScript core team or the community in the coming days/weeks. In fact, <a href="https://twitter.com/CongoCart" target="_blank">Nathanael Anderson</a>, a prolific NativeScript plugin developer has already committed to bringing these features to his plugins that handle orientation classes and platform specific css classes.</p>

    <p>I recommend keeping tabs on the versions of these two plugins, and check out his twitter feed and poke at him if you're wondering when these will be ready to rock.</p>

    <ul>
        <li><a href="https://www.npmjs.com/package/nativescript-platform-css" target="_blank">nativescript-orientation</a></li>
        <li><a href="https://www.npmjs.com/package/nativescript-orientation" target="_blank">nativescript-platform-css</a></li>
    </ul>

    <p><b>Warning:</b> As of 10/12/17 nativescript-orientation is not compatible with NativeScript 3.0, and will break your app immediately if installed. He should be updating it soon, or do a fork and do it yourself!</p>
</div>



<br /><br /><br />