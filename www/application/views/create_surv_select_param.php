<form action='/create_surv/edit' method='POST'>
	<table style='margin: 0 auto; width: 500px;'>
		<tr>
			<td colspan = '2' style='width: 500px; height: 150px; text-align: center;'>
				<strong>Survey Name: <input type='text' name='name'></strong>
			</td>
		</tr>
		<tr>
			<td><!--
				<table>
					<tr>
						<td colspan = '2' style='text-align: left;'>Select layout:</td>
					</tr>
					<tr>
						<td style='padding-right: 10px;'><input type='radio' name='layout' value='0' checked>Portrait</td>
						<td style='padding-right: 10px;'><input type='radio' name='layout' value='1'>Landscape</td>
						
						
					</tr>
					<tr>
						<td><div style='width: 100px; height: 200px; background: blue;'></div></td>
						<td><div style='width: 200px; height: 60px; background: blue; margin-top: 0px;'></div></td>
					</tr>
				</table>-->
				<input type='hidden' name='layout' value='0' />
			</td>
			<td>
				<table style='width: 200px;'>
					<tr><td>Select question type form: </td></tr>
					<tr><td><input type='radio' name='type_form' value='0' checked>Radiobutton</td></tr>
					<tr><td><input type='radio' name='type_form' value='1'>Checkbox</td></tr>
					<tr><td><input type='radio' name='type_form' value='2'>Drop-down menu</td></tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan='2' style='text-align: right;'>
				<input type='submit' value='Next->'>
			</td>
		</tr>
	</table>
</form>