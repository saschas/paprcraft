jQuery(document).ready(function($){
	function randomColor() {
    var letters = '4444456789ABcccc'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;	
	}

	var $color = randomColor();
	$('h1, h2, h3, h4, h5, h6, p.soon, path,a[href*="impressum"]').css({
		color:$color,
		fill:$color
	});
	var $bg_color = randomColor();
	$('body').css({
		background:$bg_color
	})



});