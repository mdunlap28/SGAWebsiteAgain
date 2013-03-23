jQuery(document).ready(function() {
	/*----------SELECT ALL POSTS OR PAGES----------*/
	jQuery("div.ajax_data strong.checkall").live("click", function() {
		if(jQuery(this).hasClass("uncheck")) {
			jQuery(this).closest("p").next(".overflow").find("input").attr({"checked":false});
			jQuery(this).removeClass("uncheck").text("Check All");
		} else {
			jQuery(this).closest("p").next(".overflow").find("input").attr({"checked":true});
			jQuery(this).addClass("uncheck").text("Uncheck All");
		}
	});
	/*----------CLICK ON CHECKBOX----------*/
	jQuery("div.widgets_controller_box div.category_box input[type=checkbox]").live("change", function() {
		if(jQuery(this).closest("div.widgets_controller_box").find("div.rwp input").attr("checked") == "checked") {
			var title = jQuery(this).attr("value");
			if(jQuery(this).attr("checked") == "checked") {
				jQuery(this).closest(".widgets_controller_box").find(".posts_box").find("input[type=checkbox][title="+title+"]").attr({"checked":true});
			} else {
				jQuery(this).closest(".widgets_controller_box").find(".posts_box").find("input[type=checkbox][title="+title+"]").attr({"checked":false});
			}
			all_checked();
		}
		var main_target = jQuery(this).closest("div.widgets_controller_box").prev("p").find("input.widgets_controller");
		check_uncheck(main_target);
	});
	jQuery("div.widgets_controller_box div.pages_box input[type=checkbox]").live("change", function() {
		var title = jQuery(this).attr("value");
		if(jQuery(this).attr("checked") == "checked") {
			jQuery(this).closest(".pages_box").find("input[type=checkbox][title="+title+"]").attr({"checked":true});
		} else {
			jQuery(this).closest(".pages_box").find("input[type=checkbox][title="+title+"]").attr({"checked":false});
		}
		all_checked();
		var main_target = jQuery(this).closest("div.widgets_controller_box").prev("p").find("input.widgets_controller");
		check_uncheck(main_target);
	});
	jQuery("div.widgets_controller_box div.posts_box input[type=checkbox]").live("change", function() {
		var main_target = jQuery(this).closest("div.widgets_controller_box").prev("p").find("input.widgets_controller");
		check_uncheck(main_target);
	});
	jQuery("div.widgets_controller_box input[type=checkbox][value=homepage], div.widgets_controller_box input[type=checkbox][value=error], div.widgets_controller_box input[type=checkbox][value=search], div.widgets_controller_box input[type=checkbox][value=archive], div.posts_box input[type=checkbox]").live("change", function() {
		all_checked();
	});
	/*----------ACTIVE MAIN CHECKBOX----------*/
	jQuery("input.checkbox.widgets_controller").live("change", function() {
		var current_ele = jQuery(this);
		if(jQuery(this).attr("checked")) {
			jQuery(this).closest("p").next("div.widgets_controller_box").removeClass("none").append('<div class="loading" ><img src="'+PLUGINPATH+'/img/loading.gif" /></div>');
			var for_id = jQuery(this).attr("for_id");
			var get_cat_name = jQuery(this).attr("get_cat_name");
			var get_posts_name = jQuery(this).attr("get_posts_name");
			var get_pages_name = jQuery(this).attr("get_pages_name");
			var current_cat = jQuery(this).attr("current_cat");
			var current_posts = jQuery(this).attr("current_posts");
			var current_pages = jQuery(this).attr("current_pages");
			jQuery.post ( ajaxurl, {
				action : 'myajax-submit',
				dataType: 'json',
				data:{for_id:for_id, get_cat_name:get_cat_name, get_posts_name:get_posts_name, get_pages_name:get_pages_name, current_cat:current_cat, current_posts:current_posts, current_pages:current_pages}
			}, function(data) {
				jQuery(current_ele).closest("p").next("div.widgets_controller_box").find("div.ajax_data").html(data);
				jQuery(current_ele).closest("p").next("div.widgets_controller_box").children(".loading").remove();
				jQuery(current_ele).closest("p").next("div.widgets_controller_box").find("span.show_detail").remove();
				all_checked();
				check_uncheck(current_ele);
			});
		} else {
			jQuery(this).closest("p").next("div.widgets_controller_box").addClass("none");
			jQuery(current_ele).closest("p").next("div.widgets_controller_box").find("div.ajax_data").empty();
		}
	});
	/*----------ON PAGE LOAD----------*/
	jQuery("input.checkbox.widgets_controller").trigger("change");
	jQuery("div.widgets_controller_box span.show_detail").live("click", function() {
		jQuery(this).closest("div.widgets_controller_box").prev("p").children("input.checkbox.widgets_controller").trigger("change");
	});
});
function all_checked() {
	jQuery("div.widgets_controller_box input[type=checkbox]").each(function() {
		if(jQuery(this).attr("checked")) {
			jQuery(this).next("label").addClass("hl");
		} else {
			jQuery(this).next("label").removeClass("hl");
		}
	});
}
function check_uncheck(ce) {
	if(jQuery(ce).closest("p").next("div.widgets_controller_box").find("div.overflow.posts_box input:not(:checked)").length == 0) {
		jQuery(ce).closest("p").next("div.widgets_controller_box").find("div.ajax_data strong.posts.checkall").addClass("uncheck").text("Uncheck All");
	} else {
		if(jQuery(ce).closest("p").next("div.widgets_controller_box").find("div.ajax_data strong.posts.checkall.uncheck").length == 1) {
			jQuery(ce).closest("p").next("div.widgets_controller_box").find("div.ajax_data strong.posts.checkall").removeClass("uncheck").text("Check All");
		}
	}
	if(jQuery(ce).closest("p").next("div.widgets_controller_box").find("div.overflow.pages_box input:not(:checked)").length == 0) {
		jQuery(ce).closest("p").next("div.widgets_controller_box").find("div.ajax_data strong.pages.checkall").addClass("uncheck").text("Uncheck All");
	} else {
		if(jQuery(ce).closest("p").next("div.widgets_controller_box").find("div.ajax_data strong.pages.checkall.uncheck").length == 1) {
			jQuery(ce).closest("p").next("div.widgets_controller_box").find("div.ajax_data strong.pages.checkall").removeClass("uncheck").text("Check All");
		}
	}
}