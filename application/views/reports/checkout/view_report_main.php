<table id="page-header" width="100%">
	<tr>
		<td><h3>LAMAN LAPORAN PENGELUARAN BUKU</h3></td>
		<td align="right">&nbsp;</td>
	</tr>
	<tr>
		<td>Berikut adalah laporan pengeluaran buku bagi kelas yang telah dipilih.</td>
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
		$url = site_url('reports/checkout/classes/' . $iyearslist->is_years_digit . '/' . $iclasslist->is_class_ind);
		echo "
		<tr>
		<td><a href=\"$url\">" . $iclasslist->is_class_title . "</a></td>
		<td>" . $totalstudents["$iyearslist->is_years_digit"]["$iclasslist->is_class_ind"] . "</td>
		</tr>";
	}
}
?>
</tbody>
<table>
