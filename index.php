<?php
/**
 * Typecho.re 御用主题
 * 
 * @package TeHot2017
 * @author TeHot
 * @version 1.1
 * @link http://www.typecho.re/
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
 $this->need('header.php');
 ?>

<div class="col-mb-12" id="main" role="main">
<div class="post-lists">
		<div class="post-lists-body">
		<?php
			$index_category = isset($this->options->index_category) ? $this->options->index_category : 'all';
			if ($index_category == 'all' || !categoryExists($index_category))
				$posts = $this;
			else
				$posts = $this->widget('Widget_Archive@index-' . $index_category, 'pageSize=' . $this->parameter->pageSize .'&type=category', 'mid=' . $index_category);
		?>
		<?php while($posts->next()): ?>
			<div class="post-list-item">
				<div class="post-list-item-container">
						<?php $thumb = getThumb($posts, true, null, true); ?>
						<a class="cover-link" href="<?php $posts->permalink(); ?>">
							<div class="overlay">
								<div class="info"><span class="text-uppercase"><?php _e($posts->options->viewthemes); ?></span></div>
							</div>
							<div class="item-thumb" style="background-image: url('<?php echo $thumb; ?>')"></div>
						</a>
					<div class="item-title"><a href="<?php $posts->permalink(); ?>" title="<?php $posts->title(); ?>"><h4 class="text-uppercase" title="<?php $posts->title(); ?>"><?php $posts->title(); ?></h4></a></div>
				</div>
			</div>
		<?php endwhile; ?>
		</div>
</div>
		<?php
			$posts->pageNav('&laquo; 前一页', '后一页 &raquo;');
		?>
</div><!-- end #main-->
<?php $this->need('footer.php'); ?>