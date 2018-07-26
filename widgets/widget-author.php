<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<section class="widget">
	<h6 class="widget-title"><?php _e('Author'); ?></h6>
	<p><?php _e(str_replace("\n", "</br>",Helper::options()->author)); ?></p>
</section>