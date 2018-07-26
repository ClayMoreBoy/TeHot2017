<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>

		</div><!-- end .row -->
	</div>
</div><!-- end #body -->
<footer id="footer" role="contentinfo">
	<?php if ($this->options->powerby) { echo str_replace(array('{{year}}','{{site}}'), array(date('Y'), '<a href="' . $this->options->siteUrl . '">' . $this->options->title .'</a>'),$this->options->powerby); } ?><br>Powered by <a href="http://www.typecho.org/" class="f-link" target="_blank">Typecho</a> | Theme by <a href="http://www.typecho.re/" class="f-link" target="_blank" rel="nofollow">TeHot</a>
</footer><!-- end #footer -->
<script src="<?php $this->options->themeUrl('assets/js/tehot.js?v20180726001'); ?>"></script>
<script src="<?php $this->options->themeUrl('assets/js/zepto.pjax.js'); ?>"></script>
<script src="//cdn.bootcss.com/headroom/0.9.1/headroom.min.js"></script>
<script src="https://unpkg.com/tippy.js@2.0.8/dist/tippy.all.min.js"></script>
<script type="text/javascript">
$('a').pjax('#body',{
	container: '#body',
	fragment: '#body',
	timeout: 8000
});
$(document).on('pjax:send',
function() {
	NProgress.start();
});
$(document).on('pjax:complete',
function() {
	NProgress.done();
	if ($('#comments').length > 0) {
		$('#body').removeClass('index');
	} else {
		$('#body').addClass('index');
	}
	$("li.-hasSubmenu").removeClass("-active");
	$("li.-hasSubmenu ul.-visible").removeClass("-visible");
	if ($('#post-bottom-bar')) {
		var postSharer = new Headroom(document.getElementById("post-bottom-bar"), {
			tolerance: 0,
			offset : 70,
			classes: {
				initial: "animated",
				pinned: "pinned",
				unpinned: "unpinned"
			}
		});
		postSharer.init();
	}
});
var header = new Headroom(document.getElementById("header"), {
	tolerance: 0,
	offset : 70,
	classes: {
		initial: "animated",
		pinned: "slideDown",
		unpinned: "slideUp"
	}
});
header.init();
if ($('#post-bottom-bar')) {
	var postSharer = new Headroom(document.getElementById("post-bottom-bar"), {
		tolerance: 0,
		offset : 70,
		classes: {
			initial: "animated",
			pinned: "pinned",
			unpinned: "unpinned"
		}
	});
	postSharer.init();
}
tippy('[title]',{
  placement: 'bottom',
  animation: 'scale',
  duration: 500,
  arrow: true
});
</script>
<?php $this->footer(); ?>
</body>
</html>
