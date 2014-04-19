<?
	class Object
	{
		protected $status = NULL;
		
		public static $days = array('�����������', '�����������', '�������', '�����', '�������', '�������', '�������');
		public static $months = array('������', '�������', '�����', '������', '���', '����', '����', '�������', '��������', '�������', '������', '�������');	

		public static $eventTypes = array(
			'INDOOR' => '� ���������',
			'OUTDOOR' => '�� �������� �������');

		public static $eventCategories = array(
			'GENERIC' => '�����',
			'SPORT' => '�����',
			'BUSINESS' => '������',
			'FAMILY' => '�����',
			'LEISURE' => '�����',
			'ACHIEVEMENTS' => '����������',
			'KNOWLEDGE' => '������',
			'HOLIDAYS' => '�����',
			'CREATIVITY' => '����������',
			'HEALTH' => '��������',
			'PATRIOTISM' => '����������');
			
		public static $eventImportance = array(
			'LOCAL' => '�������',
			'MUNICIPAL' => '�������������',
			'REGIONAL' => '������������',
			'FEDERAL' => '�����������',
			'INTERNATIONAL' => '�������������');
			
		public static $adTypes = array(
			'ADVERTISEMENT' => '����������',
			'EVENT' => '�����������',
			'CONTEST' => '�������');

		public function __construct()
		{
			
		}
		
		public static function showError($msg)
		{
			echo '<div class="error">' . $msg . '</div>';
		}
		
		public static function showNotice($msg)
		{
			echo '<div class="notice">' . $msg . '</div>';
		}
		
		public function getStatusString()
		{
			return $this->status;	
		}
		
		public static function transliterate($string)
		{
			$converter = array(
				'�' => 'a', '�' => 'b', '�' => 'v',
				'�' => 'g',	'�' => 'd',	'�' => 'e',
				'�' => 'e', '�' => 'zh', '�' => 'z',
				'�' => 'i', '�' => 'y', '�' => 'k',
				'�' => 'l', '�' => 'm', '�' => 'n',
				'�' => 'o', '�' => 'p', '�' => 'r',
				'�' => 's', '�' => 't', '�' => 'u',
				'�' => 'f', '�' => 'h', '�' => 'c',
				'�' => 'ch', '�' => 'sh', '�' => 'sch',
				'�' => "'", '�' => 'y', '�' => "'",
				'�' => 'e', '�' => 'yu', '�' => 'ya',

				'�' => 'A', '�' => 'B', '�' => 'V',
				'�' => 'G', '�' => 'D', '�' => 'E',
				'�' => 'E', '�' => 'Zh', '�' => 'Z',
				'�' => 'I', '�' => 'Y', '�' => 'K',
				'�' => 'L', '�' => 'M', '�' => 'N',
				'�' => 'O', '�' => 'P', '�' => 'R',
				'�' => 'S', '�' => 'T', '�' => 'U',
				'�' => 'F', '�' => 'H', '�' => 'C',
				'�' => 'Ch', '�' => 'Sh', '�' => 'Sch',
				'�' => "'", '�' => 'Y', '�' => "'",
				'�' => 'E', '�' => 'Yu', '�' => 'Ya');

			return strtr($string, $converter);
		}
		
		public static function wrap(&$data, $before, $after)
		{
			if ( is_array($data) )
			{
				foreach ( $data as &$string )
				{
					$string = $before . $string . $after;
				}
				return;
			}
			$data = $before . $data . $after;
		}
		
		public static function formatDateRussian($datetime, $bIncludeYear = false)
		{
			$datetime = substr($datetime, 0, 10);
			list ( $year, $month, $day ) = explode('-', $datetime);
			$formattedDate = (int)$day . '&nbsp;' . self::$months[(int)$month - 1];
			if ( $bIncludeYear ) $formattedDate .= ' ' . $year . '&nbsp;�.';
			return $formattedDate;
		}
		
		public function resizeImage($src, $dest, $max_size)
		{
			if ( !file_exists($src) )
			{
				$this->status = '���� ' . $src . ' ��&nbsp;����������';
				return false;
			}
			
			$size = getimagesize($src);
	
			if ( $size === false )
			{	
				$this->status = '�� ������� ������� ������ �����������<br />';
				$this->status .= '����: ' . $src;
				return false;
			}
	
			$format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
			$icfunc = "imagecreatefrom" . $format;
			if ( !function_exists($icfunc) )
			{
				$this->status = '������ ����� ' . basename($src) . ' �� ��������������';
				return false;
			}
			
			$routine = ( $max_size > 600 || $size[0] > $size[1] ) ? 'max' : 'min';
			$ratio = $max_size / $routine($size[0], $size[1]);
			
			$new_width = ceil($ratio * $size[0]);
			$new_height = ceil($ratio * $size[1]);
			
			$isrc = $icfunc($src);
			$idest = imagecreatetruecolor($new_width, $new_height);
	
			imagefill($idest, 0, 0, 0xFFFFFF);
			imagecopyresampled($idest, $isrc, 0, 0, 0, 0, $new_width, $new_height, $size[0], $size[1]);
	
			imagejpeg($idest, $dest, 85);
	
			imagedestroy($isrc);
			imagedestroy($idest);
	
			return true;
		}		
		
		public function prepareDirectoryMD5($dir_path, $src_file)
		{
			if( !file_exists($dir_path) && !mkdir($dir_path, 0777) ) 
			{
				$this->status = "�� ������� ������� ����� ��&nbsp;���������� ����: " . $dst_path;
				return false;
			}

			$n_retries = 5;
			do
			{
				$ext = strstr($src_file, '.');			
				$name = md5(basename($src_file) . rand(0, 0xFFFF));
			}
			while ( file_exists($dir_path . '/' . $name . '.' . $ext) && $n_retries-- );
			
			if ( !$n_retries )
			{
				$this->status = '�� ������� ��������� ���������� ��� ��� ������������ ����� �&nbsp;��������';
				$this->status .= '<br />����: ' . $src_file;
				$this->status .= '<br />�������: ' . $dir_path;
				return false;
			}
			return $name;
		}
		
		public function extractZipArchive($zipfile, $extractTo)
		{
			$zip = new ZipArchive;
			if ( $zip->open($zipfile) === FALSE )
			{
				$this->status = '�� ������� ������� ZIP-����� ��&nbsp;������';
				return false;
			}
			
			if ( !file_exists($extractTo) )
			{
				if ( !mkdir($extractTo, 0777) )
				{
					$this->status = '�� ������� �������� ������ �&nbsp;��������� ����������:<br />';
					$this->status .= $extractTo;
					return false;
				}
			}								
			
			$extractedFiles = array();
			for ( $i = 0; $i < $zip->numFiles; $i++ )
			{		
				$filename = $zip->getNameIndex($i);
				if ( !$zip->extractTo($extractTo, $filename) )
				{
					$this->status .= '<br />�� ������� ����������� ���� &laquo;' . $filename . '&raquo;';
					$this->status .= '<br />�����: ' . $zipfile;
					$this->status .= '<br />����� ����������: ' . $extractTo;
					continue;
				}
				$extractedFiles[] = $filename;
			}
			$zip->close();
			return $extractedFiles;			
		}
	};
?>