<!DOCTYPE html>
<html lang="en">

<head>
    <?php print $head; ?>
    <title><?php print $head_title; ?></title>
    <?php print $styles; ?>
    <?php print $scripts; ?>
</head>
<body class="<?php print $classes; ?>" <?php print $attributes; ?>>
    <div id="skip-link">
        <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
    </div>
    <?php print $page_top; ?>
    <?php print $page; ?>
    <?php print $page_bottom; ?>
    <script type="text/javascript" src="/sites/all/themes/custom/grassland_admin/bootstrap/dist/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="/sites/all/themes/custom/grassland_admin/js/jquery.dcjqaccordion.2.7.js"></script>
    <script type="text/javascript" src="/sites/all/themes/custom/grassland_admin/js/jquery.scrollTo.min.js"></script>
    <script type="text/javascript" src="/sites/all/themes/custom/grassland_admin/js/jquery.nicescroll.js"></script>
    <script type="text/javascript" src="/sites/all/themes/custom/grassland_admin/js/respond.min.js"></script>
    <script type="text/javascript" src="/sites/all/themes/custom/grassland_admin/js/common-scripts.js"></script>
</body>
</html>