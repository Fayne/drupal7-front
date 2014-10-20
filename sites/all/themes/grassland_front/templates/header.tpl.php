<!-- default header -->
<div class="container-fluid header hidden-xs hidden-sm">
    <header class="container">
        <div class="row">
            <?php if ($logo): ?>
                <div class="col-md-6 header_left">
                    <a href="/home"><img class="logo" src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>"/></a>
                    <?php print $domain_switcher_default; ?>
                </div>
            <?php endif; ?>
            <div class="col-md-6">
                <div class="header_right clearfix">
                    <div class="header_contacts">
                        <?php include 'contact.tpl.php'; ?>
                    </div>
                    <div class="header_soc_search">
                        <?php print $seach_block_form; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main Navigation -->
    <nav class="row">
        <div class="col-md-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php print $navigation['default']; ?>
                    </div>
                </div>
            </div>

        </div>
    </nav>
</div>
<!-- // end default header -->
<!-- mobile header -->
<nav class="navbar navbar-static-top header-mobile hidden-md hidden-lg" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#grassland-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"
               href="/home"><?php echo $logo ? "<img src=\"{$logo}\" alt=\"" . t("Home") . "\"/>" : $site_name ?></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="grassland-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="search-block clearfix">
                    <?php print $seach_block_form; ?>
                </li>
            </ul>
            <?php print $navigation['mobile']; ?>
            <ul class="nav navbar-nav navbar-right">
                <?php print $domain_switcher_mobile; ?>
                <li class="contact-block clearfix">
                    <div class="header_contacts">
                        <?php include 'contact.tpl.php'; ?>
                    </div>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
<!-- // mobile header-->