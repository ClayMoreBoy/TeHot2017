<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php if($this->is('single')): ?>
<?php
	$links = fieldsToLinks($this->___fields(), array('theme_demo' => '主题演示', 'theme_download'=> '主题下载'), $options = 'wrapClass=widget-theme');
	if (!empty($links)):
?>
<section class="widget">
	<h6 class="widget-title">Theme info</h6>
	<?php _e($links); ?>
</section>
<?php endif; ?>
<?php endif; ?>