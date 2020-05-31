var page = 2;

jQuery(function($) {
	function appendPost(data, callback) {
		$.post(breeds_loadmore_params.ajaxurl, data, function(response) {
			if ($.trim(response) == "") {
				$(".loadmore").hide();
			}
			$("#breeds-listing").append(response);
			page++;
			data.page = page;
			$.post(breeds_loadmore_params.ajaxurl, data, function(response) {
				if ($.trim(response) == "") {
					$(".loadmore").hide();
				}
			});
		});
	}

	$("body").on("click", ".loadmore", function() {
		var data = {
			action: "load_more_posts",
			page: page,
			security: breeds_loadmore_params.security,
		};

		appendPost(data);
	});
});
