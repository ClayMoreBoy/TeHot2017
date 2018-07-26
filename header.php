<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html class="no-js">
<head>
	<meta charset="<?php $this->options->charset(); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="renderer" content="webkit">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php $this->archiveTitle(array(
			'category'  =>  _t('分类 %s 下的文章'),
			'search'	=>  _t('包含关键字 %s 的文章'),
			'tag'	   =>  _t('标签 %s 下的文章'),
			'author'	=>  _t('%s 发布的文章')
		), '', ' - '); ?><?php $this->options->title(); ?></title>

	<!-- 使用url函数转换相关路径 -->
	<link rel="stylesheet" href="//cdnjscn.b0.upaiyun.com/libs/normalize/2.1.3/normalize.min.css">
	<link rel="stylesheet" href="<?php $this->options->themeUrl('grid.css'); ?>">
	<link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">
	<link rel="stylesheet" href="<?php $this->options->themeUrl('menu/menu.css'); ?>">
	<link rel='stylesheet' href='https://unpkg.com/nprogress@0.2.0/nprogress.css'/>
    
	<script src="<?php $this->options->themeUrl('assets/js/zepto.min.js'); ?>"></script>
	<script src='https://unpkg.com/nprogress@0.2.0/nprogress.js'></script>

	<!--[if lt IE 9]>
	<script src="//cdnjscn.b0.upaiyun.com/libs/html5shiv/r29/html5.min.js"></script>
	<script src="//cdnjscn.b0.upaiyun.com/libs/respond.js/1.3.0/respond.min.js"></script>
	<![endif]-->

	<!-- 通过自有函数输出HTML头部信息 -->
	<?php $this->header(); ?>
</head>
<body>
<!--[if lt IE 8]>
	<div class="browsehappy" role="dialog"><?php _e('当前网页 <strong>不支持</strong> 你正在使用的浏览器. 为了正常的访问, 请 <a href="http://browsehappy.com/">升级你的浏览器</a>'); ?>.</div>
<![endif]-->

<header id="header" class="clearfix">
	<div class="container">
		<div class="row">
			<div id="navbar">
				<div class="navbar-brand">
					<?php
						$logoUrl = $this->options->themeUrl . '/assets/img/logo.png';
						if(! empty($this->options->logoUrl))
							$logoUrl = $this->options->logoUrl;
					?>
					<a href="<?php $this->options->siteUrl(); ?>"><img src="<?php _e($logoUrl); ?>" alt="<?php $this->options->title(); ?>" style="height: 24px; width: auto; margin-top: 13px;"></a> 
				</div>
				<nav id="navbar-menu" class="navbar-collapse clearfix" role="navigation">
					<button class="navbar-togglebutton" aria-hidden="true" aria-pressed="false" type="button"><?php _e('菜单'); ?></button>
					<ul class="navbar-ul Menu -horizontal -hasSubmenu">
						<?php $all = Typecho_Plugin::export();?>
						<?php if (array_key_exists('TeMenu', $all['activated'])) : ?>
							<?php showMenu("navbar"); ?>
						<?php else: ?>
						<li><a<?php if($this->is('index')): ?> class="current"<?php endif; ?> href="<?php $this->options->siteUrl(); ?>"><?php _e('首页'); ?></a></li>
						<li class="menu-item -hasSubmenu"><a href="#"><?php _e('页面'); ?></a>
							<ul>
								<?php $this->widget('Widget_Contents_Page_List')->to($pages); ?>
								<?php while($pages->next()): ?>
									<li><a<?php if($this->is('page', $pages->slug)): ?> class="current"<?php endif; ?> href="<?php $pages->permalink(); ?>" title="<?php $pages->title(); ?>"><?php $pages->title(); ?></a></li>
								<?php endwhile; ?>
							</ul>
						</li>
						<?php endif; ?>
						<li class="search-menu menu-item -hasSubmenu -noChevron">
							<a href="#" title="<?php _e('搜索'); ?>"><div class="menu-search"></div></a>
							<ul>
									<li class="search-row">
										<form id="search" method="post" action="<?php $this->options->siteUrl(); ?>" role="search">
											<button class="search-btn" type="submit" title="Search">
												<i class="fa fa-search"></i>
											</button>
											<input type="text" name="s" class="form-control" placeholder="<?php _e('输入内容搜索'); ?>">
										 </form>
								</li>
							</ul>
						</li>
						<li class="user-menu menu-item -hasSubmenu -noChevron">
							<?php $Logined = $this->user->hasLogin(); if($Logined): ?>
								<a href="#" title="<?php _e('用户菜单'); ?>"><img class="avatar" src="<?php echo Typecho_Common::gravatarUrl($this->user->mail, 32, 'X', 'mm', $this->request->isSecure()); ?>" height="32" width="32" /></a>
							<?php else: ?>
								<a href="#" ><img class="avatar" src="<?php $this->options->themeUrl('assets/img/default-avatar.png'); ?>" height="32" width="32" /></a>
							<?php endif; ?>
							<ul>
								<?php if($this->user->hasLogin()): ?>
									<li><a href="<?php $this->options->adminUrl('write-post.php'); ?>"><?php _e('写文章'); ?></a></li>
									<li><a href="<?php $this->options->adminUrl(); ?>"><?php _e('进入后台'); ?> (<?php $this->user->screenName(); ?>)</a></li>
									<li><a href="<?php $this->options->logoutUrl(); ?>"><?php _e('退出'); ?></a></li>
								<?php else: ?>
									<li><a href="<?php $loginUrl = Typecho_Common::url('login.php?referer=http:////' . Typecho_Common::url($_SERVER['REQUEST_URI'], $_SERVER['HTTP_HOST']), $this->options->adminUrl); echo $loginUrl; ?>"><?php _e('登录'); ?></a></li>
								<?php endif; ?>
							</ul>
						</li>
					</ul>
				</nav>
			</div>
		</div><!-- end .row -->
	</div>
</header><!-- end #header -->
<section class="page-title-wrapper">
	<div class="container">
		<div class="row">
			<div class="col-mb-12 col-6">
				<div class="page-title">
					<h4 class="text-uppercase"><?php $this->options->zdgg() ?></h4>
				</div>
			</div>
			<div class="col-mb-12 col-6">
				<ol class="breadcrumb text-uppercase">
					<li><a href="<?php $this->options->siteUrl(); ?>">HOME</a></li>
					<?php if ($this->is('index')): ?><!-- 页面为首页时 -->
					<?php elseif ($this->is('post')): ?><!-- 页面为文章单页时 -->
					<li><?php $this->category(); ?></li>
					<?php else: ?><!-- 页面为其他页时 -->
					<li><?php $this->archiveTitle(array('category'  =>  _t('分类：%s'),'search'	=>  _t('关键字：%s '),'tag'	   =>  _t('标签：%s '),'author'	=>  _t('作者：%s')), '', ''); ?></li>
					<?php endif; ?>
				</ol>
			</div>
		</div>
	</div>
</section>
<div id="body" class="clearfix <?php if($this->is('index') || $this->is('archive')): ?> index<?php endif; ?>">
	<div class="container">
		<div class="row">

