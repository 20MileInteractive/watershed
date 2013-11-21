$(document).ready(function(){


	$('#find-watershed').click(function(e){
		// $('#my-watershed-img').slideDown('slow');
		var addr = $('#searchTextField').val();
		
		e.preventDefault();
		// var watershed_top = $("#my-watershed-img").offset().top;
		// console.log(watershed_top);
		// $('body').animate({scrollTop:watershed_top}, 2000, 'swing');
	});
	

	$.stellar({responsive: false});
});