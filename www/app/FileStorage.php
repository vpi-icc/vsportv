<?
class FileStorage extends Object
{
	protected $status = NULL;
	protected $dbh = NULL;
	protected $fileslist = array();
	
	public function __construct()
	{
		$this->dbh = &DB::getInstance()->dbh;
	}
	
	public static function wipe($filename)
	{
		$legalCharacters = "abcdefghijklmnopqrstuvwxyzABCEDFGHIJKLMNOPQRSTUVWXYZ-_0123456789";
		$legalArray = str_split($legalCharacters);
		$n = strlen($filename);
		for ( $i = 0; $i < $n; $i++ )
			if ( !in_array($filename[$i], $legalArray) ) $filename[$i] = '_';
		
		return $filename;
	}
	
	public function upload($tmp_file, $name, $title, $section, $url)
	{
		$targetDir = $_SERVER['DOCUMENT_ROOT'] . '/_files' . substr($url, 0, strrpos($url, '/'));
		
		if ( !file_exists($targetDir) && !mkdir($targetDir) )
		{
			$this->status = 'Не удалось получить доступ к&nbsp;каталогу ' . $targetDir;	
			return false;
		}
		
		$filebase = substr($title, 0, 250);
		$filebase = $this->transliterate($filebase);
		$filebase = $this->wipe($filebase);
		$ext = pathinfo($name, PATHINFO_EXTENSION);
		$filename = $targetDir . '/' . $filebase . '.' . $ext;
		
		if ( !move_uploaded_file($tmp_file, $filename) )
		{
			$this->status = 'Не удалось переместить файл &laquo;' . $tmp_file . '&raquo; в&nbsp;целевой каталог';
			return false;
		}
		
		$filesize = filesize($filename);
		
		$typesMap = array(
			'DOC' => 		array('doc', 'docx'),
			'PDF' => 		array('pdf'),
			'PPT' => 		array('ppt', 'pptx'),
			'XLS' => 		array('xls', 'xlsx'),
			'IMAGE' => 		array('jpg', 'jpeg', 'gif', 'bmp', 'png'),
			'ARCHIVE' =>	array('rar', 'zip', '7z'));
			
		$filetype = 'GENERIC';		
		
		foreach ( $typesMap as $type => $extensions )
			if ( in_array($ext, $extensions) ) $filetype = $type;
			
		$filename = $filebase . '.' . $ext;
		$wrapFields = array(&$filename, &$title, &$section, &$url, &$filetype);
		foreach ( $wrapFields as &$value )
		{
			$value = "'" . $value . "'";
		}
		
		$query = "
			INSERT INTO
				kdm2_files (filename, title, section, url, type, size)
			VALUES
				(" . implode(',', array(
					$filename,
					$title,
					$section,
					$url,
					$filetype,
					$filesize)) . ")";
		
		if ( !$this->dbh->exec($query) )
		{
			$this->status = 'Не удалось записать информацию о&nbsp;файле &laquo;' . $filename . '&raquo; (&laquo;' . $title . '&raquo;) в&nbsp;базу данных';
			return false;
		}
		return true;
	}
	
	public function load()
	{
		$url = trim($_SERVER['REQUEST_URI']);
		$url = str_replace('index.php', '', $url);
		$query = "
			SELECT
				id, section, url, filename, title, LOWER(type), flags, size
			FROM
				kdm2_files
			WHERE
				url = '" . $url . "'";
		
		foreach ( $this->dbh->query($query) as $row )
		{
			list ( $id, $section, $url2, $filename, $title, $type, $flags, $size ) = $row;
			$this->fileslist[] = new File($id, $url2, $filename, $title, $flags, $size, $type);
		}
		return $this->fileslist;				
	}
	
	public function __toString()
	{
		if ( empty($this->fileslist) )
		{
			$this->status = 'Список файлов пуст';
			return '';	
		}
		$elem = '<table class="fileslist">';
		$elem .= '<col width="50" /><col /><col width="75" />';
		$elem .= '<tr><th>Тип</th><th>Название</th><th>Размер</th></tr>';
		$i = 0;
		foreach ( $this->fileslist as $file )
		{
			$filesize = ceil($file->size / 1024) . ' КБ';
			$rel = '';
			$even = ($i++ % 2) ? '' : ' class="even"';
			$elem .= '<tr' . $even . '>';
			if ( !$file->isHidden )
			{
				if ( $file->type == 'image' ) $rel = 'rel="lightbox" ';
				$elem .= '
					<td class="cntr"><a ' . $rel . 'href="' . $file->href . '"><img src="/_images/_layout/filetype_' . $file->type . '_32.gif" alt="type" /></a></td>
					<td><a ' . $rel . 'href="' . $file->href . '">' . $file->title . '</a></td>
					<td>' . $filesize . '</td>';
			}
			else
				$elem .= '
						<td class="cntr"><img src="/_images/_layout/filetype_' . $file->type . '_32.gif" alt="type" /></td>
						<td class="grey">' . $file->title . '</td>
						<td>' . $filesize . '</td>';
			$elem .= '</tr>';
		}		
		$elem .= '</table>';
		return $elem;
	}	
}
?>