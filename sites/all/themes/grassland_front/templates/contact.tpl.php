<?php
    $contact_phone = theme_get_setting('contact_phone', 'grassland_front');
?>
<div class="hidden-xs hidden-sm"><span class="glyphicon glyphicon-earphone"></span><a href="/prospect" rel="lightframe"><?php print $contact_phone; ?></a><span class="service"><a href="/prospect" rel="lightframe">上门服务</a></span></div>
<div class="hidden-md hidden-lg"><span class="glyphicon glyphicon-earphone"></span><a href="tell:<?php print $contact_phone; ?>"><?php print $contact_phone; ?></a><span class="service"><a href="tell:<?php print $contact_phone; ?>">上门服务</a></span></div>