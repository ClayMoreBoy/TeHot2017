<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<section class="widget">
	<h6 class="widget-title"><?php _e('Category'); ?></h6>
	<?php $this->widget('Widget_Metas_Category_List')->listCategories('wrapClass=widget-list'); ?>
</section>