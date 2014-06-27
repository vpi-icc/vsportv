

	function checkForm()
	{
		var error = '';		
		
		if ( $('#name').val().length <= 3 )
			error = 'Было бы здорово, для начала, написать хоть что-то';
		
		else if ( $('#surname').val().length <= 2 )
			error = 'Пожалуйста, представьтесь нам, чтобы было понятно, от кого это обращение';
		
		else if ( !/^[0-9]{4}$/.test($('#form_uid').val()) )
			error = 'Введите четыре цифры с&nbsp;картинки слева';
		
		if ( error != '' ) {
			showError(error);
			return false;
		}
		
		return true;
	}
	
	function showError(error) {		
		$('#note_error').html(error).show();
	}
	
	function grabInputData(formId)
	{
		var req = $('#' + formId).serialize();
		return req;
	}	
	
	$( document ).ready( function() {
		
		var formId = 'regform';
			
		var toggleInput = function() {
			$(this).prev().slideToggle(300);
		}
		
		$('#ws1').change( toggleInput );
		$('#ws2').change( toggleInput );
				
		$('.inputform input').keypress(function(e) {
			//if ( e.charCode == 13 ) $('#btn_send').click();
			//if ( e.charCode == 27 ) postData();
		});

		$('#' + formId).submit( function( event ) {
			event.preventDefault();
			postData();
		}); // form submit	
		
		function postData(){
			$('#note_error').hide();
			if ( $('#response_failure').is(':visible') )
				$('#response_failure').slideUp(100).hide(100);
			if ( $('#response_success').is(':visible') )
				$('#response_success').slideUp(100).hide(100);
				
			if ( checkForm() ) {
				var req = grabInputData(formId);		
				$('#process').show();
				$('#btn_send').hide();
		
				$.post('/data/articles/velo_online/input_handler.inc.php', req)
					.done( function(resp) {
						var r = null; // JSON result
						r = $.parseJSON(resp);
						switch ( r.code ) {
							
							case "OK" : 
								$('#process').hide();
								$('#send_block').hide();
								var stream = $('#response_success');								
								stream.children()[0].innerHTML = r.msg + '<br />' + r.data;
								stream.slideDown(300);								
								break;
	
							case "ERR_BAD_INPUT_DATA":
							case "ERR_SERVER_MALFUNCTION":
							
								var stream = $('#response_failure');
								var message = '<p class="f14"><strong>Оу.</strong></p>' + r.msg;
								stream.children()[0].innerHTML = message;
								stream.children()[1].innerHTML = r.data;
								$('#process').hide();
								$('#btn_send').show();
								stream.show();
								break;
						}						
					}) // .done
					.fail( function() {
						var msg = 'К сожалению, в настоящий момент сервер недоступен. Попробуйте повторить попытку позже.';
						var stream = $('#response_failure');
						stream.children()[0].innerHTML = msg;
						$('#process').hide();
						$('#btn_send').show();												
						stream.show();
					} ); // . fail
				// $.post					
			} // if ( checkform )
		};
			
	});