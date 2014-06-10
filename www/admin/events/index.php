<?
session_start();
require $_SERVER['DOCUMENT_ROOT'].'/app/core.php';
require $_SERVER['DOCUMENT_ROOT'].'/app/DB.php';
require $_SERVER['DOCUMENT_ROOT'].'/app/PDO.php';
require $_SERVER['DOCUMENT_ROOT'].'/app/PDOMySQL.php';
require $_SERVER['DOCUMENT_ROOT'].'/app/PDOStatementMySQL.php';
$content = 'content.php';
$template = 'admin';
$title = '';


include $_SERVER['DOCUMENT_ROOT'].'/templates/' . $template . '.tmpl.php';
?>
<? // include $_SERVER['DOCUMENT_ROOT'] . "/templates/admin.tmpl.php"; ?>
