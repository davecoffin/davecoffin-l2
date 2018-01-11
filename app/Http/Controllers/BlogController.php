<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getBlogs() {
        $blogs = [];

        $blogs['01-11-18-using-workers'] = [
            "title" => "Using Workers in NativeScript",
            "brief_description" => "I hate worrying about performance. Its the least fun part of development. Its hard enough writing code that works, are we really expected to make it work well on all devices...",
            "date" => "January 11th, 2018",
            "external_link" => false,
            "image" => "https://ohmy.disney.com/wp-content/uploads/2015/06/Snow-White_Dwarfs-mine.jpg"
        ];

        $blogs['11-29-17-creating-a-draggable-modal'] = [
            "title" => "Adventures in Gestures: Creating a Draggable Modal",
            "brief_description" => "Remember when Steve Jobs insisted that big phones are stupid? The iPhone 5 was designed to be as big as possible while still allowing a user's finger to touch controls anywhere on the screen. I totally agreed with that, and sort of still do, but when I hold an...",
            "date" => "November 29th, 2017",
            "external_link" => false,
            "image" => "http://boygeniusreport.files.wordpress.com/2011/02/screen-shot-2011-02-24-at-4-04-16-pm110224212955.jpg?quality=98&strip=all&w=782"
        ];

        $blogs['11-16-17-how-i-got-webpack-to-work'] = [
            "title" => "How I Got Webpack to Work (Finally) on My NativeScript Angular Project",
            "brief_description" => "Recently I spent two days trying to wire up webpack for my NativeScript Angular project. Webpack is notoriously difficult to set up, so here's how I ended up doing it...",
            "date" => "November 16th, 2017",
            "external_link" => false,
            "image" => "https://cl.ly/nlEv/Screen%20Shot%202017-11-16%20at%202.29.48%20PM.png"
        ];

        $blogs['11-08-17-creating-a-nativescript-ui-plugin'] = [
            "title" => "My Experience Creating My First NativeScript UI Plugin",
            "brief_description" => "Pretty recently I wrote blog post about coming up with a mobile UI element that could handle selecting items from very large lists. I came up with something I think is really cool, so I wrote a blog post about it that was...",
            "date" => "November 8th, 2017",
            "external_link" => false,
            "image" => "https://images4.alphacoders.com/239/239474.jpg"
        ];

        $blogs['10-31-17-nativescript-platform-declarations'] = [
            "title" => "Utilizing Platform Declarations in NativeScript",
            "brief_description" => "One of the coolest things about NativeScript is being able to access native APIs right out of the box. That means you don't need to wait for some organization or the open source community to expose access to brand new APIs released with new OS's, you can start fiddling...",
            "date" => "October 31st, 2017",
            "external_link" => false,
            "image" => "http://www.salafi-islam.com/wp-content/uploads/2016/12/halloween.jpg"
        ];
        
        $blogs['10-15-17-custom-navbars'] = [
            "title" => "Using custom Action Bars in NativeScript",
            "brief_description" => "The Action Bar is one of the most prominent UI elements in mobile apps. Its houses the title of your view, your navigation controls, and often controls for key functionality in your apps. In the messages app for example, You've got an image of the person you're texting...",
            "date" => "October 15th, 2017",
            "external_link" => false,
            "image" => "http://cdn.nanxiongnandi.com/bing/WestphaliaRoad_ROW12120574756_1366x768.jpg"
        ];
        $blogs['9-25-17-ios-safe-areas'] = [
            "title" => "NativeScript, the iPhone X, and safe areas.",
            "brief_description" => "As you all have heard by now, the 10th anniversary iPhone is coming out soon. It's called the iPhone X, and it has a controversial new design element they are calling the \"notch.\" I am not sold on this, but I haven't held the device yet. It looks ugly to me, which I...",
            "date" => "October 12th, 2017",
            "external_link" => false,
            "image" => "http://bpc.h-cdn.co/assets/17/37/980x490/landscape-1505243244-iphone-x-announcement.jpg"
        ];
        $blogs['10-09-17-meet-dave-coffin-developer-expert-for-nativescript'] = [
            "title" => "Meet Dave Coffin, Developer Expert for NativeScript",
            "brief_description" => "Here's the article that was written about me being selected as a Telerik Developer Expert for my work in the NativeScript community.",
            "date" => "October 9th, 2017",
            "external_link" => "https://www.telerik.com/blogs/meet-dave-coffin-developer-expert-for-nativescript"
        ];
        $blogs['9-22-17-hello-world'] = [
            "title" => "Hello World",
            "brief_description" => "I am a dad. I am also a software engineer. Like I imagine happens with probably all parents ever, my wife Jen and I had our first child and started thinking about all the products and services that would make our lives easier. There are so many solutions out there...",
            "date" => "September 22nd, 2017",
            "external_link" => false,
            "image" => "https://1.bp.blogspot.com/_RurH6zDlc1M/Rb5J89Y9ZAI/AAAAAAAAABI/FKnl_Ae2XE4/w1200-h630-p-k-no-nu/SUNRISEEARTH017+high-res.jpg"
        ];
        $blogs['8-08-17-filterable-list-picker'] = [
            "title" => "Filterable List Picker in NativeScript",
            "brief_description" => "When I transitioned to mobile development from web development, there were all these UI questions I hadn't thought thoroughly through before. The web is forgiving, mobile users expect less from it. That's arguably not a good thing considering how far its come, but...",
            "date" => "August 8th, 2017",
            "external_link" => "https://www.nativescript.org/blog/filterable-list-picker-in-nativescript",
            "image" => "https://1.bp.blogspot.com/_RurH6zDlc1M/Rb5J89Y9ZAI/AAAAAAAAABI/FKnl_Ae2XE4/w1200-h630-p-k-no-nu/SUNRISEEARTH017+high-res.jpg",
            "thumb"=> "/images/filterablelistpickerthumb.png"
        ];
        
        return $blogs;
    }

    public function index() {
        $blogs = $this->getBlogs();
        return view('blog', compact('blogs'));
    }

    public function show($blog_id) {
        $blogs = $this->getBlogs();
        
        return view('blogdetail', compact('blogs', 'blog_id'));
    }
}
