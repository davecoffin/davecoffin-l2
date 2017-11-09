<div>
    <p class="blognote">My daughter is turning 4 next week and we are hosting a unicorn party this weekend, hence my inspirational header image.</p>

    <p>Pretty recently I wrote blog post about coming up with a mobile UI element that could handle selecting items from very large lists. I came up with somethink I think is really cool, so I wrote a blog post about it that was <a href="https://www.nativescript.org/blog/filterable-list-picker-in-nativescript" target="_blank">featured on NativeScript.org</a>.</p>

    <p>I knew it would make a great plugin, but all I'd ever done is Cocoapods integrations and exposing some cool native iOS APIs. This plugin utilizes NativeScript views, no platform specific APIs needed at all. It's basically a functional wrapper around NativeScript functionality relatively easily achievable with out of the box NativeScript components.</p>

    <p>I had no idea how to do it, and frankly, the <a href="https://docs.nativescript.org/plugins/ui-plugin-composite" target="_blank">documentation on creating plugins of this nature</a> leaves a lot to be desired.</p>
</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://media.giphy.com/media/oGzFZek2lszlK/giphy.gif" style="width: 80%; max-width: 500px;" /></div>

<div>
    <p><a href="https://docs.nativescript.org/plugins/ui-plugin-composite" target="_blank">Said documentation</a> got me part of the way there. I'll try and parse some of it for you, as I understand it. But to quote my friend and relunctant occasional mentor <a href="https://twitter.com/BradWayneMartin" target="_blank">Brad Martin</a>, "I have no idea what I'm doing." If you notice things that I say that are entirely incorrect or represent a misunderstanding of norms and best practices, get in touch with me or comment below.</p>

    <p>Basically, your class should extend a NativeScript layout class, like GridLayout, or View, or StackLayout etc. So if you do something simple like</p>
<xmp style="width: 100%; overflow: auto;">export class Meme extends StackLayout {
    constructor() {
        super();
    }
}
</xmp>
    <p>And register your element in your xml namespace, you can do </p>
<xmp><ui:Meme></ui:Meme></xmp>

    <p>and treat it exactly like a StackLayout. So doing</p>

<xmp><ui:Meme>
    <Label text="I'm on top" />
    <Label text="I'm on bottom" />
</ui:Meme>
</xmp>

    <p>It will stack just like a StackLayout on both iOS and Android.</p>

    <p>But why would I want to do that? Well, if you continue reading that documentation, you can load other NativeScript elements into your class container, so you can provide functionality in your plugin that sets up layouts and views for users of your plugin.</p>

    <p>The Filterable List Picker is a perfect example of this. What I wanted was to allow the user to place some simple xml in their app and get a fully functonal list picker.</p>

    <p>So, based on that tutorial, I started with something like this: </p>

<xmp>import { ObservableArray } from 'tns-core-modules/data/observable-array';
import { View, Property } from "tns-core-modules/ui/core/view";
import { GridLayout } from 'tns-core-modules/ui/layouts/grid-layout';
import { StackLayout } from 'tns-core-modules/ui/layouts/stack-layout';
import * as frame from 'tns-core-modules/ui/frame';
import { isIOS } from "tns-core-modules/platform";
let builder = require('tns-core-modules/ui/builder');

export const hintTextProperty = new Property<FilterableListpicker, string>({ name: "hintText", defaultValue: 'Enter text to filter...' });
export const sourceProperty = new Property<FilterableListpicker, ObservableArray<string>>({ name: "source", defaultValue: new ObservableArray(["Test"]), affectsLayout: true });

export class FilterableListpicker extends GridLayout {
    constructor() {
        super();
        let innerComponent = builder.load(__dirname + '/filterable-listpicker.xml') as View;
        innerComponent.bindingContext = this;
        this.addChild(innerComponent);
    }
    
    public source: any;
    public hintText: any;

}

hintTextProperty.register(FilterableListpicker);
sourceProperty.register(FilterableListpicker);
</xmp>

    <p>You'll notice I am using builder to load in some xml from my plugin code. Here's that xml:</p>

<xmp><GridLayout id="dc_flp_container" visibility="collapsed">
    <StackLayout id="dc_flp" style="background-color: white; border-radius: 10;">
        <TextField hint="{{hintText}}" id="filterTextField" style="padding: 10 15; height: 40; background-color: #E0E0E0; border-radius: 10 10 0 0;" />
        <ListView items="{{ source }}">
            <ListView.itemTemplate>
                <Label text="{{$value}}" style="margin-left: 15; padding: 10 0;" />
            </ListView.itemTemplate>
        </ListView>
    </StackLayout>
</GridLayout>
</xmp>

    <p>So now if we put </p>

<xmp><ui:FilterableListpicker></ui:FilterableListpicker></xmp>
     
     <p>in our app, it will load up our <code>GridLayout</code> with the contents of our XML file already in it. So we have a <code>StackLayout</code> that holds our <code>ListView</code>.</p>

     <p>The next challenge was to get an array of strings into our <code>ListView</code>. This is handled by registering a property on our class. You'll notice in the plugin TypeScript code above, we do</p>

<xmp>export const sourceProperty = new Property<FilterableListpicker, ObservableArray<string>>({ name: "source", defaultValue: new ObservableArray(["Test"]), affectsLayout: true });</xmp>

    <p>That sets up a Property, which we need to register on our class so we can grab the <code>source</code> we set on our custom UI element.</p>

    

    <p>We do that like this (make sure to do it after the class is defined): <code>sourceProperty.register(FilterableListpicker);</code></p>

    <p class="blognote">Properties are a little confusing, I still don't totally understand them. Learn more about Properties <a href="https://docs.nativescript.org/core-concepts/properties" target="_blank">here</a>.</p>

    <p>Now we can add <code>source</code> as a property to our UI element:</p>

<xmp><ui:FilterableListpicker source="{{listitems}}"></ui:FilterableListpicker></xmp>

    <p><code>listitems</code> is an array of strings in our page's binding context. Pretty cool! Now we get a list containing the array we set up in our app!</p>

</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://cl.ly/nblL/Screen%20Shot%202017-11-09%20at%202.04.01%20PM.png" style="width: 80%; max-width: 500px;" /></div>

<div>
    <p>To add the filtering capability we need a <code>TextField</code>, and this is a modal (a UI element that sits on top of other UI elements), so we need a Cancel control too. We just need to add some more NativeScript elements to our XML file that creates the FilterableListpicker. I also want to "dim" the content below it so acts similar to a dialog. Here's how I want it to look in the end:</p>

</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://cl.ly/nc5J/Screen%20Shot%202017-11-09%20at%202.31.13%20PM.png" style="width: 80%; max-width: 300px;" /></div>

<div>
    <p>Heres my final xml in filterable-listpicker.xml (the xml thats loaded into the custom UI component)</p>

<xmp><GridLayout id="dc_flp_container" visibility="collapsed">
    <StackLayout tap="{{cancel}}" width="100%" height="100%"  />
    <StackLayout width="{{listWidth}}" row="1" id="dc_flp" height="{{listHeight}}" style="background-color: white; border-radius: 10;">
        <TextField hint="{{hintText}}" text="{{filterText}}" id="filterTextField" style="padding: 10 15; height: 40; background-color: #E0E0E0; border-radius: 10 10 0 0;" />
        <ListView items="{{ source }}" height="{{listHeight - 80}}" itemTap="{{choose}}">
            <ListView.itemTemplate>
                <Label text="{{$value}}" style="margin-left: 15; padding: 10 0;" />
            </ListView.itemTemplate>
        </ListView>
        <StackLayout style="background-color: #E0E0E0; height: 40; border-radius: 0 0 10 10;">
            <Button text="Cancel" tap="{{cancel}}" verticalAlignment="middle" style="font-weight: bold; height: 40; background-color: transparent; background-color: transparent; border-color: transparent; border-width: 1; font-size: 12;" />    
        </StackLayout>
    </StackLayout>
</GridLayout>
</xmp>

    <p>To enable filtering, we need to setup a listener on the <code>TextField</code>. To accomplish this, I save the array the user set up (the source property) to another array that we do not filter, so we can safely set the source to a filtered array. We can take care of this in the constructor of our class. At the time the constructor is called though, the source property is set to the default property we set in the Property declaration.</p>

    <p>This is hacky, and somebody please tell me how to do this correctly, but I grab the source in a setTimeout, which allows the property to be initialized with the array from the app:</p>

<xmp>constructor() {
    super();
    let innerComponent = builder.load(__dirname + '/filterable-listpicker.xml') as View;
    innerComponent.bindingContext = this;
    this.addChild(innerComponent);

    setTimeout(() => {
        this.source.forEach(element => {
            this.unfilteredSource.push(element);
        });
        if (isIOS) {
            let parent: any = frame.topmost().getViewById('dc_flp_container').parent;
            parent.visibility = "collapse";
        }
    }, 10)
    
    let textfield = innerComponent.getViewById('filterTextField')
    textfield.on('textChange', (data: any) => {
        this.source = this.unfilteredSource.filter(item => {
            return item.toLowerCase().indexOf(data.value.toLowerCase()) !== -1;
        })
    })
}
</xmp>

    <p>Then you'll notice I grab the textfield and watch the textChange event, and set the source to the filtered array.</p>

    <p>This works awesome. Since source is an <code>ObservableArray</code>, the array filters in front of our eyes.</p>

    <p>But obviously, we need to handle some events, like the user tapped something in the <code>ListView</code>, and the user tapped the cancel button. This was the most confusing part about this, and the reason I decided to write this blog post, there are no resources that I could find out there describing how this is done. You have to parse through open source plugin code that does this to figure it out. I used Brad Martin's nativescript-videoplayer plugin to see how he did it. And I also bugged him on Slack in the NativeScript community and he helped me out. He's the man.</p>

    <p>Here's how its done. You need to declare the property as a <code>public static</code> in your class. The name of the property in your class needs to be yourpropertyEvent. So your property name + 'Event'. Weird, I know. So if I wanted a <code>canceled</code> property in my UI component that will call a function if the modal is canceled, I need to declare it like this: <code>public static canceledEvent = "canceled";</code>. 
</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://media.giphy.com/media/3ohzdDls6viEANKHtK/giphy.gif" style="width: 80%; max-width: 500px;" /></div>

<div>
    <p>I need an event for canceled and itemTapped:</p>

<xmp>public static canceledEvent = "canceled";
public static itemTappedEvent = "itemTapped";</xmp>

    <p>And then I set the properties on my UI Component:</p>

<xmp><ui:FilterableListpicker id="myfilter" source="{{listitems}}" canceled="{{cancelFilterableList}}" itemTapped="{{itemTapped}}" /></xmp>

    <p>Then, when the event occurs at which you'd like to call the function defined in the UI component, you need to <code>notify</code> the component of that event. Notice that in my plugin xml, I have the Cancel button call a <code>cancel()</code> function. When the user taps cancel, I want to hide the modal, but also call the function the user defined.</p>

<xmp>public cancel() {
    this.notify({
        eventName: 'canceled',
        object: this
    });
    this.hide();
}
</xmp>

    <p><code>notify</code> does that for us. The UI Component is notified, and the function is called. Amazing. We need to do the same for itemTapped.</p> Notice the <code>itemTap</code> function in my ListView in the plugin XML (the standard event in NativeScript when a <code>ListView</code> item is tapped), I am calling a function in my class called <code>choose()</code>.</p>

<xmp>public choose(args) {
    let item = this.source[args.index];
    this.hide();
    this.notify({
        eventName: 'itemTapped',
        object: this,
        selectedItem: item
    });
}</xmp>

    <p>So, I get the item selected in the source, hide the modal, and notify the component which calls <code>itemTapped</code>, defined in the app. The event arguments are the object included in notify, so I've created the <code>itemSelected</code> key to include the string the user tapped.</p>

    <p>Everything works!</p>
</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://media.giphy.com/media/3ohzdIuqJoo8QdKlnW/giphy.gif" style="width: 80%; max-width: 500px;" /></div>

<div>
    <p>I felt compelled to add some other cool things like the option to customize the dimmer color, blur the background on iOS, customize the placeholder text in the textfield, and let the user control the width and height of the modal.</p>

    <p>You can check out all my plugin code <a href="https://github.com/davecoffin/nativescript-filterable-listpicker/blob/master/src/filterable-listpicker.ts" target="_blank">here</a> to get a better sense, feel free to fork it and mess around. And see the documentation on exactly how to use it <a href="https://github.com/davecoffin/nativescript-filterable-listpicker" target="_blank">here</a>.</p>

</div>

<div style="text-align: center; margin: 50px 0px;"><img src="https://github.com/davecoffin/nativescript-filterable-listpicker/raw/master/assets/filterablelist.gif?raw=true" style="width: 80%; max-width: 350px;" /></div>

<div>
    <p>Reach out with any questions, I'm happy to help anyone and everyone. And <a href="https://twitter.com/davecoffin">follow me on twitter</a>!</p>

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