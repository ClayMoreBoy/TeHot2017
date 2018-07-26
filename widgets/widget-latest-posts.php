<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<section class="widget">
	<h6 class="widget-title"><?php _e('Latest Posts'); ?></h3>
	<ul class="widget-list">
		<?php $this->widget('Widget_Contents_Post_Recent')
		->parse('<li><a href="{permalink}">{title}</a></li>'); ?>
	</ul>
</section>