<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
$index_category = isset($this->options->index_category) ? $this->options->index_category : 'all';
if ($this->is('category') && ($this->_pageRow[mid] == $index_category) && ($this->_currentPage == 1))
	$this->response->redirect($this->options->siteUrl, 302);
$this->need('header.php'); ?>
	<div class="col-mb-12" id="main" role="main">
		<div class="post-lists-body">
		<?php if ($this->have()): ?>
		<?php while($this->next()): ?>
			<div class="post-list-item">
				<div class="post-list-item-container">
					<?php if (in_array($this->_pageRow[mid], $this->options->showTumbCat)): ?>
						<?php $thumb = getThumb($this , true, null, true); ?>
                                                
						<a class="cover-link" href="<?php $this->permalink(); ?>">
							<div class="overlay">
								<div class="info"><span class="text-uppercase"><?php _e($this->opitons->viewthemes); ?></span></div>
							</div>
							<div class="item-thumb" style="background-image: url('<?php echo $thumb; ?>')"></div>
						</a>
					<?php endif; ?>
					<div class="item-title">
						<a href="<?php $this->permalink(); ?>" title="<?php $this->title(); ?>">
							<h4 class="text-uppercase" title="<?php $this->title(); ?>"><?php $this->title(); ?></h4>
						</a>
					</div>
				</div>
			</div>
		<?php endwhile; ?>
		<?php else: ?>
			<article class="post">
				<h2 class="post-title"><?php _e('没有找到内容'); ?></h2>
			</article>
		<?php endif; ?>
		</div>
		<?php $this->pageNav('&laquo; 前一页', '后一页 &raquo;'); ?>
	</div><!-- end #main -->

	<?php $this->need('footer.php'); ?>