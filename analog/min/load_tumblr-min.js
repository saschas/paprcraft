$(document).ready(function(){function t(t){var a=$("#tumblr_feed"),o=[];t.forEach(function(t){var a=$("<div/>");a.attr("class","tumblr_post"),t.photos.forEach(function(t){var o=$("<img/>");o.attr("src",t.alt_sizes[2].url).attr("alt",t.caption).attr("class","tumblr_image"),a.append(o)}),o.push(a)}),a.append(o),a.mosaicflow({itemSelector:".tumblr_image",minItemWidth:250,itemHeightCalculation:"attribute"})}$.ajax({type:"Post",url:"http://api.tumblr.com/v2/blog/paprcraft.tumblr.com/posts?limit=50",dataType:"jsonp",data:{api_key:"e0LSHXY94nUE5R3eVkyzPh9ihSMuNn1ZkhQ6bALYsprc5v8bm3"},success:function(a){var o=a.response.posts;t(o)},error:function(t){console.log(0)},complete:function(t){}})});