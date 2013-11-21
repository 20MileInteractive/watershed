$(document).ready(function(){


	$('#find-watershed').click(function(e){
		// $('#my-watershed-img').slideDown('slow');
		var addr = $('#searchTextField').val();
		
		e.preventDefault();
		// var watershed_top = $("#my-watershed-img").offset().top;
		// console.log(watershed_top);
		// $('body').animate({scrollTop:watershed_top}, 2000, 'swing');
	});


	$('#show_results').click(function(e){
		var currentMargin = $('.community-map').css('margin-bottom');
		if (currentMargin == '245px') {
			$('.community-map').animate({ 'marginBottom': '53px' }, 390);
		} else {
			$('.community-map').animate({ 'marginBottom': '245px' }, 390);
		}	
		e.preventDefault();
	});
	

	$.stellar({responsive: false});
});