<table id="page-header" width="100%">
	<tr>
		<td><h3>PENGURUSAN PROFAIL MAKLUMAT PELAJAR</h3></td>
		<td align="right"><a id="topright-menu" class="modal-trigger" href="<?php echo site_url('profiles/students/manage/add/new'); ?>">DAFTAR PELAJAR</a></td>
	</tr>
	<tr>
		<td>Sila pilih kelas bagi pendaftaran/pengubahsuaian maklumat pelajar.</td>
		<td align="right">&nbsp;</td>
	</tr>
</table>
<br />
<table border="1" cellpadding="5" width="100%">
<thead>
<td>Nama Kelas</td>
<td>Jumlah Bilangan Pelajar</td>
</thead>
<tbody>
<?php
foreach($yearslist as $iyearslist)
{
	echo "<tr bgcolor=\"#C9C299\"><td colspan=\"2\">Senarai Kelas Tahun " . $iyearslist->is_years_title . " (" . $iyearslist->is_years_digit . ")" . "</td></tr>";
	
	foreach($classlist as $iclasslist)
	{
		$url = site_url('profiles/students/classes/' . $iyearslist->is_years_digit . '/' . $iclasslist->is_class_ind);
		echo "
		<tr>
		<td><a href=\"$url\">" . $iclasslist->is_class_title . "</a></td>
		<td>" . $totalstudents["$iyearslist->is_years_digit"]["$iclasslist->is_class_ind"] . "</td>
		</tr>";
	}
}
?>
</tbody>
</table>
<?php echo $ajaxmodal; ?>
