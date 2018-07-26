<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; 
/**
 * 搜索 Widgets
 * @author benzBrake<github-benzBrake@woai.ru>
 **/
?>
<section class="widget">
	<h6 class="widget-title">What are you looking for?</h6>
	<form class="form-inline form" id="search" method="post" action="./" role="search">
		<div class="search-row">
			<button class="search-btn" type="submit" title="Search">
				<i class="fa fa-search"></i>
			</button>
			<input type="text" name="s" class="form-control" placeholder="Search...">
		</div>
	</form>
</section>