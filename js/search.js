$(document).ready(function(){
	var left = $('#box').position().left;
	var top = $('#box').position().top;
	var width = $('#box').width();
	
	$('#results').css('left', left).css('top',top+32).css('width',width);
	$('#results1').css('left', left).css('top',top+32).css('width',width);
	
	$('#specialty').keyup(function(){
		var value = $(this).val();
		
		if(value !=''){
			$('#results').show();
			$.post('search.php', {value: value}, function(data){
				$('#results').html(data);
				});
		} else{
			$('#results').hide();
		}
	});
});