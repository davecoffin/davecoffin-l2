
<!DOCTYPE html>
<html lang="en">
    <title>Important Things</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <link rel="stylesheet" type="text/css"  href="important.css"/>
        <link rel="stylesheet" type="text/css"  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    </head>
    <body>
        <div class="page-header">
            <div class="container"><h1>Important things <small>These things are important.</small></h1></div>
        </div>
        <div class="container">
            <div class="col-md-2">
                <ul class="list-group">
                    <li class="list-group-item"><a href="#9-06-2017">Setting up and updating a laravel site on shared hosting</a></li>
                    <li class="list-group-item"><a href="#9-05-2017">Publishing to Google Play</a></li>
                    <li class="list-group-item"><a href="#7-17-2017">Stable NativeScript settings for Daily Nanny</a></li>
                    <li class="list-group-item"><a href="#7-21-2017">Notes on Nanny Shifts nativescript versions</a></li>
                    <li class="list-group-item"><a href="#7-21x2-2017">Upgraded mypresonus to {N} 3.1 and all angular packages</a></li>
                </ul>            
            </div>
            <div class="col-md-10">
                <div class="section" id="9-06-2017">
                    <span class="title h1">September 6th 2017 - Setting up and updating a laravel site on shared hosting</span>
                    <div class="section_content">
                        <span class="description">
                            <p>I am setting up a laravel site for nanny shifts, and publishing on shared hosting is a little confusing.</p>
                            <p>In general, follow <a href="https://github.com/petehouston/laravel-deploy-on-shared-hosting" target="_blank">these instructions</a>.</p>
                            <p>For nanny shifts, I created an add on domain in my davecoffin.com hosting account. That creates a folder called <code>nannyshifts</code> in <code>/public_html</code>.</p>
                            <p>The idea is to <code>git clone</code> the project via ssh on the server, but you need to do it cleverly.</p>
                            <p>Create a <code>project</code> folder in <code>nannyshifts</code> (which is the document root for the domain). Then clone the repo into the project folder.</p>
                            <p>Then (following the above instructions) you create a symbolic link to the public folder in your laravel project. The difference is, I did not make a backup on the public folder, its stored in git, who cares?</p>
                            <p>Also, instead of making www the symbolic link, youd make <code>nannyshifts</code> the symbolic link so that when the domain resolves to <code>nannyshifts</code>, the public folder is loaded.</p>
                            <p><b>IMPORTANT: To make it so you can develop locally, you can make a symlink to the autoload files to match whatever the directory structure is on the server, for example: <code>ln -s /Users/davecoffin/Develop/sites/nannyshifts/bootstrap/ /Users/davecoffin/Develop/sites/nannyshifts/laravel_projects/nannyshifts/bootstrap</code></b></p>
                            
                            <p><b>ANOTHER IMPORTANT: For some reason I have had to do the following to make the laravel page load. First, copy the <code>.env.example</code> file and rename to .env. You dont need to change anything unless you are doing DB stuff. In the apps main folder (example <code>laravel_projects/nannyshifts</code>) run <code>php artisan key:generate</code> then <code>php artisan config:clear</code>. Then the site should load.</b></p>
                        </span>
                        
                    </div>
                </div>
                
                <div class="section" id="9-05-2017">
                    <span class="title h1">September 5th 2017 - Publishing to Google Play</span>
                    <div class="section_content">
                        <span class="description">
                            <p>Here's how to publish to Google Play.</p>
                            <p>Increment the VersionCode and VersionName in /App_Resources/Android/AndroidManifest.xml</p>
                            <p>In general follow <a href="https://docs.nativescript.org/publishing/publishing-android-apps" target="_blank">these instructions</a>, but you'll need the following info:</p>
                            <p>Your <code>keystore</code> file is stored in <code>Develop/Cubby Notes/Daily Nanny Android Release Assets/Certificate</code>.</p>
                            <p>To generate the release build, run this command while in the pocketnanny folder:</p>
                            <code>tns build android --release --key-store-path ../Daily\ Nanny\ Android\ Release\ Assets/Certificate/my-release-key.jks --key-store-password Endien1. --key-store-alias dailynannykeystore --key-store-alias-password Endien1.</code>
                            <p>Obtain the release .apk located at /platforms/android/build/outputs/apk/pocketnanny-release.apk and upload it to google play.
                        </span>
                        
                    </div>
                </div>
                
                <div class="section" id="7-17-2017">
                    <span class="title h1">July 17th 2017 - stable package.json file and core module and runtime versions for dailynanny app repo</span>
                    <div class="section_content">
                        <span class="description">I am trying to upgrade to NativeScript 3 and have had trouble in the past with my plugins. I'd like to get to a point where I can run the 3.0 cli but run earlier tns-core-modules and runtimes. But in the event that I can't get it working, I can always go back to these settings to make updates.</span>
                        <div class="code">
                            <span class="code_title">/Develop/Cubby Notes/pocketnanny/package.json</span>
                            <xmp>
    {
      "description": "An app for improving communication between parents and nannies, and the care that kids receive.",
      "license": "MIT",
      "version": "1.0.0",
      "repository": {
        "type": "git",
        "url": "https://github.com/TheDaycareList/pocketnanny"
      },
      "author": "Dave Coffin <dave@cubbynotes.com> (https://cubbynotes.com/)",
      "homepage": "https://cubbynotes.com",
      "nativescript": {
        "id": "com.cubbynotes.pocketnanny",
        "tns-android": {
          "version": "2.5.0"
        },
        "tns-ios": {
          "version": "2.5.1"
        }
      },
      "dependencies": {
        "moment": "^2.15.2",
        "nativescript-background-http": "^2.4.2",
        "nativescript-geolocation": "0.0.19",
        "nativescript-grid-view": "^1.4.0",
        "nativescript-imagecropper": "0.0.7",
        "nativescript-imagepicker": "^2.5.1",
        "nativescript-iqkeyboardmanager": "^1.0.1",
        "nativescript-onesignal": "^1.0.5",
        "nativescript-orientation": "^1.5.4",
        "nativescript-permissions": "^1.2.3",
        "nativescript-photoviewer": "^1.0.0",
        "nativescript-platform-css": "^1.4.0",
        "nativescript-pulltorefresh": "1.1.10",
        "nativescript-slides": "^2.1.6",
        "nativescript-web-image-cache": "^3.4.0",
        "tns-core-modules": "^2.5.2"
      },
      "devDependencies": {
        "babel-traverse": "6.23.1",
        "babel-types": "6.23.0",
        "babylon": "6.15.0",
        "lazy": "1.0.11"
      }
    }
                            </xmp>
                        </div>
                        
                        <span class="h3">Core Modules and Runtime version</span><br />
                        <img src="https://d3vv6lp55qjaqc.cloudfront.net/items/3Y3E2h0K020Y180M3P1P/Screen%20Shot%202017-07-17%20at%209.32.52%20AM.png?X-CloudApp-Visitor-Id=196928" />
                    </div>
                </div>
                
                
                
                
                
                
                <div class="section" id="7-21-2017">
                    <span class="title h1">July 21st 2017 - notes on stable Nanny Shift versions</span>
                    <div class="section_content">
                        <span class="description">
                            <p>Firebase wasnt working because of some entitlement issues updated in {N} 3.1, so I reverted to 3.0.1 and that worked fine. But I needed to upgrade to 3.1 to use Telerik UI Sidedrawer in MyPreSonus app.</p>
                            <p>So the last stable versions of everything for Nanny Shifts was 3.0.1 for everything, {N}, core modules and runtimes. The telerik UI version that works with that is <code>"nativescript-telerik-ui": "^2.0.1"</code></p>
                            <p>I will attempt to update all of that, because supposedly the firebase plugin has been <a href="https://github.com/EddyVerbruggen/nativescript-plugin-firebase/issues/420">fixed to work with the entitlements</a>.
                        </span>
                        
                    </div>
                </div>
                
                
                
                
                
                <div class="section" id="7-21x2-2017">
                    <span class="title h1">July 21st 2017 - Upgraded MyPresonus repo to {N} to 3.1 and got it working...but just in case here is last stable package.json</span>
                    <div class="section_content">
                        <span class="description">Just in case something brutal goes wrong, heres where we were. I managed to get it working by upgrading all the plugins, and then upgrading nativescript-angular and all the angular modules.</span>
                        <div class="code">
                            <span class="code_title">/Develop/Presonus/MyPresonus/mypresonus/package.json</span>
                            <xmp>
    {
        "description": "NativeScript Application",
        "license": "SEE LICENSE IN <your-license-filename>",
        "readme": "NativeScript Application",
        "repository": "<fill-your-repository-here>",
        "nativescript": {
        "id": "org.presonus.mypresonus",
        "tns-android": {
          "version": "3.1.1"
        },
        "tns-ios": {
          "version": "3.1.0"
        }
        },
        "scripts": {
        "build.plugin": "tsc nativescript-cam/cam.ios.ts references.d.ts --lib es2016 --target es5 -d true --experimentalDecorators true && tns plugin remove nativescript-cam && tns plugin add nativescript-cam",
        "start": "npm run build.plugin && tns run ios"
        },
        "dependencies": {
        "@angular/common": "2.4.3",
        "@angular/compiler": "2.4.3",
        "@angular/core": "2.4.3",
        "@angular/forms": "2.4.3",
        "@angular/http": "2.4.3",
        "@angular/platform-browser": "2.4.3",
        "@angular/platform-browser-dynamic": "2.4.3",
        "@angular/router": "3.4.3",
        "moment": "^2.18.1",
        "nativescript-angular": "1.4.0",
        "nativescript-iqkeyboardmanager": "^1.1.0",
        "nativescript-pdf-view": "^2.0.1",
        "nativescript-speech-recognition": "^1.2.0",
        "nativescript-status-bar": "^1.1.1",
        "nativescript-taptic-engine": "^2.0.2",
        "nativescript-telerik-ui": "^3.0.4",
        "nativescript-theme-core": "~1.0.2",
        "nativescript-videoplayer": "^2.4.0",
        "nativescript-youtube-parser": "^1.0.0",
        "nativescript-zendesk": "^0.3.4",
        "reflect-metadata": "~0.1.8",
        "rxjs": "~5.0.1",
        "tns-core-modules": "^3.1.0"
        },
        "devDependencies": {
        "@types/moment": "^2.13.0",
        "babel-traverse": "6.24.1",
        "babel-types": "6.24.1",
        "babylon": "6.17.1",
        "lazy": "1.0.11",
        "nativescript-dev-android-snapshot": "^0.*.*",
        "nativescript-dev-typescript": "~0.3.5",
        "tns-platform-declarations": "^2.5.0",
        "typescript": "~2.1.0",
        "zone.js": "~0.7.2"
        }
    }

                            </xmp>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </body>
</html>