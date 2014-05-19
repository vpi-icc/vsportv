<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21.04.14
 * Time: 0:04
 */
    //include $_SERVER['DOCUMENT_ROOT'] . '/templates/blocks/press_list.tmpl.php';
    /*
    $writer = new EventListWriter;
    $template = $_SERVER['DOCUMENT_ROOT'] . '/templates/blocks/press_list.tmpl.php';
    $writer->setTemplate($template);
    $eventsList = new EventsList;
    $eventsList->write($writer);
    */
?>

<table width="100%">
    <colgroup>
        <col width="458" />
        <col width="206" />
    </colgroup>
    <tr>
        <td class="last_events">
            <h2>Последние события волжского спорта</h2>
            <?
                $writer = new EventGenericListWriter;
                $template = $_SERVER['DOCUMENT_ROOT'] . '/templates/blocks/press_list_generic_item.html';
                $writer->setTemplate($template);
                $eventsList = new EventsList;
                $eventsList->write($writer);
            ?>
            <!-- <div class="underline"><a href="#">все новости &darr;</a></div> -->
        </td>

        <td class="most_popular">
            <h2>Самое читаемое</h2>
            <br />
            <?
                $writer = new EventFavouritesListWriter;
                $template = $_SERVER['DOCUMENT_ROOT'] . '/templates/blocks/press_list_favourites_item.html';
                $writer->setTemplate($template);
                $eventsList = new EventsList;
                $eventsList->write($writer);
            ?>
        </td>
    </tr>
</table>