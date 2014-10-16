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
<div class="gl-title gl-title-lg"><?php echo empty($title) ? '办公室' : $title;?></div>
<table class="<?php print $class; ?>"<?php print $attributes; ?>>
    <?php if (!empty($caption)) : ?>
        <caption><?php print $caption; ?></caption>
    <?php endif; ?>

    <tbody>
    <?php foreach ($rows as $row_number => $columns): ?>
        <tr <?php if ($row_classes[$row_number]) { print 'class="' . $row_classes[$row_number] .'"';  } ?>>
            <?php foreach ($columns as $column_number => $item): ?>
                <td <?php if ($column_classes[$row_number][$column_number]) { print 'class="' . $column_classes[$row_number][$column_number] .'"';  } ?>>
                    <?php print $item; ?>
                </td>
            <?php endforeach; ?>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div class="office-time"><span class="main-color">工作时间</span> 周一至周五 上午8：00-下午5：00</div>