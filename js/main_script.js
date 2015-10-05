jQuery(document).ready(function($){
	if($('.code-block').length>0){
		$('.code-block').each(function(i){
			CodeMirror.fromTextArea($(this)[0], {
				lineNumbers: true,
				matchBrackets: true,
				mode:  'text/'+$(this).attr('data-code-type'),
				theme: 'monokai'
			});
		});
	}


	$('.main_menu').click(function(){
		$(this).toggleClass('active');
	});

});