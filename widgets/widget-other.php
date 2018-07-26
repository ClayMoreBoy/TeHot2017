<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<section class="widget">
	<h6 class="widget-title"><?php _e('Other'); ?></h6>
	<ul class="widget-list">
		<?php if($this->user->hasLogin()): ?>
			<li class="last"><a href="<?php $this->options->adminUrl(); ?>"><?php _e('进入后台'); ?> (<?php $this->user->screenName(); ?>)</a></li>
			<li><a href="<?php $this->options->logoutUrl(); ?>"><?php _e('退出'); ?></a></li>
		<?php else: ?>
			<li class="last"><a href="<?php $this->options->adminUrl('login.php'); ?>"><?php _e('登录'); ?></a></li>
		<?php endif; ?>
		<li><a href="<?php $this->options->feedUrl(); ?>"><?php _e('文章 RSS'); ?></a></li>
		<li><a href="<?php $this->options->commentsFeedUrl(); ?>"><?php _e('评论 RSS'); ?></a></li>
		<li><a href="http://www.typecho.org">Typecho</a></li>
	</ul>
</section>