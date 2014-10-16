<?php
/**
 * @file
 * Adativetheme implementation to present a Panels layout.
 *
 * Available variables:
 * - $content: An array of content, each item in the array is keyed to one
 *   panel of the layout.
 * - $css_id: unique id if present.
 * - $panel_prefix: prints a wrapper when this template is used in certain context,
 *   such as when rendered by Display Suite or other module - the wrapper is
 *   added by Adaptivetheme in the appropriate process function.
 * - $panel_suffix: closing element for the $prefix.
 *
 * @see adaptivetheme_preprocess_one_3x100()
 * @see adaptivetheme_preprocess_node()
 * @see adaptivetheme_process_node()
 */

// Ensure variables are always set. In the last hours before cutting a stable
// release I found these are not set when inside a Field Collection using Display
// Suite, even though they are initialized in the templates preprocess function.
// This is a workaround, that may or may not go away.
$panel_prefix = isset($panel_prefix) ? $panel_prefix : '';
$panel_suffix = isset($panel_suffix) ? $panel_suffix : '';
?>
<?php print $panel_prefix; ?>
<?php if ($content['one_3x100_top']): ?>
    <div class="row">
        <div class="col-md-12">
            <?php print $content['one_3x100_top']; ?>
        </div>
    </div>
<?php endif; ?>
<?php if ($content['one_3x100_middle']): ?>
    <div class="row">
        <div class="col-md-12">
            <?php print $content['one_3x100_middle']; ?>
        </div>
    </div>
<?php endif; ?>
<?php if ($content['one_3x100_bottom']): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <?php print $content['one_3x100_bottom']; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php print $panel_suffix; ?>