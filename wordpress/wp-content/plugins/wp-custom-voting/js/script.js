jQuery(document).ready(function(){
	jQuery(".wpcvbutton a").click(function() {
		var some = jQuery(this);
		var thepost = jQuery(this).attr("post");
		jQuery.ajax({
		type: "POST",
			dataType:'json',
			url: WPCVajax.ajaxurl,
			data: 'action=ProcessWPCV&post='+thepost,
			dataType: "json",
			success: function(data){
				var votebox = ".wpcvbutton"+thepost+" span";
				jQuery(votebox).text(data.vote);
				jQuery(some).replaceWith('<span class="wpcvbuttonvoted">'+data.label+'</span>');
			}
		});
		return false;
	});
});