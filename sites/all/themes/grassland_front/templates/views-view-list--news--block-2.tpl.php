<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * - $title : The title of this group of rows.  May be empty.
 * - $options['type'] will either be ul or ol.
 * @ingroup views_templates
 */
?>
<?php
$uri = current_path();
$uri_arr = explode('/', $uri);

$is_active = !isset($uri_arr[2]) || $uri_arr[2] === 'all' ? true : false;
if( isset($uri_arr[1]) ){
    $uri_arr[2] = 'all';
}
$new_uri = implode('/', $uri_arr);
?>
<?php print $wrapper_prefix; ?>
<?php if (!empty($title)) : ?>
    <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php print $list_type_prefix; ?>
    <li><a href="/<?php print $new_uri; ?>" class="<?php print $is_active ? 'active' : '';?>">全部</a></li>
<?php foreach ($rows as $id => $row): ?>
    <li class="<?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
<?php endforeach; ?>
<?php print $list_type_suffix; ?>
<?php print $wrapper_suffix; ?>