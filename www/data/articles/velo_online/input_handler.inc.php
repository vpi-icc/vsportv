<?
	session_start();
	
	function to_utf8($input_string)
	{
		return iconv('Windows-1251', 'UTF-8', $input_string);
	}
	
	function to_cp1251($input_string)
	{
		return iconv('UTF-8', 'Windows-1251//TRANSLIT', $input_string);
	}
	
	function sendmail($mail_to, $sender_mail, $sender_name, $subject, $message) {
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=windows-1251\r\n";
		$headers .= "From: $sender_name <$sender_mail>\r\n";
		return mail($mail_to, $subject, $message, $headers);
	}

	$resultmatrix = array(
		"OK" => "Запрос выполнен успешно",
		"ERR_SERVER_MALFUNCTION" => "К сожалению, в настоящий момент мы&nbsp;не&nbsp;можем обработать ваш запрос <nobr>из-за</nobr> техничеких неполадок на&nbsp;сервере. Попробуйте повторить запрос позже.",
		"ERR_BAD_INPUT_DATA" => 'Вы где-то недоглядели. Пожалуйста, проверьте, правильно&nbsp;ли вы&nbsp;ввели свои данные. Если вы&nbsp;уверены, что правильно ввели данные, то,&nbsp;возможно, что-то не&nbsp;так.'
	);
	
	$formFields = array(
		'surname' => 'фамилия',
		'name' => 'имя',		
		'patronymic' => 'отчество',		
	);
			
	$requiredFields = array_keys($formFields);	
    
	array_push( $requiredFields, 'form_uid' );	
	
	
	
	foreach ( $requiredFields as $field )
    {		
        if ( !isset( $_POST[$field] ) || $_POST[$field] === "" )
        {
            respond( "ERR_BAD_INPUT_DATA", "Не заполнено одно из полей. Пожалуйста, заполните все поля перед отправкой" );
            exit(1);
        }
		
		$$field = to_cp1251( $_POST[$field] );		
    }
	
    if ( $form_uid != $_SESSION['form_uid'] )
    {
        respond( "ERR_BAD_INPUT_DATA", 'Неверно введено секретное число' );
		exit(2);
    }

	array_pop($requiredFields);
	
	$data = "";	
	
	foreach ( $requiredFields as $field )
	{	
		$data .= $$field . ' ';
	}

	$data = array('data' => $data);
	
	$ch = curl_init();
	//GET запрос указывается в строке URL
	curl_setopt($ch, CURLOPT_URL, 'http://mec-vlz.comuv.com/info.php');
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
	curl_setopt($ch, CURLOPT_USERAGENT, 'PHP bot');
	$b_email_sent = curl_exec($ch);
	curl_close($ch);

	if ( !$b_email_sent )
		respond("ERR_SERVER_MALFUNCTION", "Не удалось зарегистрировать вашу завявку. Попробуйте подать заявку позже.");
	else 
		respond("OK", "Спасибо. Мы&nbsp;зарегистрировали вашу заявку");
		
	exit(0);
 
	
	
	function respond($result_code, $result_msg = NULL, $result_data = NULL)
	{	
		$response = array( "code" => $result_code, "msg" => to_utf8($result_msg), "data" => to_utf8($result_data) );
		echo json_encode($response);
	}
?>