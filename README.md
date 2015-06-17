Ninja-Forms-ACF-Field
=======================

This is an Advanced Custom Field custom field to select one or many [Ninja Forms](https://ninjaforms.com/).

This provides a field that lets you select from a list of active Ninja Forms.

Compatibility
============

This add-on will work with:

* ACF verion 5

Installation
============

This add-on can be treated as both a WP plugin and a theme include.

*Plugin*
1. Copy the 'ninja-forms-acf-field' folder into your plugins folder
2. Activate the plugin via the Plugins admin page

*Include*
1.  Copy the 'ninja-forms-acf-field' folder into your theme folder (can use sub folders). You can place the folder anywhere inside the 'wp-content' directory
2.  Edit your functions.php file and add the code below (Make sure the path is correct to include the acf-gravity_forms.php file)

```
  include_once('acf-ninja_forms.php');
```

Using the field
===============

The field lets you pick one or many fields.

The data returned is either a Form settings array or, for multiple values, an object of [Form settings arrays](http://www.gravityhelp.com/documentation/page/Form_Object).

The following example will work with single or multiple form entries.

```
<?php 
    $ninja_form = get_field('your_form_field');
    if( function_exists( 'ninja_forms_display_form' ) && is_array( $ninja_form ) ){
        ninja_forms_display_form( $ninja_form['id'] );
    } elseif( function_exists( 'ninja_forms_display_form' ) && is_object( $ninja_form ) ){
        foreach ($ninja_form as $form) {
            ninja_forms_display_form( $form['id'] );
        }
    }
?>
```

You can find out more about the ninja forms functions to embed a form or form data on a page in their [documentation](http://docs.ninjaforms.com/category/29-global-variables)


About
=====

Version: 1.0


Credits
=======

Thanks to Adam Pope of [Storm Consultancy](http://www.stormconsultancy.co.uk) for the [Gravity Forms ACF Field](https://github.com/stormuk/Gravity-Forms-ACF-Field) plugin which this is based.

And in turn, Lewis Mcarey for the [Users Field ACF add-on](https://github.com/lewismcarey/User-Field-ACF-Add-on) on which the Gravity Forms ACF field was based.


