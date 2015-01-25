$(document).ready(function(){

	$.ajax({
		type: 'Post',
		url: "http://api.tumblr.com/v2/blog/paprcraft.tumblr.com/posts?limit=50",
		dataType: 'jsonp',
		data: {
			api_key: "e0LSHXY94nUE5R3eVkyzPh9ihSMuNn1ZkhQ6bALYsprc5v8bm3"
		},
		success: function (data) {

			var posts = data.response.posts;
					
					renderTumblr(posts);			
		},
		error: function (response) { 
			console.log(0); 
		},
		complete: function(data){}
	});

	/*
	*	Diese Funktion verarbeitet alle tumblr posts
	*	Jedes Bild wird in ein eigenes div.tumblr_post gewrappt 
	*	Der Container heißt #tumblr_feed;
	*/

	function renderTumblr(posts){
		//
		var $tumbler_post = $('#tumblr_feed');
		var $posts = [];
		posts.forEach(function(i){
		var post_el = $('<div/>');
				post_el.attr('class','tumblr_post');

			i.photos.forEach(function(photo){
				var img_el = $('<img/>');
				img_el.attr('src',photo.alt_sizes[2].url)
				.attr('alt',photo.caption)
				.attr('class','tumblr_image');
				post_el.append(img_el);
			});

			


			$posts.push(post_el);
		});
			$tumbler_post.append($posts);

			$tumbler_post.mosaicflow({
			    itemSelector: '.tumblr_image',
			    minItemWidth: 250,
			    itemHeightCalculation:'attribute'
			});
	}


			


});