<?php

include_once 'includes/custom_menu.inc';

/**
 * @file
 * template.php
 */

/**
 * Process variables for page.tpl.php
 */
function grassland_admin_process_page(&$vars)
{
    // custom left menu(argument is the machine name of menu)
    $custom_main_menu = _custom_menu_render_superfish('menu-left-menu');
    if (!empty($custom_main_menu['content'])) {
        $vars['navigation'] = $custom_main_menu['content'];
    }
}

/**
 * Returns HTML for primary and secondary local tasks.
 *
 * @param $variables
 *   An associative array containing:
 *     - primary: (optional) An array of local tasks (tabs).
 *     - secondary: (optional) An array of local tasks (tabs).
 *
 * @ingroup themeable
 * @see menu_local_tasks()
 */
function grassland_admin_menu_local_tasks(&$variables)
{
    $output = '';

    if (!empty($variables['primary'])) {
        $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
        $variables['primary']['#prefix'] .= '<ul class="nav nav-tabs nav-justified ">';
        $variables['primary']['#suffix'] = '</ul>';
        $output .= drupal_render($variables['primary']);
    }

    return $output;
}

/**
 * Implements theme_menu_tree().
 */
//function grassland_admin_menu_tree($variables) {
//    return '<ul id="nav-accordion" class="sidebar-menu">' . $variables['tree'] . '</ul>';
//}

