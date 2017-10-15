<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getBlogs() {
        $blogs = [];
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
