<form method="post" enctype="multipart/form-data" role="form" class="form-horizontal col-sm-6 col-sm-offset-1">
<div class="form-group  has-feedback">
  <label for="title" class="col-sm-2">Заголовок</label>
  {title}</div>
<div class="form-group  has-feedback">
  <label for="dateAnn" class="col-sm-2">Дата</label>
  {dateAnn}</div>
<div class="form-group  has-feedback">
  <label for="details" class="col-sm-2">Детали</label>
  {details}</div>
<div class="form-group  has-feedback">
  <label for="summary" class="col-sm-2">Бриф</label>
  {lead}</div>
<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span> Добавить</button>
<input type="hidden" name="action" value="modifyannounce" />
	{id}
</form>