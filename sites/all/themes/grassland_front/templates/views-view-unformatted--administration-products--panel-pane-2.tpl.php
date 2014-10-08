<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<div class="row">
    <?php foreach ($rows as $id => $row): ?>
        <div class="col-md-12 <?php if ($classes_array[$id]) { print $classes_array[$id];  } ?>">
            <?php print $row; ?>
        </div>
    <?php endforeach; ?>
</div>