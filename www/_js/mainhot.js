$(document).ready(function() {
	// main three-positional switcher
	var min_opacity = 0.75;
	var active_image = null;
	$('.tophot li').each( function(i){
		var image = $('#imgfortophot' + (i + 1));
		if ( i != 0 )
		{
			image.hide();
			image.css('opacity', min_opacity);
		}
		else active_image = image;
		
		$(this).bind('mouseover', function() {
			(function( this_li, corresponding_image ){
				if ( $(this_li).hasClass("here") ) return;
				else
				{	
					active_image.fadeOut(100);
					active_image.css("opacity", min_opacity);
					active_image = corresponding_image;			
					$(".tophot li").each(function() {
	                    $(this).removeClass("here");
	                });					
				
					$(this_li).addClass("here");
					corresponding_image.fadeIn(300).animate({
							'opacity': 100
						}, 300);
				}			
			})(this, image)			
			/*
			(function(header, image) {				
				if ( header == this ) return;											
				$('#main-hot .img').each( function(j) {					
					if ( this != image  )
					{
						//var img = $("#imagefortophot" + (j + 1));												
						$(this).delay(100).animate({							
							'opacity' : min_opacity
						}, 400, 'swing');
						$(this).hide();
						//img.fadeOut('fast');
						
						return;
					}
				});
				
				$(this).toggleClass("here");	
				$(header).toggleClass("here");
						
				$(image).fadeIn('slow');
				
			})(this, hotimage);
			*/
		});
	});
	$('#imgfortophot1').show();
});