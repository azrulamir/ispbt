<table id="page-header" width="100%">
	<tr>
		<td><h3><a href="<?php echo site_url('profiles/students'); ?>">PROFAIL MAKLUMAT PELAJAR</a> > BORANG PENDAFTARAN PELAJAR</h3></td>
		<td align="right">&nbsp;</td>
	</tr>
	<tr>
		<td>Berikut adalah borang bagi pendaftaran pelajar. Sila penuhkan kesemua ruangan <br />borang di bawah.</td>
		<td align="right">&nbsp;</td>
	</tr>
</table>
<br />
<form method="post" action="<?php echo site_url('profiles/students/process/add/new'); ?>">
<table border="1" cellpadding="5" width="100%">
	<tr>
		<td><label>Nama Pelajar</label></td>
		<td><input type="text" name="name" value=""</td>
	</tr>
	<tr>
		<td><label>Tahun</label></td>
		<td>
		<?php
			echo "<select name=\"year\">";
			foreach($yearlist as $value)
			{	
				echo "<option value=\"" . $value['is_years_digit'] . "\">" . $value['is_years_title'] . "</option>";
			}
			echo "</select>";
		?>
		</td>
	</tr>
	<tr>
		<td><label>Kelas</label></td>
		<td>
		<?php
			echo "<select name=\"class\">";
			foreach($classlist as $value)
			{	
				echo "<option value=\"" . $value['is_class_ind'] . "\">" . $value['is_class_title'] . "</option>";
			}
			echo "<select>";
		?>
		</td>
	</tr>
	<tr>
		<td><label>Jantina</label></td>
		<td>
		<?php
			echo "<select name=\"gender\">";
			foreach($genderlist as $value)
			{	
				echo "<option value=\"" . $value['is_gender_ind'] . "\">" . $value['is_gender_title'] . "</option>";
			}
			echo "<select>";
		?>
		</td>
	</tr>
	</tr>
		<td><label>Bangsa</label></td>
		<td>
		<?php
			echo "<select name=\"race\">";
			foreach($racelist as $value)
			{	
				echo "<option value=\"" . $value['is_race_ind'] . "\">" . $value['is_race_title'] . "</option>";
			}
			echo "<select>";
		?>
		</td>
	</tr>
	</tr>
		<td><label>Agama</label></td>
		<td>
		<?php
			echo "<select name=\"religion\">";
			foreach($religionlist as $value)
			{	
				echo "<option value=\"" . $value['is_religion_ind'] . "\">" . $value['is_religion_title'] . "</option>";
			}
			echo "<select>";
		?>
		</td>
	</tr>
	<tr>
		<td><label>Status Anak Yatim</label></td>
		<td>
		<?php
			echo "<select name=\"orphan\">";
			foreach($orphanlist as $value)
			{	
				echo "<option value=\"" . $value['is_orphan_ind'] . "\">" . $value['is_orphan_title'] . "</option>";
			}
			echo "<select>";
		?>
		</td>
		</td>
	</tr>
</table>
<br />
<table>
<tr>
<td>
<input type="submit" value="Simpan" />
</td>
</tr>
</table>
</form>
