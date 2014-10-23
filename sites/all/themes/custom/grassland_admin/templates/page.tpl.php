<section id="container" class="<?php print $classes; ?>">
    <!--header start-->
    <header class="header white-bg">
        <div class="sidebar-toggle-box">
            <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
        </div>
        <?php if ($logo || $site_name || $site_slogan): ?>
            <a href="/home" class="logo" >
                <?php print $logo ? "<img src=\"{$logo}\" />" : ""; ?>&nbsp;<?php print $site_name ? $site_name : ""; ?>&nbsp;&gt;&nbsp;<?php print $site_slogan ? $site_slogan : ""; ?>
            </a>
        <?php endif; ?>
        <div class="top-nav ">
            <ul class="nav pull-right top-menu">
                <li>
                    <input type="text" class="form-control search" placeholder="Search">
                </li>
                <!-- user login dropdown start-->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="username"><?php print $user->name;?></span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <div class="log-arrow-up"></div>
                        <li><?php print l('<i class=" icon-suitcase"></i>'.t('Profile'), "user", array('html'=>true));?></li>
                        <li><a href="/user/logout"><i class="icon-key"></i> Log Out</a></li>
                    </ul>
                </li>
                <!-- user login dropdown end -->
            </ul>
        </div>
    </header>
    <!--header end-->
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse " tabindex="5000">
        <?php print $navigation; ?>
        </div>
    </aside>
    <!--sidebar end-->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <!-- Breadcrumbs -->
            <?php if ($breadcrumb): print $breadcrumb; endif; ?>
            <?php print $messages; ?>
            <?php print render($page['help']); ?>
            <?php if ($title): ?>
                <header class="panel-heading">
                    <?php print $title; ?>
                </header>
            <?php endif; ?>
            <?php if ($tabs_content = render($tabs)): ?>
                <div class="row">
                    <div class="col-lg-12">
                        <header class="panel-heading tab-bg-dark-navy-blue">
                            <?php print $tabs_content; ?>
                        </header>
                    </div>
                </div>

            <?php endif; ?>
            <!-- page start-->
            <?php if ($content = render($page['content'])): ?>
                    <?php print $content; ?>
            <?php endif; ?>
            <!-- page end-->
        </section>
    </section>
    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">

    </footer>
    <!--footer end-->
</section>
