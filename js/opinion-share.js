(function($){
	$(document).ready(function(){
	  $.slidebars();
	});
}) (jQuery);

jQuery('.img-responsive').click(function(){
	jQuery('.page-opinionshare').animate({
		left: "+=250"
	}, 5000, function(){	
	});
})