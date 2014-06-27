<?

session_start();


function capcha($secret)
{
		$form_uid = $secret;
		header("Content-type: image/png");
		$im = imagecreate(101, 26);
		$w = imagecolorallocate($im, 255, 255, 255);
		$g1 = imagecolorallocate($im, 192, 192, 192);
		$g2 = imagecolorallocate($im, 64,64,64);
		$cl1 = imagecolorallocate($im,rand(0,128),rand(0,128),rand(0,128));
		$cl2 = imagecolorallocate($im,rand(0,128),rand(0,128),rand(0,128));
		$cl3 = imagecolorallocate($im,rand(0,128),rand(0,128),rand(0,128));
		$cl4 = imagecolorallocate($im,rand(0,128),rand(0,128),rand(0,128));
		for ($i=0;$i<=100;$i+=5) imageline($im,$i,0,$i,25,$g1);
		for ($i=0;$i<=25;$i+=5) imageline($im,0,$i,100,$i,$g1);
		imagestring($im, 5, 0+rand(0,10), 5+rand(-5,5),substr($form_uid,0,1), $cl1);
		imagestring($im, 5, 25+rand(-10,10), 5+rand(-5,5),substr($form_uid,1,1), $cl2);
		imagestring($im, 5, 50+rand(-10,10), 5+rand(-5,5),substr($form_uid,2,1), $cl3);
		imagestring($im, 5, 75+rand(-10,10), 5+rand(-5,5),substr($form_uid,3,1), $cl4);
		
		//for ($i=0;$i<8;$i++) imageline($im,rand(0,100),rand(0,25),rand(0,100),rand(0,25),$g2);
		$k = 1.7;
		$im1 = imagecreatetruecolor(101*$k,26*$k);
		imagecopyresized ($im1, $im, 0, 0, 0, 0, 101*$k, 26*$k, 101, 26); 
		$im2 = imagecreatetruecolor(101,26);
		imagecopyresampled($im2, $im1, 0, 0, 0, 0, 101, 26, 101*$k, 26*$k); 
		imagepng($im2);
		imagedestroy($im2);
		imagedestroy($im1);
		imagedestroy($im);
}

if (isset($_SESSION["form_uid"]) )
{	
	capcha($_SESSION["form_uid"]);
}
else
{
	//header("location: /");
	capcha(1111);
}



?>


