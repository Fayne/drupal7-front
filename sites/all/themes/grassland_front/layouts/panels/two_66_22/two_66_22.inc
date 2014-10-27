<?php

/**
 * @file
 * Implementation of hook_panels_layouts
 */
function grassland_front_two_66_22_panels_layouts() {
  $items['two_66_22'] = array(
    'title' => t('Grassland 66-22 Layout'),
    'category' => t('Grassland Front Layout - 2 column'),
    'icon' => 'two_66_22.png',
    'theme' => 'two_66_22',
    'admin css' => 'two_66_22.admin.css',
    'theme arguments' => array('id', 'content'),
    'regions' => array(
      'two_66_22_top'    => t('Top (conditional)'),
      'two_66_22_first'  => t('Left'),
      'two_66_22_second' => t('Right'),
      'two_66_22_bottom' => t('Bottom (conditional)'),
    ),
    // AT Core
    'type' => 'two',
    'options' => array(
      'two-66-22' => 'default',
      'two-66-22-stack' => 'stack',
    ),
    'styles' => array(
      'two-66-22' => array(
        'css' => array(
          '66' => array('.two-66-22 > .region-two-66-22-first' => 'width:66.666666%'),
          '22' => array('.two-66-22 > .region-two-66-22-second' => 'width:25%'),
        ),
      ),
      'two-66-22-stack' => array(
        'css' => array(
          'fdw' => array('.two-66-22 > .region' => 'float:none;display:block;width:100%;clear:both'),
        ),
      ),
    ),
  );

  return $items;
}

/**
 * Preprocess variables for two-66-22.php
 */
function template_preprocess_two_66_22(&$vars) {
  $vars['panel_prefix'] = '';
  $vars['panel_suffix'] = '';
}
