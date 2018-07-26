<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php $this->need('header.php'); ?>

<div class="col-mb-12 col-8" id="main" role="main">
	<article class="post" itemscope itemtype="http://schema.org/BlogPosting">
		<h4 class="post-title text-uppercase" itemprop="name headline"><a itemprop="url" href="<?php $this->permalink() ?>"><?php $this->title() ?></a></h4>
		<ul class="post-meta text-uppercase">
			<li><time datetime="<?php $this->date('c'); ?>" itemprop="datePublished"><?php $this->date('Y-m-d'); ?></time></li>
			<li><?php $this->category(','); ?></li>
			<li><a href="#comments"><?php $this->commentsNum('暂无评论', '仅有 1 条评论', '已有 %d 条评论'); ?></a></li>
			<li><?php getPostViews($this, $format = "{views} 次浏览"); ?></li>
			<li><a href="<?php echo str_replace('login.php','',$this->options->loginUrl); ?>write-post.php?cid=<?php echo $this->cid; ?>"><?php _e('编辑'); ?></a></li>
		</ul>
		<div class="post-content" itemprop="articleBody">
			<?php $this->content(); ?>
		</div>
		<div class="post-footer">
			<div class="inline-block post-tags">
				<h6 class="text-uppercase">Tags</h6>
				<div class="widget-tags">
					<?php $this->tags(' ', true, '<a>没有标签</a>'); ?>
				</div>
			</div>
			<div class="inline-block post-author">
				<h6 class="text-uppercase">Author</h6>
				<div class="author-avatar">
					<?php $this->author->gravatar('64'); ?>
				</div>
				<div class="author-details">
					<h4 class="text-uppercase"><a href="<?php $this->author->url(); ?>"><?php $this->author(); ?></a></h4>
					<p><?php $this->options->copyright(); ?></p>
				</div>
			</div>
		</div>
	</article>
	<div id="post-bottom-bar" class="post-bottom-bar">
		<div class="container">
		<div class="row">
			<?php if(!$this->request->isMobile()): ?>
			<div class="bottom-bar-items social-share navbar-brand">
				<span class="bottom-bar-item">Share : </span>
				<span class="bottom-bar-item bottom-bar-facebook"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($this->permalink()); ?>" target="_blank" title="<?php _e('分享到facebook'); ?>" rel="nofollow">facebook</a></span>
				<span class="bottom-bar-item bottom-bar-twitter"><a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($this->permalink()); ?>&text=<?php echo urlencode($this->title()); ?>" target="_blank" title="<?php _e('分享到Twitter'); ?>" rel="nofollow">Twitter</a></span>
				<span class="bottom-bar-item bottom-bar-weibo"><a href="http://service.weibo.com/share/share.php?url=<?php echo urlencode($this->permalink()); ?>&amp;title=<?php echo urlencode($this->title()); ?>" target="_blank" title="<?php _e('分享到新浪微博'); ?>" rel="nofollow">Weibo</a></span>
				<?php if ($this->options->qr_api && $this->options->qr_api !== ""): ?>
				<span class="bottom-bar-item bottom-bar-qrcode"><a href="<?php _e(str_replace("{{content}}", urlencode($this->permalink), $this->options->qr_api)); ?>" target="_blank" rel="nofollow" title="<?php _e('查看二维码'); ?>">QRcode</a></span>
				<?php endif; ?>
			</div>
			<?php endif; ?>
			<div class="bottom-bar-items navbar-collapse <?php if($this->request->isMobile()): ?>mobile<?php endif; ?>">
				<span class="bottom-bar-item"><?php theNext($this); ?></span>
				<span class="bottom-bar-item"><?php thePrev($this); ?></span>
				<span class="bottom-bar-item"><a href="#footer" title="<?php _e('去底部'); ?>">↓</a></span>
				<span class="bottom-bar-item"><a href="#" title="<?php _e('去顶部'); ?>">↑</a></span>
			</div>
		</div>
		</div>
	</div>
	<?php $this->need('comments.php'); ?>
</div><!-- end #main-->
<?php $this->need('sidebar.php'); ?>
<?php $this->need('footer.php'); ?>
