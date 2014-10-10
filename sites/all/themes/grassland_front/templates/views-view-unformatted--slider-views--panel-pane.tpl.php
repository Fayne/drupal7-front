<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
    <div id="carousel-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <?php $idx = 0;
            foreach ($rows as $row): ?>
                <li data-target="#carousel-generic" data-slide-to="<?php print $idx; ?>"
                    class=" <?php if ($idx == 0): ?>active<?php endif; ?>"></li>
                <?php $idx++; endforeach; ?>
        </ol>
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <?php $idx = 0;
            foreach ($rows as $id => $row): ?>
                <div class="item <?php if ($idx == 0): ?>active<?php endif; ?> <?php if ($classes_array[$id]) {
                    print $classes_array[$id];
                } ?>">
                    <?php print $row; ?>
                </div>
                <?php $idx++; endforeach; ?>
        </div>
    </div>
