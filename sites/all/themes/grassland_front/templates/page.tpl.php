<?php include 'header.tpl.php'; ?>

<section class="container">
    <div class="row">
        <!-- Content -->
        <div id="content" class="col-md-12">
            <div class="main-content">
                <?php if ($messages): ?>
                    <div id="messages">
                        <?php print $messages; ?>
                    </div><!-- /#messages -->
                <?php endif; ?>

                <?php print render($page['content']); ?>
                <?php print $feed_icons; ?>
                <!-- // content -->
            </div>
        </div>
    </div>
</section>
<!-- Footer -->
<footer class="container-fluid">
    <div class="container">
        <?php if ($page['footer_firstcolumn'] || $page['footer_secondcolumn'] || $page['footer_thirdcolumn'] || $page['footer_fourthcolumn']): ?>
            <div class="row footer_inside">
                <div class="col-md-3">
                    <?php print render($page['footer_firstcolumn']); ?>
                </div>
                <!--  1/4 Columns -->
                <div class="col-md-3">
                    <?php print render($page['footer_secondcolumn']); ?>
                </div>
                <!-- 1/4 Columns -->
                <div class="col-md-3">
                    <?php print render($page['footer_thirdcolumn']); ?>
                </div>
                <!-- 1/4 Columns -->
                <div class="col-md-3">
                    <div class="header_contacts">
                        <?php include 'contact.tpl.php'; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</footer>