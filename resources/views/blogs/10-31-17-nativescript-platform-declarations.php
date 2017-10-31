<div>
    <p>One of the coolest things about NativeScript is being able to access native APIs right out of the box. That means you don't need to wait for some organization or the open source community to expose access to brand new APIs released with new OS's, you can start fiddling with them immediately.</p>

    <p>This makes creating plugins for the NativeScript community really fun. Plugins abstract the complex native APIs and provide a unified API for the plugin user. They are becoming my favorite part of NativeScript development. But there is a learning curve, so this article will explain one little piece that has helped me immensely, and removes the question marks when developing plugins that expose access to Native APIs, and even APIs from libraries you want to incorporate.</p>

    <p class="blognote">This article focuses on exposing iOS Native APIs, but there are tons of resources out there for Android as well.</p>

    <p>If none of that makes much sense to you, here's a practical example. NativeScript exposes a lot of great functionality out of the box, but say you want to do something fancier in your iOS app. You like the nice blur that iOS uses all throughout the OS, but you don't know how to use it. Well, NativeScript has a great way to utilize native iOS APIs in your apps without having to guess the method names, obsess over the iOS documentation, and end up banging your head against your desk.</p>
</div>

<div style="text-align: center; margin: 50px 0px;"><img src="http://gif-finder.com/wp-content/uploads/2016/09/Elisabeth-Moss-Bang-Head-On-Desk.gif" style="width: 80%; max-width: 500px;" /></div>

<div>

    <p>Theres an npm package called <a href="https://www.npmjs.com/package/tns-platform-declarations" target="_blank">tns-platform-declarations</a>, that when installed will generate declarations files for all native iOS and Android APIs. Declarations files provide your IDE typescript declarations, so your IDE can offer rich intellisense while coding. Intellisense is when your editor offers you autocomplete while coding, while also providing more info on methods and functionality so dont need to keep heading back to documentation.</p>
</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://cl.ly/nPb5/Screen%20Shot%202017-10-31%20at%2011.53.05%20AM.png" style="width: 80%; max-width: 500px;" /></div>

<div>
    <p>So you install the npm package, then create a file called references.d.ts in the source folder for your app (or plugin). Make it look like the code block below, and when you type, your IDE should start offering autocompelte for Native APIs!</p>
<xmp style="width: 100%; overflow: auto;">
/// <reference path="node_modules/tns-platform-declarations/android.d.ts" />
/// <reference path="node_modules/tns-platform-declarations/ios.d.ts" />
</xmp>
</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://cl.ly/nQ9U/Screen%20Shot%202017-10-31%20at%2011.56.34%20AM.png" style="width: 80%; max-width: 500px;" /></div>

<div>
    <p>Ok, this is objectively awesome. Now you can explore iOS (and Android) documentation just by coding. So we wanted to add some blur to some views in our app, like under a modal. How can we do it? Just start typing...</p>

</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://cl.ly/nPDa/Screen%20Shot%202017-10-31%20at%2012.00.16%20PM.png" style="width: 80%; max-width: 500px;" /></div>

<div>
    <p>But, it gets better. Say you want to incorporate a cocoapod into your project. Cocoapods are like NativeScript plugins, but just for iOS. They come with their own APIs, and they can be confusing to implement due to how NativeScript translates Objective C method calls into JavaScript method calls. But you don't need to worry about that.</p>
    <p>Lets say you are creating a plugin from the <a href="https://docs.nativescript.org/plugins/building-plugins" target="_blank">NativeScript plugin seed</a>. You can incorporate cocoapods by adding a Podfile to /src/platforms/ios. The Podfile should contain:</p>
<xmp style="width: 100%; overflow: auto;">
pod 'YourCocoapodName'
</xmp>
    <p>That's all you need to do to start using the APIs in the Cocoapod. But, how do you know what they are? How can you get Intellisense on them?</p>

<xmp style="width: 100%; overflow: auto;">
TNS_TYPESCRIPT_DECLARATIONS_PATH="$(pwd)/typings" tns build ios
</xmp>

    <p>Run that in the demo folder of your app. That will generate all the platform declarations (including the ones you already installed with the tns-platform-declarations package), including all the Cocodpods you use in your project! The only file you're interested in though is the declarations file for your cocoapod. In a plugin I contributed to, I used the CFAlertViewController cocoapod. So I set up my podfile, ran the command above, and it spit out a typings folder in my root directory. Its got 2 different folders: <code>i386</code> and <code>x86_64</code>. You can use either one. Open one up and find your declarations file: <code>objc!CFAlertViewController.d.ts</code>. Grab that file and put it in the typings folder and delete the two folders it generated.</p>

    <p>Then, you can add it to your <code>references.d.ts</code> file, so now my r<code>eferences.d.ts</code> file looks like this:</p>

<xmp style="width: 100%; overflow: auto;">
/// <reference path="node_modules/tns-platform-declarations/android.d.ts" />
/// <reference path="node_modules/tns-platform-declarations/ios.d.ts" />
/// <reference path="typings/objc!CFAlertViewController.d.ts" />
</xmp>

    <p>Now I get Intellisense from my Cocoapod in my IDE! One important thing to note though, the references files will conflict with your compiler, so you need to ignore them in your <code>tsconfig.json</code> file. Just add "typings" to the "exclude" array.</p>

<xmp style="width: 100%; overflow: auto;">
... //
"exclude": [
    "node_modules",
    "platforms",
    "**/*.aot.ts",
    "typings"
]
...
</xmp>
</div>






<br /><br /><br />