<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getBlogs() {
        $blogs = [];
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
