<?php

/**
 * @file
 * This template is used to print a single field in a view.
 *
 * It is not actually used in default Views, as this is registered as a theme
 * function which has better performance. For single overrides, the template is
 * perfectly okay.
 *
 * Variables available:
 * - $view: The view object
 * - $field: The field handler object that can process the input
 * - $row: The raw SQL result that can be used
 * - $output: The processed output that will normally be used.
 *
 * When fetching output from the $row, this construct should be used:
 * $data = $row->{$field->field_alias}
 *
 * The above will guarantee that you'll always get the correct data,
 * regardless of any changes in the aliasing that might happen if
 * the view is modified.
 */
?>
<?php
$uri = trim($_SERVER["REQUEST_URI"], '/');
$uri_arr = explode('/', $uri);
$new_uri_arr = explode('|', $output);
$new_uri = current($new_uri_arr);
$content = next($new_uri_arr);

$is_active = isset($uri_arr[1]) && $uri_arr[1] == $new_uri ? true : false;
$uri_arr[1] = $new_uri;
$new_uri = implode('/', $uri_arr);

$output = '<a href="/' . $new_uri . '"' . ($is_active ? 'class="active"' : '') .'>' . $content . '</a>';
?>
<?php print $output; ?>
