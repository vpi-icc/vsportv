<form method="post" enctype="multipart/form-data">
	<table class="placeholder">
		<tr><td>Название</td><td colspan="5">{title}</td></tr>
		<tr>
			<td>Дата</td><td>{eventdate}</td>
			<td>Тип</td><td>{type}</td>
			<td>Категория</td><td>{category}</td>
		</tr>
		<tr>
			<td>Участников</td>
			<td>{participants}</td>
			<td>Значение</td>
			<td>{importance}</td>
			<td>Важное</td>
			<td>{topflag}</td>
		</tr>
		<tr>
			<td>Место</td>
			<td colspan="4">{place}</td>
			<td>&nbsp;</td>
		</tr>
		<tr><td>Бриф</td><td colspan="5">{summary}</td></tr>
		<tr><td>Описание</td><td colspan="5">{description}</td></tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="5">zip-архив с&nbsp;изображениями (не&nbsp;более {MAX_FILE_SIZE}&nbsp;МБ)</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="5">{imagepack}</td>
		</tr>				
		<tr><td colspan="6" class="rght"><input type="submit" value="Добавить" /></td></tr>
	</table>
	<input type="hidden" name="action" value="addevent" />
</form>