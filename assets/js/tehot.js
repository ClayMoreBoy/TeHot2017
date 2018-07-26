function menu() {
	// 菜单
	$(".Menu > li.-hasSubmenu").on('click', function() {
		var menu = $(this);
		var ul = $("ul", menu);
		if(!ul || ul.hasClass("-visible"))
			return;
		$(".Menu > li.-hasSubmenu").removeClass("-active");
		$(".Menu > li.-hasSubmenu ul").removeClass("-visible");
		menu.addClass("-active")
		ul.addClass("-animating");
		ul.addClass("-visible");
		setTimeout(function(){
			ul.removeClass("-animating")
		}, 25);
	});
	$("#navbar .navbar-togglebutton").on('click', function() {
		$("#navbar .Menu").toggleClass("mobile");
	});
	document.addEventListener("click", function() {
		$("li.-hasSubmenu:not(:hover)").removeClass("-active");
		$("li.-hasSubmenu:not(:hover) ul.-visible").removeClass("-visible");
	});
}
Zepto(function($){
	$("#navbar .Menu").removeClass("mobile");
	menu();
})