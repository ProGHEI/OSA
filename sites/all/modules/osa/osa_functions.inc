<?php 

function _osa_installed_fields()  {
  // checkboxes
  $fields['osa_checkboxes'] = array(
    'field_name' => 'osa_checkboxes',
    'label' => t('Select some checkboxes'),
    'type' => 'list_integer',
    'cardinality' => '-1', // change this to 1 to get radio buttons instead
    'foreign keys' => array(),
    'indexes' => array(
      'value' => array(
        0 => 'value',
      ),
    ),
    'module' => 'list',
    'settings' => array(
      'allowed_values_function' => '_osa_options_list',
    ),
  );
  
  return $fields;
}

function _osa_installed_instances()  {
  // checkboxes
  $instances['osa_checkboxes'] = array(
    'field_name' => 'osa_checkboxes',
    'label' => t('Checkboxes'),
    'description' => t('Select some checkboxes'),
    'default_value' => NULL,	// add a default value here that matches your key => index values
    'display' => array(
      'default' => array(
        'label' => 'above',
        'module' => 'list',
        'settings' => array(),
        'type' => 'list_default',
        'weight' => -1,
      ),
      'teaser' => array(
        'label' => 'above',
        'settings' => array(),
        'type' => 'hidden',
        'weight' => -1,
      ),
    ),
    'required' => 1,
    'settings' => array(
      'user_register_form' => FALSE,
    ),
    'widget' => array(
      'active' => 1,
      'module' => 'options',
      'settings' => array(),
      'type' => 'options_buttons',
      'weight' => '-1',
    ),
  );
  
  return $instances;
}
/**
 * Options callback for osa_checkboxes field
 * @return - returns an indexed array as integer => string
 * 
 */

function _osa_options_list()  {
  $options = array(
    1 => 'Checkbox A',
    2 => 'Checkbox B',
    3 => 'Checkbox C',
    4 => 'Checkbox D',
    5 => 'Checkbox E',
    6 => 'Checkbox F',
  );
  return $options;
}