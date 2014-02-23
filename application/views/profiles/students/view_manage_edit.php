<table id="page-header" width="100%">
	<tr>
		<td><h3><a href="<?php echo site_url('profiles/students/classes/' . $studentdetail->is_students_year . '/' . $studentdetail->is_students_class); ?>">PROFAIL MAKLUMAT PELAJAR</a> > BORANG PENGUBAHSUAIAN</h3></td>
		<td align="right">&nbsp;</td>
	</tr>
	<tr>
		<td>Berikut adalah maklumat penuh serta borang bagi pengubahsuaian maklumat <br />pelajar yang telah dipilih.</td>
		<td align="right">&nbsp;</td>
	</tr>
</table>
<br />
<form method="post" action="<?php echo site_url('profiles/students/process/edit/' . $studentdetail->is_students_ind); ?>">
<table border="1" cellpadding="5" width="100%">
<tr><td><label>Nama : </label></td><td><input type="text" name="name" value="<?php echo $studentdetail->is_students_name; ?>" maxchar="100" /></td></tr>
<?php
	
	$output = "";
	
	# Gender Option
	$output .= "<tr><td><label>Jantina</label></td><td><select name=\"gender\">";
	foreach($genderlist as $value)
	{	
		$selected = "";
		if ($value['is_gender_ind'] == $studentdetail->is_gender_ind)
		{
			$selected = "SELECTED";
		}
		$output .= "<option value=\"" . $value['is_gender_ind'] . "\" $selected>" . $value['is_gender_title'] . "</option>";
	}
	$output .= "</select></td></tr>";
	
	# Year Option
	$output .= "<tr><td><label>Tahun</label></td><td><select name=\"year\">";
	foreach($yearlist as $value)
	{
		$selected = "";
		if ($value['is_years_digit'] == $studentdetail->is_students_year)
		{
			$selected = "SELECTED";
		}
		$output .= "<option value=\"" . $value['is_years_digit'] . "\" $selected>" . $value['is_years_digit'] . " - " . $value['is_years_title'] . "</option>";
	}
	$output .= "</select></td></tr>";
	
	# Class Option
	$output .= "<tr><td><label>Nama Kelas</label></td><td><select name=\"class\">";
	foreach($classlist as $value)
	{	
		$selected = "";
		if ($value['is_class_ind'] == $studentdetail->is_students_class)
		{
			$selected = "SELECTED";
		}
		$output .= "<option value=\"" . $value['is_class_ind'] . "\" $selected>" . $value['is_class_title'] . "</option>";
	}
	$output .= "</select></td></tr>";
	
	# Race Option
	$output .= "<tr><td><label>Bangsa</label></td><td><select name=\"race\">";
	foreach($racelist as $value)
	{
		$selected = "";
		if ($value['is_race_ind'] == $studentdetail->is_students_race)
		{
			$selected = "SELECTED";
		}
		$output .= "<option value=\"" . $value['is_race_ind'] . "\" $selected>" . $value['is_race_title'] . "</option>";
	}
	$output .= "</select></td></tr>";
	
	# Religion Option
	$output .= "<tr><td><label><label>Agama</label></td><td><select name=\"religion\">";
	foreach($religionlist as $value)
	{
		$selected = "";
		if ($value['is_religion_ind'] == $studentdetail->is_students_religion)
		{
			$selected = "SELECTED";
		}
		$output .= "<option value=\"" . $value['is_religion_ind'] . "\" $selected>" . $value['is_religion_title'] . "</option>";
	}
	$output .= "</select></td></tr>";
	
	# Orphan Option
	$output .= "<tr><td><label>Anak Yatim</label></td><td><select name=\"orphan\">";
	foreach($orphanlist as $value)
	{
		$selected = "";
		if ($value['is_orphan_ind'] == $studentdetail->is_students_orphan)
		{
			$selected = "SELECTED";
		}
		$output .= "<option value=\"" . $value['is_orphan_ind'] . "\" $selected>" . $value['is_orphan_title'] . "</option>";
	}
	$output .= "</select></td></tr>";
	
	echo $output;
?>
</table>
<br />
<table>
	<tr>
		<td><input type="submit" value="Simpan" /></form></td>
		<td><input id="alert" type="button" onClick="toggleConfirm()" value="Hapus Rekod" /></td>
		<td colspan="2" id="confirm"><a id="modal-confirmlink" href="<?php echo site_url('profiles/students/process/remove/' . $studentdetail->is_students_ind); ?>">Sila klik di sini sekiranya muktamad!!</a></td>
	</tr>
</table>
