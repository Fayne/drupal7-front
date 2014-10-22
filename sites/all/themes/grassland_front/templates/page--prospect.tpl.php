<div id="content">
    <div class="main-content prospect-content">
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