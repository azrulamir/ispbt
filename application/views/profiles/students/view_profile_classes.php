<table id="page-header" width="100%">
	<tr>
		<td><h3><a href="<?php echo site_url('profiles/students'); ?>">PROFAIL MAKLUMAT PELAJAR</a> > SENARAI PELAJAR</h3></td>
		<td align="right"><a id="topright-menu" class="modal-trigger" href="<?php echo site_url('profiles/students/manage/add/new'); ?>">DAFTAR PELAJAR</a></td>
	</tr>
	<tr>
		<td>Berikut adalah senarai pelajar mengikut kelas yang dipilih. Sila klik pada link nama pelajar untuk  mengubahsuai atau <br />klik '<b>DAFTAR PELAJAR</b>' bagi pendaftaran pelajar baru.</td>
		<td align="right"><p>Kelas <?php echo $classdetails->is_years_title . " (" . $classdetails->is_years_digit . ")" . " - " . $classdetails->is_class_title; ?></p></td>
	</tr>
</table>
<br />
<table cellpadding="5" width="100%">
<thead>
<td><center>No.</center></td>
<td>Nama Pelajar</td>
<td>Jantina</td>
<td>Bangsa</td>
<td>Agama</td>
<td><center>Status Anak Yatim</center></td>
</thead>
<tbody>
<?php
$i=1;
foreach($students as $value)
{
	$processurl = site_url("profiles/students/manage/edit/" . $value->is_students_ind);
	$rel = $value->is_students_ind;
	echo "
	<tr>
	<td><center>$i</center></td>
	<td><a class=\"modal-trigger\" href=\"$processurl\" rel=\"$rel\">$value->is_students_name</td>
	<td>$value->is_gender_title</td>
	<td>$value->is_race_title</td>
	<td>$value->is_religion_title</td>
	<td><center>$value->is_orphan_title</center></td>
	</tr>
	";
	$i++;
}
?>
</tbody>
</table>
<?php echo $ajaxmodal; ?>
