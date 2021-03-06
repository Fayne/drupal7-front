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
 * Overwrite theme_button()
 * @file template.php
 * !replace my_theme with the name of your active theme
 */
function grassland_admin_button($element)
{
    // Add some extra conditions to make sure we're only adding
    // the classto the right submit button
    $primary_buttons = array(
        'edit-submit',
        'edit-field-image-und-0-upload-button',
        'edit-field-product-thumb-und-0-upload-button',
        'edit-field-product-thumb-und-0-remove-button',
    );
    $warning_buttons = array(
        'edit-preview',
        'edit-cancel',
    );
    $danger_buttons = array(
        'edit-delete',
        'edit-field-image-und-0-remove-button',
        'edit-field-career-upload-und-0-remove-button',
    );
    $primary_buttons_names = array(
        'field_image_und_0_upload_button',
        'field_career_upload_und_0_upload_button',
        'field_product_thumb_und_0_upload_button',
        'op',
    );

    if (in_array($element['element']['#id'], $primary_buttons)) {
        // Now add our custom class
        $element['element']['#attributes']['class'] = array('btn btn-primary');
    }
    else if (in_array($element['element']['#id'], $warning_buttons)) {
        // Now add our custom class
        $element['element']['#attributes']['class'] = array('btn btn-warning');
    }
    else if (in_array($element['element']['#id'], $danger_buttons)) {
        // Now add our custom class
        $element['element']['#attributes']['class'] = array('btn btn-danger');
    }
    else if (in_array($element['element']['#name'], $primary_buttons_names)){
        // Now add our custom class(upload button will reload)
        $element['element']['#attributes']['class'] = array('btn btn-primary');
    }

    return theme_button($element);
}

//function grassland_admin_node_create ($node) {
//    // redirect node list(machine name)
//    $redirect_nodes = array(
//        'slider',
//        'about',
//        'product',
//        'article',
//        'career',
//        'faqs',
//        'office',
//        'staff',
//    );
//
//    if (in_array($node->type, $redirect_nodes)) {
//        drupal_goto('/admin/content/' . $node->type);
//    }
//}

function grassland_admin_form_alter (&$form, &$form_state, $form_id) {
    // redirect node list
    $redirect_nodes = array(
        'slider_node_form',
        'about_node_form',
        'product_node_form',
        'article_node_form',
        'career_node_form',
        'faqs_node_form',
        'office_node_form',
        'staff_node_form',
    );

    if (in_array($form_id, $redirect_nodes)) {
        $form['actions']['submit']['#submit'][] = '_grassland_redirect_submit';
    }
}

function _grassland_redirect_submit($form, &$form_state) {
    $node = node_form_submit_build_node($form, $form_state);
    $form_state['redirect'] = 'admin/content/' . $node->type;
}