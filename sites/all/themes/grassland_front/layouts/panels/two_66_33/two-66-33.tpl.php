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
 * @see adaptivetheme_preprocess_two_66_33()
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
<?php if ($content['two_66_33_top']): ?>
    <div class="row">
        <div class="col-md-12 about-views-header">
            <?php print $content['two_66_33_top']; ?>
        </div>
    </div>
<?php endif; ?>
    <div class="row">
        <div class="col-md-8 about-views-main region-two-66-33-first">
            <?php print $content['two_66_33_first']; ?>
        </div>
        <div class="col-md-4 office-view-list region-two-66-33-second">
            <?php print $content['two_66_33_second']; ?>
        </div>
    </div>
    <div class="row section-inner-bottom">
        <div class="col-md-12 "></div>
    </div>
<?php if ($content['two_66_33_bottom']): ?>
    <div class="row region-two-66-33-bottom">
        <div class="col-md-12 staff-views-list">
            <div class="staff-list-container">
                <?php print $content['two_66_33_bottom']; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php print $panel_suffix; ?>