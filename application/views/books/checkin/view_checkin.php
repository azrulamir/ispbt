<table id="page-header" width="100%">
	<tr>
		<td><h3>LAMAN PENGURUSAN PEMULANGAN BUKU</h3></td>
		<td align="right">&nbsp;</td>
	</tr>
	</tr>
		<tr>
		<td>Sila pilih kelas bagi memulakan proses pemulangan buku.</td>
		<td align="right">&nbsp;</td>
	</tr>
</table>
<br />
<table border="1" cellpadding="5" width="100%">
	<thead>
		<td>Nama Kelas</td>
		<td>Jumlah Bilangan Pelajar</td>
		<td>Status Pemulangan (%)</td>
	</thead>
<tbody>
<?php
foreach($yearslist as $iyearslist)
{
	echo "<tr bgcolor=\"#C9C299\"><td colspan=\"3\">Senarai Kelas Tahun " . $iyearslist->is_years_title . " (" . $iyearslist->is_years_digit . ")" . "</td></tr>";
	
	foreach($classlist as $iclasslist)
	{
		$url = site_url('books/checkin/check/classtotal/' . $iyearslist->is_years_digit . '/' . $iclasslist->is_class_ind);
		echo "
		<tr>
		<td><a class=\"modal-trigger\" href=\"$url\">" . $iclasslist->is_class_title . "</a></td>
		<td>" . $totalstudents["$iyearslist->is_years_digit"]["$iclasslist->is_class_ind"] . "</td>
		<td></td>
		</tr>";
	}
}
?>
</tbody>
</table>
<?php echo $ajaxmodal; ?>
