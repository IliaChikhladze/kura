jQuery(document).ready(function() {
	"use strict";
	jQuery('body').on( 'click', '.infinity-post-like', function(event) {
		event.preventDefault();
		var heart = jQuery(this);
		var post_id = heart.data("post_id");
		// heart.stop().fadeOut().fadeIn();
		jQuery.ajax({
			type: "post",
			url: ajax_var.url,
			data: "action=infinity-post-like&nonce="+ajax_var.nonce+"&infinity_post_like=&post_id="+post_id,
			success: function(count){
				if( count.indexOf( "already" ) !== -1 )
				{
					var lecount = count.replace("already","");
					if (lecount === "0")
					{
						lecount = "0";
					}
					heart.prop('title', '');
					heart.removeClass("liked");
					heart.html( "<i class='fa fa-heart-o'></i>" + "<span class='btn-info'>"+lecount+"</span>" );
					jQuery('.carousel-like-comm .infinity-post-like span').removeClass('btn-info');
				}
				else
				{

					heart.prop('title', '');
					heart.addClass("liked");
					heart.html( "<i  class='fa fa-heart'></i>" + "<span class='btn-info'>"+count+"</span>");
					jQuery('.carousel-like-comm .infinity-post-like span').removeClass('btn-info');
				}
			}
		});
	});
});
