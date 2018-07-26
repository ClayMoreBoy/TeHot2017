<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<div class="col-mb-12 col-offset-1 col-3 kit-hidden-tb" id="secondary" role="complementary">
	<?php if(isset($this->options->widgets)) {
		$widgets = explode("\n",str_replace("\r\n", "\n", $this->options->widgets));
		foreach($widgets as $widget) {  
			$this->need(tehotGetWidget($widget));
		}
	} ?>
</div><!-- end #sidebar -->
