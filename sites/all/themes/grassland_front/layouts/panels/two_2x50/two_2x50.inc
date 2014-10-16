<?php

/**
 * @file
 * Implementation of hook_panels_layouts
 */
function grassland_front_two_2x50_panels_layouts() {
    $items['two_2x50'] = array(
        'title' => t('Grassland 2x50 Layout'),
        'category' => t('Grassland Front Layout - 2 column'),
        'icon' => 'two_2x50.png',
        'theme' => 'two_2x50',
        'admin css' => 'two_2x50.admin.css',
        'theme arguments' => array('id', 'content'),
        'regions' => array(
            'two_2x50_top'    => t('Top'),
            'two_2x50_middle'    => t('Middle'),
            'two_2x50_first'  => t('Left'),
            'two_2x50_second' => t('Right'),
        ),
        // AT Core
        'type' => 'two',
        'options' => array(
            'two-2x50' => 'default',
            'two-2x50-stack' => 'stack',
        ),
        'styles' => array(
            'two-2x50' => array(
                'css' => array(
                    '50' => array('.two-2x50 > .region-two-2x50-first' => 'width:50%', '.two-2x50 > .region-two-2x50-second' => 'width:50%'),
                ),
            ),
            'two-2x50-stack' => array(
                'css' => array(
                    'fdw' => array('.two-2x50 > .region' => 'float:none;display:block;width:100%;clear:both'),
                ),
            ),
        ),
    );

    return $items;
}

/**
 * Preprocess variables for two-2x50.php
 */
function template_preprocess_two_2x50(&$vars) {
    $vars['panel_prefix'] = '';
    $vars['panel_suffix'] = '';
}
