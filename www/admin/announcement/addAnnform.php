<form method="post" enctype="multipart/form-data">
	<table class="placeholder">
		<tr>
          	<td>Название</td>
            <td>{title}</td></tr>
		<tr>
			<td>Дата</td>
            <td>{dateAnn}</td>
		</tr>
		<tr>
			<td>Детали</td>
			<td>{details}</td>
		</tr>
		<tr>
        	<td>Бриф</td>
            <td>{summary}</td>
        </tr>
				
		<tr><td colspan="2" class="rght"><input type="submit" value="Добавить" /></td></tr>
	</table>
	<input type="hidden" name="action" value="addannounce" />
</form>