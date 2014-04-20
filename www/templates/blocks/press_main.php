<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21.04.14
 * Time: 0:04
 */

    $eventSwitcherWriter = new EventSwitcherWriter;
    $template = $_SERVER['DOCUMENT_ROOT'] . '/templates/blocks/press_main.tmpl.php';
    $eventSwitcherWriter->setTemplate($template);
    $eventsList = new EventsList;
    $eventsList->write($eventSwitcherWriter);
?>