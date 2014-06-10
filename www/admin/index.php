<?php
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/app/core.php';
require $_SERVER['DOCUMENT_ROOT'].'/app/DB.php';
require $_SERVER['DOCUMENT_ROOT'].'/app/PDO.php';
require $_SERVER['DOCUMENT_ROOT'].'/app/PDOMySQL.php';
require $_SERVER['DOCUMENT_ROOT'].'/app/PDOStatementMySQL.php';

$sections = array(
    'infrastructure' => 'Спортивная инфраструктура',
    'online' => 'Онлайн-трансляция спортивной жизни Волжского',
	'about' => 'О комитете',
	'documents' => 'Документы',
	'intro' => 'Председатель комитета',
	'organizations' => 'Общественные организации',
	'reports' => 'Отчёты',
	'gallery' => 'Галерея'	
);

$content = 'content.php';
$template = 'admin';
$title = '';


include $_SERVER['DOCUMENT_ROOT'].'/templates/' . $template . '.tmpl.php';