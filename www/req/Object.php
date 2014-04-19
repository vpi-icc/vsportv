<?
	class Object
	{
		protected $status = NULL;
		
		public static $days = array('воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота');
		public static $months = array('января', 'февраля', 'марта', 'апреля', 'мая', 'июня', 'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря');	

		public static $eventTypes = array(
			'INDOOR' => 'в помещении',
			'OUTDOOR' => 'на открытом воздухе');

		public static $eventCategories = array(
			'GENERIC' => 'общая',
			'SPORT' => 'спорт',
			'BUSINESS' => 'бизнес',
			'FAMILY' => 'семья',
			'LEISURE' => 'досуг',
			'ACHIEVEMENTS' => 'достижения',
			'KNOWLEDGE' => 'знания',
			'HOLIDAYS' => 'отдых',
			'CREATIVITY' => 'творчество',
			'HEALTH' => 'здоровье',
			'PATRIOTISM' => 'патриотизм');
			
		public static $eventImportance = array(
			'LOCAL' => 'местное',
			'MUNICIPAL' => 'муниципальное',
			'REGIONAL' => 'региональное',
			'FEDERAL' => 'федеральное',
			'INTERNATIONAL' => 'международное');
			
		public static $adTypes = array(
			'ADVERTISEMENT' => 'объявление',
			'EVENT' => 'мероприятие',
			'CONTEST' => 'конкурс');

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
				'а' => 'a', 'б' => 'b', 'в' => 'v',
				'г' => 'g',	'д' => 'd',	'е' => 'e',
				'ё' => 'e', 'ж' => 'zh', 'з' => 'z',
				'и' => 'i', 'й' => 'y', 'к' => 'k',
				'л' => 'l', 'м' => 'm', 'н' => 'n',
				'о' => 'o', 'п' => 'p', 'р' => 'r',
				'с' => 's', 'т' => 't', 'у' => 'u',
				'ф' => 'f', 'х' => 'h', 'ц' => 'c',
				'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',
				'ь' => "'", 'ы' => 'y', 'ъ' => "'",
				'э' => 'e', 'ю' => 'yu', 'я' => 'ya',

				'А' => 'A', 'Б' => 'B', 'В' => 'V',
				'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
				'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',
				'И' => 'I', 'Й' => 'Y', 'К' => 'K',
				'Л' => 'L', 'М' => 'M', 'Н' => 'N',
				'О' => 'O', 'П' => 'P', 'Р' => 'R',
				'С' => 'S', 'Т' => 'T', 'У' => 'U',
				'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
				'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',
				'Ь' => "'", 'Ы' => 'Y', 'Ъ' => "'",
				'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya');

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
			if ( $bIncludeYear ) $formattedDate .= ' ' . $year . '&nbsp;г.';
			return $formattedDate;
		}
		
		public function resizeImage($src, $dest, $max_size)
		{
			if ( !file_exists($src) )
			{
				$this->status = 'Файл ' . $src . ' не&nbsp;существует';
				return false;
			}
			
			$size = getimagesize($src);
	
			if ( $size === false )
			{	
				$this->status = 'Не удалось полчить размер изображения<br />';
				$this->status .= 'Файл: ' . $src;
				return false;
			}
	
			$format = strtolower(substr($size['mime'], strpos($size['mime'], '/') + 1));
			$icfunc = "imagecreatefrom" . $format;
			if ( !function_exists($icfunc) )
			{
				$this->status = 'Формат файла ' . basename($src) . ' не поддерживается';
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
				$this->status = "Не удалось создать папку по&nbsp;следующему пути: " . $dst_path;
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
				$this->status = 'Не удалось подобрать уникальное имя для загружаемого файла в&nbsp;каталоге';
				$this->status .= '<br />Файл: ' . $src_file;
				$this->status .= '<br />Каталог: ' . $dir_path;
				return false;
			}
			return $name;
		}
		
		public function extractZipArchive($zipfile, $extractTo)
		{
			$zip = new ZipArchive;
			if ( $zip->open($zipfile) === FALSE )
			{
				$this->status = 'Не удалось открыть ZIP-архив на&nbsp;чтение';
				return false;
			}
			
			if ( !file_exists($extractTo) )
			{
				if ( !mkdir($extractTo, 0777) )
				{
					$this->status = 'Не удалось получить доступ к&nbsp;временной директории:<br />';
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
					$this->status .= '<br />Не удалось распаковать файл &laquo;' . $filename . '&raquo;';
					$this->status .= '<br />Архив: ' . $zipfile;
					$this->status .= '<br />Папка назначения: ' . $extractTo;
					continue;
				}
				$extractedFiles[] = $filename;
			}
			$zip->close();
			return $extractedFiles;			
		}
	};
?>