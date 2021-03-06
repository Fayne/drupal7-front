<?php

include_once 'includes/custom_menu.inc';

/**
 * Implements hook_preprocess_html().
 */
function grassland_front_preprocess_html(&$variables) {

    $theme_path = path_to_theme();

    drupal_add_html_head(
        array(
            '#tag' => 'meta',
            '#attributes' => array(
                'name' => 'viewport',
                'content' => 'width=device-width, initial-scale=1',
            ),
        ), 'centum:viewport_meta'
    );
}

function grassland_front_preprocess_page(&$vars) {

    // overlay
    if (isset($vars['node']->type) && isset($vars['node']->title) && $vars['node']->type == 'webform' && $vars['node']->title == 'Prospect' ) {
        $vars['theme_hook_suggestions'][] = 'page__prospect';
    }
    else if( isset($vars['node']->type) && $vars['node']->type == 'overlay'){
        $vars['theme_hook_suggestions'][] = 'page__overlay';
    }

    // add jqueryui
    drupal_add_library('system', 'ui');
    drupal_add_library('system', 'ui.slider');

    // navigation
    $custom_main_menu = _custom_main_menu_render_superfish();
    if (!empty($custom_main_menu['content'])) {
        $vars['navigation']['default'] = $custom_main_menu['content']['default'];
        $vars['navigation']['mobile'] = $custom_main_menu['content']['mobile'];
    }

    //search block form
    $seach_block_form = drupal_get_form('search_block_form');
    $seach_block_form['#id'] = 'searchform';
    $seach_block_form['#attributes']['class'][''] = 'search';
    $seach_block_form['search_block_form']['#id'] = 's';
    $seach_block_form['search_block_form']['#attributes']['class'][] = 'search-text-box';
    $seach_block_form['search_block_form']['#prefix'] = '<button class="button_search glyphicon glyphicon-search"></button>';
    $seach_block_form['search_block_form']['#theme_wrappers'] = array();    // overwitten bootstrap default theme
    $vars['seach_block_form'] = drupal_render($seach_block_form);

    // Domain Switcher
    $vars['domain_switcher_default'] = grassland_front_default_domain_switcher();
    $vars['domain_switcher_mobile'] = grassland_front_mobile_domain_switcher();
}

function grassland_front_format_comma_field($field_category, $node, $limit = NULL) {
    $category_arr = array();
    $category = '';
    $field = field_get_items('node', $node, $field_category);

    if (!empty($field)) {
        foreach ($field as $item) {
            $term = taxonomy_term_load($item['tid']);
            if ($term) {
                $category_arr[] = l($term->name, 'taxonomy/term/' . $item['tid']);
            }

            if ($limit) {
                if (count($category_arr) == $limit) {
                    $category = implode(', ', $category_arr);
                    return $category;
                }
            }
        }
    }
    $category = implode(', ', $category_arr);

    return $category;
}

function grassland_front_form_alter(&$form, &$form_state, $form_id) {

    switch ($form_id) {

        case 'search_block_form':
            $form['search_block_form']['#prefix'] = '<button class="button_search glyphicon glyphicon-search"></button>';
            $form['search_block_form']['#theme_wrappers'] = array();
            break;

        case 'contact_site_form':

            $description = theme_get_setting('contact_form_description', 'aqua');
            if (!empty($description)) {
                $form['#prefix'] = $description;
            }
            break;
    }
}

function grassland_front_table($variables) {
    $header = $variables['header'];
    $rows = $variables['rows'];
    $attributes = $variables['attributes'];
    $caption = $variables['caption'];
    $colgroups = $variables['colgroups'];
    $sticky = $variables['sticky'];
    $empty = $variables['empty'];

    // Add sticky headers, if applicable.
    if (count($header) && $sticky) {
        drupal_add_js('misc/tableheader.js');
        // Add 'sticky-enabled' class to the table to identify it for JS.
        // This is needed to target tables constructed by this function.
        $attributes['class'][] = 'sticky-enabled';
    }
    $attributes['class'][] = 'grassland_front_table'; // added default table style.

    $output = '<table' . drupal_attributes($attributes) . ">\n";

    if (isset($caption)) {
        $output .= '<caption>' . $caption . "</caption>\n";
    }

    // Format the table columns:
    if (count($colgroups)) {
        foreach ($colgroups as $number => $colgroup) {
            $attributes = array();

            // Check if we're dealing with a simple or complex column
            if (isset($colgroup['data'])) {
                foreach ($colgroup as $key => $value) {
                    if ($key == 'data') {
                        $cols = $value;
                    } else {
                        $attributes[$key] = $value;
                    }
                }
            } else {
                $cols = $colgroup;
            }

            // Build colgroup
            if (is_array($cols) && count($cols)) {
                $output .= ' <colgroup' . drupal_attributes($attributes) . '>';
                $i = 0;
                foreach ($cols as $col) {
                    $output .= ' <col' . drupal_attributes($col) . ' />';
                }
                $output .= " </colgroup>\n";
            } else {
                $output .= ' <colgroup' . drupal_attributes($attributes) . " />\n";
            }
        }
    }

    // Add the 'empty' row message if available.
    if (!count($rows) && $empty) {
        $header_count = 0;
        foreach ($header as $header_cell) {
            if (is_array($header_cell)) {
                $header_count += isset($header_cell['colspan']) ? $header_cell['colspan'] : 1;
            } else {
                $header_count++;
            }
        }
        $rows[] = array(array('data' => $empty, 'colspan' => $header_count, 'class' => array('empty', 'message')));
    }

    // Format the table header:
    if (count($header)) {
        $ts = tablesort_init($header);
        // HTML requires that the thead tag has tr tags in it followed by tbody
        // tags. Using ternary operator to check and see if we have any rows.
        $output .= (count($rows) ? ' <thead><tr>' : ' <tr>');
        foreach ($header as $cell) {
            $cell = tablesort_header($cell, $header, $ts);
            $output .= _theme_table_cell($cell, TRUE);
        }
        // Using ternary operator to close the tags based on whether or not there are rows
        $output .= (count($rows) ? " </tr></thead>\n" : "</tr>\n");
    } else {
        $ts = array();
    }

    // Format the table rows:
    if (count($rows)) {
        $output .= "<tbody>\n";
        $flip = array('even' => 'odd', 'odd' => 'even');
        $class = 'even';
        foreach ($rows as $number => $row) {
            $attributes = array();

            // Check if we're dealing with a simple or complex row
            if (isset($row['data'])) {
                foreach ($row as $key => $value) {
                    if ($key == 'data') {
                        $cells = $value;
                    } else {
                        $attributes[$key] = $value;
                    }
                }
            } else {
                $cells = $row;
            }
            if (count($cells)) {
                // Add odd/even class
                if (empty($row['no_striping'])) {
                    $class = $flip[$class];
                    $attributes['class'][] = $class;
                }

                // Build row
                $output .= ' <tr' . drupal_attributes($attributes) . '>';
                $i = 0;
                foreach ($cells as $cell) {
                    $cell = tablesort_cell($cell, $header, $ts, $i++);
                    $output .= _theme_table_cell($cell);
                }
                $output .= " </tr>\n";
            }
        }
        $output .= "</tbody>\n";
    }

    $output .= "</table>\n";
    return $output;
}

function grassland_front_status_messages(&$variables) {
    $display = $variables['display'];
    $output = '';

    $message_info = array(
        'status' => array(
            'heading' => 'Status message',
            'class' => 'success information',
        ),
        'error' => array(
            'heading' => 'Error message',
            'class' => 'error warning',
        ),
        'warning' => array(
            'heading' => 'Warning message',
            'class' => 'warning',
        ),
    );

    foreach (drupal_get_messages($display) as $type => $messages) {
        $message_class = $type != 'warning' ? $message_info[$type]['class'] : 'warning';
        $output .= "<div class=\"notification alert alert-block alert-$message_class $message_class closable fade in\">\n";
        if (!empty($message_info[$type]['heading'])) {
            $output .= '<h2 class="element-invisible">' . $message_info[$type]['heading'] . "</h2>\n";
        }
        if (count($messages) > 1) {
            $output .= " <ul>\n";
            foreach ($messages as $message) {
                $output .= '  <li>' . $message . "</li>\n";
            }
            $output .= " </ul>\n";
        } else {
            $output .= $messages[0];
        }
        $output .= "</div>\n";
    }
    return $output;
}

function grassland_front_preprocess_node(&$variables) {
    // overlay
    if (isset($variables['type']) && isset($variables['title']) && $variables['type'] == 'webform' && $variables['title'] == 'Prospect') {
        $variables['theme_hook_suggestions'][] = 'node__prospect';
    }

    $variables['view_mode'] = $variables['elements']['#view_mode'];
    // Provide a distinct $teaser boolean.
    $variables['teaser'] = $variables['view_mode'] == 'teaser';
    $variables['node'] = $variables['elements']['#node'];
    $node = $variables['node'];

    $variables['date'] = format_date($node->created);
    $variables['name'] = theme('username', array('account' => $node));

    $uri = entity_uri('node', $node);
    $variables['node_url'] = url($uri['path'], $uri['options']);
    $variables['title'] = check_plain($node->title);
    $variables['page'] = $variables['view_mode'] == 'full' && node_is_page($node);

    // Flatten the node object's member fields.
    $variables = array_merge((array) $node, $variables);

    // Helpful $content variable for templates.
    $variables += array('content' => array());
    foreach (element_children($variables['elements']) as $key) {
        $variables['content'][$key] = $variables['elements'][$key];
    }

    // Make the field variables available with the appropriate language.
    field_attach_preprocess('node', $node, $variables['content'], $variables);

    // Display post information only on certain node types.
    if (variable_get('node_submitted_' . $node->type, TRUE)) {
        $variables['display_submitted'] = TRUE;
        //$variables['submitted'] = t('Submitted by !username on !datetime', array('!username' => $variables['name'], '!datetime' => $variables['date']));
        $submitted = '<p class="post_meta">';
        $submitted .= '<span class="calendar">' . format_date($node->created, 'custom', 'Y年m月') . '</span>';
        $submitted .= '<span class="author"> / ' . $variables['name'] . '</span>';
        if (!empty($node->comment_count) && false) {
            $submitted .= '<span class="comments"><a href="' . url('node/' . $node->nid) . '#comments"> ' . $node->comment_count . ' ' . t('Comments') . '</a></span>';
        }

        $tags = grassland_front_format_comma_field('field_tags', $node);
        if (!empty($tags) && false) {
            $submitted .= '<span class="tags">' . $tags . '</span>';
        }
        $submitted .= '</p>';

        $variables['submitted'] = $submitted;
        $variables['user_picture'] = theme_get_setting('toggle_node_user_picture') ? theme('user_picture', array('account' => $node)) : '';
    } else {
        $variables['display_submitted'] = FALSE;
        $variables['submitted'] = '';
        $variables['user_picture'] = '';
    }

    // Gather node classes.
    $variables['classes_array'][] = drupal_html_class('node-' . $node->type);
    if ($variables['promote']) {
        $variables['classes_array'][] = 'node-promoted';
    }
    if ($variables['sticky']) {
        $variables['classes_array'][] = 'node-sticky';
    }
    if (!$variables['status']) {
        $variables['classes_array'][] = 'node-unpublished';
    }
    if ($variables['teaser']) {
        $variables['classes_array'][] = 'node-teaser';
    }
    if (isset($variables['preview'])) {
        $variables['classes_array'][] = 'node-preview';
    }

    // Clean up name so there are no underscores.
    $variables['theme_hook_suggestions'][] = 'node__' . $node->type;
    $variables['theme_hook_suggestions'][] = 'node__' . $node->nid;
}

// Remove Height and Width Inline Styles from Drupal Images
function grassland_front_preprocess_image(&$variables) {
    foreach (array('width', 'height') as $key) {
        unset($variables[$key]);
    }
}

function grassland_front_tagadelic_weighted(array $vars) {
    $terms = $vars['terms'];
    $output = '<div class="tagcloud">';

    foreach ($terms as $term) {
        $output .= l($term->name, 'taxonomy/term/' . $term->tid, array(
                    'attributes' => array(
                        'class' => array("tagadelic", "level" . $term->weight),
                        'rel' => 'tag',
                        'title' => $term->description,
                    )
                )
            ) . " \n";
    }
    if (count($terms) >= variable_get('tagadelic_block_tags_' . $vars['voc']->vid, 12)) {
        $output .= theme('more_link', array('title' => t('more tags'), 'url' => "tagadelic/chunk/{$vars['voc']->vid}"));
    }
    $output .='</div>';
    return $output;
}

function grassland_front_default_domain_switcher(){
    $domains        = domain_domains(true);
    $cur_domain     = domain_get_domain();
    $cur_domain_id  = $cur_domain['domain_id'];

    unset($domains[$cur_domain_id]);
    $output         = '<ul class="select-domain-list"><li><span class="cur-domain">'.$cur_domain['sitename'].'</span><ul class="other-domains">';

    foreach($domains as $domain){
        if( $domain['valid'])
            $output .= '<li>
                            <a href="'.$domain['path'].'home">
                                '.$domain['sitename'].'
                            </a>
                        </li>';
    }
    $output .= '</ul></li></ul>';

    return $output;
}

function grassland_front_mobile_domain_switcher() {
    $domains        = domain_domains(true);
    $cur_domain     = domain_get_domain();
    $cur_domain_id  = $cur_domain['domain_id'];
    $output         = '';

    foreach($domains as $domain){
        if( $domain['valid'])
            $output .= '<li class="domain-block '.( $cur_domain_id === $domain['domain_id'] ? ' active' : '').'">
                            <div>
                                <a href="'.$domain['path'].'home">
                                    <span class="glyphicon glyphicon-map-marker"></span>'.$domain['sitename'].'
                                </a>
                            </div>
                        </li>';
    }

    return $output;
}

function grassland_front_preprocess_search_results(&$variables) {
    global $base_path;
    drupal_add_library('system', 'ui.tabs');
    drupal_add_js('jQuery(document).ready(function(){jQuery("#tabs").tabs();});', 'inline');
    $variables['search_results'] = '';
    // get a list of node types
    $nodeTypes = node_type_get_types();
    $filterNodeTypes = array('article', 'product', 'career');
    // loop through results, group by type
    $resultTypes = array();
    foreach ($variables['results'] as $result) {
        if( in_array($result['node']->type, $filterNodeTypes) )
            $resultTypes[$result['node']->type][] = $result;
    }

    // create fieldsets for each type
    $output = '<div id="tabs">';
    $output .= '<ul>';
    $i = 0;
    foreach ($resultTypes as $resultType => $resultTypeResults) {
        $i++;
        $output .=  '<li><a href="#tabs-'.$i.'">';
        $output .=  $nodeTypes[$resultType]->name.'</a></li>';
    }
    $output .= '</ul>';
    $i = 0;
    foreach ($resultTypes as $resultType => $resultTypeResults) {
        $i++;
        $value = "";
        // loop through entries
        foreach ($resultTypeResults as $result) {
            $value .= theme('search_result', array('result' => $result, 'module' => $variables['module']));
        }
        $output .=  '<div id="tabs-'.$i.'">';
        $output .=  $value;
        $output .=  '</div>';
    }
    $output .= '</div>';

    $variables['search_results'] = $output;
}