<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<section class="widget">
	<h6 class="widget-title"><?php _e('Latest Comments'); ?></h6>
	<ul class="widget-list">
	<?php $this->widget('Widget_Comments_Recent')->to($comments); ?>
	<?php while($comments->next()): ?>
		<li><a href="<?php $comments->permalink(); ?>"><?php $comments->author(false); ?></a>: <?php $comments->excerpt(35, '...'); ?></li>
	<?php endwhile; ?>
	</ul>
</section>