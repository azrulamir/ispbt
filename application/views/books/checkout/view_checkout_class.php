<table id="page-header" width="100%">
	<tr>
		<td><h3><a href="<?php echo site_url('books/checkout'); ?>">PENYERAHAN BUKU</a> > SENARAI PELAJAR</h3></td>
		<td align="right"><p>Kelas <?php echo $classdetail->is_years_title . " (" . $classdetail->is_years_digit . ")" . " - " . $classdetail->is_class_title; ?></p></td>
	</tr>
	<tr>
		<td>Berikut adalah senarai pelajar mengikut kelas yang dipilih. Sila klik pada nama pelajar untuk memulakan transaksi.</td>
		<td align="right">&nbsp;</td>
	</tr>
</table>
<br />
<table cellpadding="5" width="100%">
	<thead>
		<td><center>No.</center></td>
		<td>Nama Pelajar</td>
		<td><center>Jumlah<br /> Pinjaman</center></td>
		<td><center>Jumlah <br />Rosak</center></td>
		<td><center>Tarikh</center></td>
		<td><center>Masa</center></td>
		<td><center>Status</center></td>
	</thead>
<tbody>
<?php
$i=1;
foreach($students as $value)
{
	date_default_timezone_set('Asia/Kuala_Lumpur');
	$dayN = date('N', strtotime($value->is_checkout_date));
	$dayO = date('d', strtotime($value->is_checkout_date));
	$day = $this->Mod_basedetails->get('get_days', $dayN);
	$monthN = date('m', strtotime($value->is_checkout_date));
	$month = $this->Mod_basedetails->get('get_months', $dayN);
	$yearN = date('Y', strtotime($value->is_checkout_date));
	$fulldate = $day . ", " . $dayO . "/" . $monthN . "/" . $yearN;

	$processurl = site_url("books/checkout/studentid") . "/" . $value->is_students_ind;
	if ($value->is_checkout_bookstotal != NULL)
	{
		echo "
		<tr bgcolor=\"#FFF8C6\">
		<td><center>$i</center></td>
		<td><a href=\"$processurl\">$value->is_students_name</a></td>
		<td><center>$value->is_checkout_bookstotal</center></td>
		<td><center>$value->is_checkout_damagestotal</center></td>
		<td><center>$fulldate</center></td>
		<td><center>$value->is_checkout_time</center></td>
		<td><center>$value->is_stat_title</center></td>
		</tr>
		";
	}
	else
	{
		echo "
		<tr>
		<td><center>$i</center></td>
		<td><a href=\"$processurl\">$value->is_students_name</a></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		</tr>
		";
	}
	$i++;
}
?>
</tbody>
</table>
<?php echo $ajaxmodal; ?>
