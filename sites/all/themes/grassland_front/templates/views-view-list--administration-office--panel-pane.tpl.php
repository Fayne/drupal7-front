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
<?php print $wrapper_prefix; ?>
<div class="gl-title gl-title-lg"><?php echo empty($title) ? '办公室' : $title;?></div>
<?php print $list_type_prefix; ?>
<?php foreach ($rows as $id => $row): ?>
    <li class="<?php print $classes_array[$id]; ?>"><span class="glyphicon glyphicon-map-marker"></span><?php print $row; ?></li>
<?php endforeach; ?>
<?php print $list_type_suffix; ?>
<?php print $wrapper_suffix; ?>
<div class="office-time"><span class="main-color">工作时间</span> 周一至周五 上午8：00-下午5：00</div>