=== Plugin Name ===
Contributors: (this should be a list of wordpress.org userid's)
Donate link: http://zaroutski.com
Tags: comments, spam
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Organise code inside a theme in a clean yet simple MVC-like way.

== Description ==

Status of README: WIP

This plugin provides a framework to organise code inside a theme that follows a simple MVC structure. You can define
elements of your theme by adding controllers, models and views.

Then, add one line of code to your WordPress template file and the view component will be rendered.

== Installation ==

1. Upload `az-elements` directory to the `/wp-content/plugins/` directory
2. Activate plugin through the 'Plugins' menu in WordPress
3. Create the following directory structure inside your theme directory:

```
<your-theme>
    |--> az-elements
        |--> [name-of-elemement-1]
        |--> [name-of-elemement-2]

        for example:

        |--> contact-form
            |--> contact-form-controller.php
            |--> contact-form-view.php
        |--> people-tiles
            |--> people-tiles-controller.php
            |--> people-tiles-view.php
```

4. Create  two files in each of the elements' directory:

    a. "<element>-controller.php"
    b. "<element>-view.php"

The controller file must be of the following format:

`<?php

namespace AZ;

class Contact_Form_Controller extends Controller {

    public function run() {

        // Set variables
        $this->set_variable( 'variable_name', '123' );
        $this->set_variable( 'variable_name_2', [ 1, 2, 3, 'a' ] );

        // Define the view template
        $this->set_view_template('contact-form');

    }

}

?>`

The view file is just a PHP file that contains HTML and smalled amount of PHP for injecting variables set up for the view.

`<h1>Example of view template for Contact Form element</h1>

<p>The value of variable $variable_name is <?= $variable_name; ?></p>

?>`

5. Add custom SASS files to your elements:

You can add custom SASS files to your elements by creating `<element>/scss` directory and placing the .scss files there.

You will need to register your custom .scss files with the theme so they can compiled and included in the builds. For Sage theme, for example, add the following lines to `<theme>/assets/styles/main.scss` file:

`
// Elements custom .scss
@import "../../az-elements/tile/scss/dat";
@import "../../az-elements/hero/scss/main";

`

== Frequently Asked Questions ==

= What is this for? =

This plugin introduces very weak rules on how to structure your code inside the WordPress theme to allow simple
separation between business and presentation logic.

= Why would I use it? =

If you know what I am talking about when I mention controllers, models and views then you might appreciate the
simplicity (yet usefulness) of the set up of this plugin. If you are not sure what this all means, you might want to
read up on the the MVC design pattern.

= How do I use it? =

Please refer to examples for code snippets illustrations. But in short here how it goes:

1. Create file/directory structure in your theme required for this plugin
2. Create a controller for a new theme element that you want to render
3. Run code in this method that would prepare data for the view (make calculations, query database etc.)
4. Set up variables for the view
5. Create a view template for the theme element to be rendered
6. Add a call (to any of the theme templates) `<?= AZ\Elements::render( '<name-of-controller>' ); ?>` with
the element name as a parameter.

= Your `gulp` hangs on compiling a build?

Make sure that all the references to .scss (in `<theme>/assets/styles/main.scss`) are correct

== Screenshots ==

TBA

== Changelog ==

= 1.0 =
* Initial release.
