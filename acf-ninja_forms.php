<?php
/*
Plugin Name: Advanced Custom Fields: Ninja Forms Field
Plugin URI: https://github.com/chuckmac/ninja-forms-acf-field
Description: ACF field to select one or many Ninja Forms
Version: 3.0.0
Author: chuckmac
Author URI: https://www.chuckmac.info
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

***
Derived from Advanced Custom Fields: Gravity Forms Field (https://github.com/stormuk/Gravity-Forms-ACF-Field)
  by @adam_pope (http://www.stormconsultancy.co.uk)
***

*/

// $version = 5 and can be ignored until ACF6 exists
function include_field_types_ninja_forms( $version ) {

  include_once('acf-ninja_forms-v5.php');

}
add_action('acf/include_field_types', 'include_field_types_ninja_forms');

?>
