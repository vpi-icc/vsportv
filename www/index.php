<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 20.04.14
 * Time: 20:45
 */

require 'app/core.php';
require 'app/DB.php';
require 'app/PDO.php';
require 'app/PDOMySQL.php';
require 'app/PDOStatementMySQL.php';

$sections = array(
    'infrastructure' => 'Спортивная инфраструктура',
    'online' => 'Онлайн-трансляция спортивной жизни Волжского',
	'about' => 'О комитете',
	'documents' => 'Документы',
	'intro' => 'Председатель комитета',
	'organizations' => 'Общественные организации',
	'reports' => 'Отчёты',
	'gallery' => 'Галерея',
	'veloreg' => 'Запись на «велобульвар»'
);

$content = '';
$template = 'main';
$title = '';
if ( !empty( $_GET['section'] ) )
{
    $template = 'inner';
    switch ( $_GET['section'] )
    {
        case 'press':
            $title = 'Новости волжского спорта';
            $content = 'app/views/press_viewer.php';
            break;
			
		case 'auth':
            $title = 'Авторизация';
            $content = 'app/views/press_viewer.php';
			//$template = 'auth';
            break;

        default:
            $src = 'data/articles/' . $_GET['section'] . '.php';
            if ( file_exists( $src ) )
            {
                $content = $src;
                $title = $sections[$_GET['section']];
            }
    }
}

include 'templates/' . $template . '.tmpl.php';