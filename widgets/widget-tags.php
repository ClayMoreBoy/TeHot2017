<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<section class="widget">
	<h6 class="widget-title">Tags</h6>
	<div class="widget-tags">
		<?php $this->widget('Widget_Metas_Tag_Cloud', 'ignoreZeroCount=1&limit=10')->to($tags); ?><?php while($tags->next()): ?><a href="<?php $tags->permalink(); ?>"><?php $tags->name(); ?>（<?php $tags->count(); ?>）</a><?php endwhile; ?>
	</div>
</section>
