<form method="post" enctype="multipart/form-data">
	<table class="placeholder">
		<tr><td>��������</td><td colspan="5">{title}</td></tr>
		<tr>
			<td>����</td><td>{eventdate}</td>
			<td>���</td><td>{type}</td>
			<td>���������</td><td>{category}</td>
		</tr>
		<tr>
			<td>����������</td>
			<td>{participants}</td>
			<td>��������</td>
			<td>{importance}</td>
			<td>������</td>
			<td>{topflag}</td>
		</tr>
		<tr>
			<td>�����</td>
			<td colspan="4">{place}</td>
			<td>&nbsp;</td>
		</tr>
		<tr><td>����</td><td colspan="5">{summary}</td></tr>
		<tr><td>��������</td><td colspan="5">{description}</td></tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="5">zip-����� �&nbsp;������������� (��&nbsp;����� {MAX_FILE_SIZE}&nbsp;��)</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td colspan="5">{imagepack}</td>
		</tr>				
		<tr><td colspan="6" class="rght"><input type="submit" value="��������" /></td></tr>
	</table>
	<input type="hidden" name="action" value="addevent" />
</form>