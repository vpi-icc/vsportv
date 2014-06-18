<div class="container">
	<form method="post" enctype="multipart/form-data" role="form" class="form-horizontal col-sm-6">
    <div class="form-group has-feedback"><label for="title" class="col-sm-2">Заголовок</label>
			    {title}</div>
    <div class="form-group has-feedback"><label for="summary" class="col-sm-2">Бриф</label>
    {summary}</div>
    <div class="form-group has-feedback"><label for="description" class="col-sm-2">Описание</label>
    {description}</div>
    <div class="form-group has-feedback">
    	<label for="imagepack">zip-архив с&nbsp;изображениями (не&nbsp;более {MAX_FILE_SIZE}&nbsp;МБ)</label>
        {imagepack}
    </div>				
		<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Добавить</button>
	<input type="hidden" name="action" value="addevent" />
</form>
</div>