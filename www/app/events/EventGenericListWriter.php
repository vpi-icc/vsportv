<?
class EventGenericListWriter extends GenericWriter
{
    protected $templateFile = NULL;

    public function write(IManageable $eventsList)
    {
        /*
        global $selectedEvents;
        $selectedEvents = implode(',', $selectedEvents);
        */
        // AND id NOT IN (" . $selectedEvents . ")

        $query = "
			SELECT
				id, id_cover, title, summary
			FROM
				kfkis_events
			WHERE
				( flags != 'HIDDEN' OR flags IS NULL ) 				
			ORDER BY id DESC
			LIMIT 6 OFFSET 3";

        $events = $eventsList->fetch($query);

        foreach ( $events as $event )
        {
            $entry = file_get_contents($this->templateFile);
            $search = array('id', 'title', 'description', 'cover');

            foreach ( $search as &$label )
            {
                $label = '{' . $label . '}';
            }

            $replace = array($event['id'], $event['title'], $event['summary'], $event['id_cover']);

            /*
            if ( $event['id_cover'] )
                $image_src = '/_images/events/' . $event['id'] . '/' . $event['id_cover'] . '_small.jpg';
            else
                $image_src = '/_images/_layout/no_image_150.gif';

            $replace[] = $image_src;
            */
            echo str_replace($search, $replace, $entry);
        }
    }
}
?>
