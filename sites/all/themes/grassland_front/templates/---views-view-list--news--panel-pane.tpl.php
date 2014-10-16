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
<?php
$uri = trim($_SERVER["REQUEST_URI"], '/');
$uri_arr = explode('/', $uri);

$uri_arr[1] = isset($uri_arr[1]) ? $uri_arr[1] : 'all';
$uri_arr[2] = isset($uri_arr[2]) ? $uri_arr[2] : 'all';
$new_uri = implode('/', $uri_arr);
$category_1 = taxonomy_get_term_by_name('明星借贷员');
$category_1 = array_shift($category_1);
$categoty_1_id = $category_1->tid;
$category_2 = taxonomy_get_term_by_name('特别推广');
$category_2 = array_shift($category_2);
$categoty_2_id = $category_2->tid;
$category_3 = taxonomy_get_term_by_name('行业新闻');
$category_3 = array_shift($category_3);
$categoty_3_id = $category_3->tid;
$category_4 = taxonomy_get_term_by_name('本地新闻');
$category_4 = array_shift($category_4);
$categoty_4_id = $category_4->tid;
?>
<?php print $wrapper_prefix; ?>
<?php if (!empty($title)) : ?>
    <h3><?php print $title; ?></h3>
<?php endif; ?>
    <ul class="news-category clearfix">
        <li><a href="/<?php print $new_uri; ?>">所有新闻</a></li>
        <li><a href="/<?php print $new_uri . '/' . $categoty_1_id; ?>">明星借贷员</a></li>
        <li><a href="/<?php print $new_uri . '/' . $categoty_2_id; ?>">特别推广</a></li>
        <li><a href="/<?php print $new_uri . '/' . $categoty_3_id; ?>">行业新闻</a></li>
        <li><a href="/<?php print $new_uri . '/' . $categoty_4_id; ?>">本地新闻</a></li>
    </ul>
<ul class="news-detail-list clearfix">
<?php foreach ($rows as $id => $row): ?>
    <li class="<?php print $classes_array[$id]; ?>"><?php print $row; ?></li>
<?php endforeach; ?>
</ul>
<?php print $wrapper_suffix; ?>