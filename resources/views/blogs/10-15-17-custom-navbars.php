<div>
    <p>The Action Bar is one of the most prominent UI elements in mobile apps. Its houses the title of your view, your navigation controls, and often controls for key functionality in your apps. In the messages app for example, You've got an image of the person you're texting with, a button that brings up a modal with a bunch more functionality, and a back button.</p>
</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://support.apple.com/library/content/dam/edam/applecare/images/en_US/iOS/ios11-iphone7-messages-imessage-text.jpg" style="width: 80%; max-width: 300px;" /></div>

<div>
    <p>These <a href="https://docs.nativescript.org/ui/action-bar" target="_blank">Action Bars are available to NativeScript developers</a> out of the box. They are great ways to quickly wire up your navigation in your app and implement features in your apps where users are used to invoking them. One of the great things about using native controls is that your users will know how to use your app as soon as they open it, since many of their other apps use these useful default UI controls.</p>

    <p class="blognote">This article refers to cross platform mobile app development using NativeScript, an open source framework. If you don't know about NativeScript, <a href="http://nativescript.org" target="_blank">learn more here</a>.</p>

    <p>In my mind, it is significantly more important to utilize standardized UI controls that users of mobile platforms are already familiar with, even if you do have to make some sacrifices when it comes to the design of your app. For example, you could have spent years perfecting the perfect switch, a design that would revolutionize the mobile world, but its more important that your user knows how to use your app before they even download it than be delighted by a pretty UI but get frustrated with the workflow.</p>
</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://www.titanui.com/wp-content/uploads/2013/06/30/Flat-iOS-7-Switch-Buttons-PSD.jpg" style="width: 80%; max-width: 300px;" /></div>

<div>
    <p>Every iOS user has seen those and uses them daily. With NativeScript, throw a <code>Switch</code> in your app and be done with it. As an added bonus, as the native UI controls evolve, so will they in your app. So if Apple and Google tweak their UI controls, your app will evolve with it.</p>

    <p>All that being said, we still want to have some fun once in a while. In an app I am working on, I wanted to experiment with a custom action bar. I really like the translucency in iOS apps, and unforunately right now with the way that NativeScript sets up frames in your app, your UI cant extend underneath the default <code>ActionBar</code>.</p>

    <p>So here's how I created a custom <code>ActionBar</code> in my app:</p>

    <xmp style="width: 100%; overflow: auto;">
<AbsoluteLayout height="100%" width="100%">
    <GridLayout top="0" width="100%" height="100%">
        // My main view content goes here.        
    </GridLayout>
        

    <GridLayout #navbar id="navbar" width="100%" rows="auto, 35" columns="80, *, 80" top="0" left="0">
        <StackLayout orientation="horizontal" row="1" (tap)="goback()" marginLeft="5">
            <Button text="&#xf053;" (tap)="goback()" class="fa back_icon"></Button>
            <Button (tap)="goback()" text="Back" class="back_btn_text"></Button>
        </StackLayout>
        <Label style="text-align: center; font-weight: bold;" row="1" text="Orders" verticalAlignment="middle" col="1"></Label>
    </GridLayout>
</AbsoluteLayout>
    </xmp>

    <p>I use an <code>AbsoluteLayout</code> to position both my main view content and the navbar at the top, and place the navbar code after the main view code so that it sits on top of it. I need to manage margins appropriately in my css so that content isnt under the navbar by default, but the nice thing I can do here is scroll the content of my app under the <code>ActionBar</code>.</p>

    <p>With some pretty minor native iOS coding, we can get that nice translucency effect. I extracted the code into a function I can call whenever a view with the custom <code>ActionBar</code> is displayed.</p>

    <xmp style="width: 100%; overflow: auto;">
export function blurNav(navbar) {
    let navBounds = navbar.ios.bounds;
    var navEffectView = UIVisualEffectView.alloc().initWithEffect(UIBlurEffect.effectWithStyle(UIBlurEffectStyleLight));
    navEffectView.frame = {
        origin: { x: navBounds.origin.x, y: navBounds.origin.y - 20 },
        size: { width: navBounds.size.width, height: navBounds.size.height + 20 }
    };
    navEffectView.autoresizingMask = UIViewAutoresizingFlexibleWidth | UIViewAutoresizingFlexibleHeight;
    navbar.ios.addSubview(navEffectView);
    navbar.ios.sendSubviewToBack(navEffectView);

}
    </xmp>

    <p class="blognote">This app is built with NativeScript's Angular implementation, but its essentially the same for non-angular NativeScript apps.</p>

    <p>And then in my view code I do:</p>

    <xmp style="width: 100%; overflow: auto;">
@ViewChild("navbar") navbar: ElementRef;
ngOnInit(): void {
    if (isIOS) helpers.blurNav(this.navbar.nativeElement);
    ...
}
    </xmp>

    <p>Then I get a nice ActionBar that my UI extends underneath, and I get the smooth translucency when the user scrolls content underneath it.</p>
</div>

<div style="text-align: center; margin: 50px 0px;"><img src="/images/translucentnavbar.gif" style="width: 80%; max-width: 300px;" /></div>




<br /><br /><br />