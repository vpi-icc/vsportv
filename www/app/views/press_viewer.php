<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 21.04.14
 * Time: 0:00
 */

if ( !empty($_GET['id']) )
{
    $eventsList = new EventsList;
    $eventWriter = new EventWriter;
    $template = $_SERVER['DOCUMENT_ROOT'] . '/app/views/eventCard.html';
    $eventWriter->setTemplate($template);
    $eventWriter->setEventId($_GET['id']);
    $eventsList->write($eventWriter);

    ?>
    <!--
    <div id="vk_comments" style="margin: 25px auto;"></div>

    <script type="text/javascript">
        VK.Widgets.Comments("vk_comments", {limit: 10, attach: "graffiti,link"});
    </script>
    -->
<?

}
else
{
    $eventGlobalListWriter = new EventGlobalListWriter;
    $template = $_SERVER['DOCUMENT_ROOT'] . '/eventEntryMain.html';
    $eventGlobalListWriter->setTemplate($template);
    $eventsList = new EventsList;
    $eventsList->write($eventGlobalListWriter);
}

?>


<!--
<div id="vk_comments"></div>

<script type="text/javascript">
    VK.Widgets.Comments("vk_comments", {limit: 10, attach: "graffiti,link"});
</script>
-->