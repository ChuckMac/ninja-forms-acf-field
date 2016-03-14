<?php
/**
 * Advanced Custom Fields: Ninja Forms Field
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 */ 

class acf_field_ninja_forms extends acf_field {
  
  /*
  *  __construct
  *
  *  This function will setup the field type data
  *
  *  @type  function
  *  @date  5/03/2014
  *  @since 5.0.0
  *
  *  @param n/a
  *  @return  n/a
  */
  function __construct() {
    // vars
    $this->name = 'ninja_forms_field';
    $this->label = __( 'Ninja Forms' );
    $this->category = __( 'Relational', 'acf'); // Basic, Content, Choice, etc
    $this->defaults = array(
      'multiple' => 1,
      'allow_null' => 0,
      'allow_multiple' => 0
    );

    // do not delete!
    parent::__construct();
  }
  
  
  /*
  *  render_field_settings()
  *
  *  Create extra settings for your field. These are visible when editing a field
  *
  *  @type  action
  *  @since 3.6
  *  @date  23/01/13
  *
  *  @param $field (array) the $field being edited
  *  @return  n/a
  */
  function render_field_settings( $field ) {
    
    /*
    *  acf_render_field_setting
    *
    *  This function will create a setting for your field. Simply pass the $field parameter and an array of field settings.
    *  The array of settings does not require a `value` or `prefix`; These settings are found from the $field array.
    *
    *  More than one setting can be added by copy/paste the above code.
    *  Please note that you must also have a matching $defaults value for the field name (font_size)
    */
    
    acf_render_field_setting( $field, array(
      'label' => 'Allow Null?',
      'type'  => 'radio',
      'name'  => 'allow_null',
      'choices' =>  array(
        1 =>  __( 'Yes', 'acf' ),
        0 =>  __( 'No', 'acf' ),
      ),
      'layout'  =>  'horizontal'
    ));
    acf_render_field_setting( $field, array(
      'label' => 'Allow Multiple?',
      'type'  => 'radio',
      'name'  => 'allow_multiple',
      'choices' =>  array(
        1 =>  __( 'Yes', 'acf' ),
        0 =>  __( 'No', 'acf' ),
      ),
      'layout'  =>  'horizontal'
    ));

  }
  
    
  /*
  *  render_field()
  *
  *  Create the HTML interface for your field
  *
  *  @param $field (array) the $field being rendered
  *
  *  @type  action
  *  @since 3.6
  *  @date  23/01/13
  *
  *  @param $field (array) the $field being edited
  *  @return  n/a
  */
  function render_field( $field ) {
    
    /*
    *  Review the data of $field.
    *  This will show what data is available
    */
    
    // vars
    $field = array_merge($this->defaults, $field);
    $choices = array();
    $forms = Ninja_Forms()->form()->get_forms();

    if( $forms ) {
      foreach( $forms as $form ) {
        $choices[ $form->get_id() ] = $form->get_setting('title');
      }
    }

    // override field settings and render
    $field['choices'] = $choices;
    $field['type'] = 'select';
    ?>
      <select name="<?php echo $field['name'];echo ( true == $field['allow_multiple'] ? '[]' : null );?>" id="<?php echo $field['name'];?>" <?php echo ( true == $field['allow_multiple'] ? 'multiple' : null ); ?>>
        <?php 
        foreach ($field['choices'] as $key => $value) {
          $selected = '';
          if( is_array( $field['value'] ) && in_array( $key, $field['value'] ) ) {
            $selected = ' selected="selected"';
          } elseif( $field['value'] == $key ) {
            $selected = ' selected="selected"';
          }
          ?>
          <option value="<?php echo $key; ?>"<?php echo $selected;?>><?php echo $value; ?></option>
          <?php
        }
        ?>
      </select>
    <?php
  }

  
  /*
  *  format_value()
  *
  *  This filter is appied to the $value after it is loaded from the db and before it is returned to the template
  *
  *  @type  filter
  *  @since 3.6
  *  @date  23/01/13
  *
  *  @param $value (mixed) the value which was loaded from the database
  *  @param $post_id (mixed) the $post_id from which the value was loaded
  *  @param $field (array) the field array holding all the field options
  *
  *  @return  $value (mixed) the modified value
  */
  function format_value( $value, $post_id, $field ) {
    // format value
    if( !$value ) {
      return false;
    }

    if( 'null' == $value ) {
      return false;
    }

    // load form data
    if( is_array($value) ) {
      foreach( $value as $k => $v ) {
          $form = ninja_forms_get_form_by_id( $v );
          $value[ $k ] = $form;
        }
        $value = (object) $value;
    } else {
      $value = ninja_forms_get_form_by_id( $value );
    }

    // return value
    return $value;
  }

}

// create field
new acf_field_ninja_forms();
