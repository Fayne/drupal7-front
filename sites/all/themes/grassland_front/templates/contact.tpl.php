<?php
    $contact_phone = theme_get_setting('contact_phone', 'grassland_front');
?>
<div><span class="glyphicon glyphicon-earphone"></span><a href="tell:<?php print $contact_phone; ?>"><?php print $contact_phone; ?></a><span class="service">上门服务</span></div>