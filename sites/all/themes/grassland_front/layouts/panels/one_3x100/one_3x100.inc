<?php

/**
 * @file
 * Implementation of hook_panels_layouts
 */
function grassland_front_one_3x100_panels_layouts() {
  $items['one_3x100'] = array(
    'title' => t('Grassland 3x100 Layout'),
    'category' => t('Grassland Front Layout - 1 column'),
    'icon' => 'one_3x100.png',
    'theme' => 'one_3x100',
    'admin css' => 'one_3x100.admin.css',
    'theme arguments' => array('id', 'content'),
    'regions' => array(
      'one_3x100_top'    => t('Top'),
      'one_3x100_middle'  => t('Middle'),
      'one_3x100_bottom' => t('Bottom'),
    ),
    // Grassland Products
    'type' => 'one',
    'options' => array(
      'one-3x100' => 'default',
      'one-3x100-stack' => 'stack',
    ),
    'styles' => array(
      'one-3x100' => array(
        'css' => array(
          '100' => array('.one-3x100 > .region-one-3x100-first' => 'width:100%'),
        ),
      ),
      'one-3x100-stack' => array(
        'css' => array(
          'fdw' => array('.one-3x100 > .region' => 'float:none;display:block;width:100%;clear:both'),
        ),
      ),
    ),
  );

  return $items;
}

/**
 * Preprocess variables for one-3x100.php
 */
function template_preprocess_one_3x100(&$vars) {
  $vars['panel_prefix'] = '';
  $vars['panel_suffix'] = '';
}
