<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php
$counter = count($rows);
$output = end($rows);
print '<h3>' . $counter . $output . '</h3>';
?>