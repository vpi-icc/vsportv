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
		"OK" => "������ �������� �������",
		"ERR_SERVER_MALFUNCTION" => "� ���������, � ��������� ������ ��&nbsp;��&nbsp;����� ���������� ��� ������ <nobr>��-��</nobr> ���������� ��������� ��&nbsp;�������. ���������� ��������� ������ �����.",
		"ERR_BAD_INPUT_DATA" => '�� ���-�� �����������. ����������, ���������, ���������&nbsp;�� ��&nbsp;����� ���� ������. ���� ��&nbsp;�������, ��� ��������� ����� ������, ��,&nbsp;��������, ���-�� ��&nbsp;���.'
	);
	
	$formFields = array(
		'surname' => '�������',
		'name' => '���',		
		'patronymic' => '��������',		
	);
			
	$requiredFields = array_keys($formFields);	
    
	array_push( $requiredFields, 'form_uid' );	
	
	
	
	foreach ( $requiredFields as $field )
    {		
        if ( !isset( $_POST[$field] ) || $_POST[$field] === "" )
        {
            respond( "ERR_BAD_INPUT_DATA", "�� ��������� ���� �� �����. ����������, ��������� ��� ���� ����� ���������" );
            exit(1);
        }
		
		$$field = to_cp1251( $_POST[$field] );		
    }
	
    if ( $form_uid != $_SESSION['form_uid'] )
    {
        respond( "ERR_BAD_INPUT_DATA", '������� ������� ��������� �����' );
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
	//GET ������ ����������� � ������ URL
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
		respond("ERR_SERVER_MALFUNCTION", "�� ������� ���������������� ���� �������. ���������� ������ ������ �����.");
	else 
		respond("OK", "�������. ��&nbsp;���������������� ���� ������");
		
	exit(0);
 
	
	
	function respond($result_code, $result_msg = NULL, $result_data = NULL)
	{	
		$response = array( "code" => $result_code, "msg" => to_utf8($result_msg), "data" => to_utf8($result_data) );
		echo json_encode($response);
	}
?>