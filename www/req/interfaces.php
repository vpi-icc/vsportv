<?
interface IManageable
{
	public function add(array $keyValueData);
	public function modify(array $keyValueData);
	public function delete($id);
	public function fetch($query);
	public function getStatusString();
}

interface IGenericWriter
{
	public function write(IManageable $object);	
}

/*
interface IEventWriter extends IGenericWriter
{
	public function write( EventsList $eventList );
}
*/

interface IValidateable
{
	public function validate();
}

interface IFormAction
{
	public function act(XForm $form);
	public function getStatusString();
}

?>