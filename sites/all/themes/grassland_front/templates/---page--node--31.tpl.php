<section class="container">
    <div class="row">
        <!-- Content -->
        <div id="content" class="col-md-12">
            <div class="main-content">
                <h1>hello world</h1>
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