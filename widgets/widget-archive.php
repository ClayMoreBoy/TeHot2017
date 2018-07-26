<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<section class="widget">
	<h6 class="widget-title"><?php _e('归档'); ?></h6>
	<ul class="widget-list">
		<?php $this->widget('Widget_Contents_Post_Date', 'type=month&format=F Y')
		->parse('<li><a href="{permalink}">{date}</a></li>'); ?>
	</ul>
</section>