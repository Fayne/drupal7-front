<?php

/**
 * @file
 * Default simple view template to display a rows in a grid.
 *
 * - $rows contains a nested array of rows. Each row contains an array of
 *   columns.
 *
 * @ingroup views_templates
 */
?>
<div class="gl-title gl-title-lg"><?php echo empty($title) ? '管理团队' : $title;?></div>
<div>如有管理团队以外的员工联系您，您可拨打我们的办公室电话核实员工身份。</div>
<div class="row section-distance-top <?php print $class; ?>"<?php print $attributes; ?>>
    <?php foreach ($rows as $row_number => $columns): ?>
        <?php foreach ($columns as $column_number => $item): ?>
        <div class="col-md-3 col-sm-6 staff-item text-center section-distance-bottom">
            <?php print $item; ?>
        </div>
        <?php endforeach; ?>
    <?php endforeach; ?>
</div>