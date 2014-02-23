<table id="page-header" width="100%">
	<tr>
		<td><h3><a href="<?php echo site_url('books/checkin'); ?>">PEMULANGAN BUKU</a> > SENARAI PELAJAR</h3></td>
		<td align="right"><p>Kelas <?php echo $classdetail->is_years_title . " (" . $classdetail->is_years_digit . ")" . " - " . $classdetail->is_class_title; ?></p></td>
	</tr>
	<tr>
		<td>Berikut adalah senarai pelajar mengikut kelas yang dipilih. Sila klik pada nama pelajar untuk memulakan transaksi. 	</td>
		<td align="right">&nbsp;</td>
	</tr>
</table>
<br />
<table border="1" cellpadding="5" width="100%">
	<thead>
		<td><center>No.</center></td>
		<td>Nama Pelajar</td>
		<td><center>Jumlah<br /> Pinjaman</center></td>
		<td><center>Jumlah<br /> Pulangan</center></td>
		<td><center>Jumlah<br /> Rosak</center></td>
		<td><center>Tarikh</center></td>
		<td><center>Masa</center></td>
		<td><center>Status</center></td>
	</thead>
<tbody>
<?php
$i=1;
foreach($students as $value)
{
	$processurl = site_url("books/checkin/check/record/" . $value->is_students_year . "/" . $value->is_students_class . "/" . $value->is_students_ind);
	if ($value->is_checkout_bookstotal == "")
	{
		$checkoutotal = "";
	}
	else
	{
		$checkoutotal = $value->is_checkout_bookstotal;
	}

	date_default_timezone_set('Asia/Kuala_Lumpur');
	$dayN = date('N', strtotime($value->is_checkin_date));
	$dayO = date('d', strtotime($value->is_checkin_date));
	$day = $this->Mod_basedetails->get('get_days', $dayN);
	$monthN = date('m', strtotime($value->is_checkin_date));
	$month = $this->Mod_basedetails->get('get_months', $dayN);
	$yearN = date('Y', strtotime($value->is_checkin_date));
	$fulldate = $day . ", " . $dayO . "/" . $monthN . "/" . $yearN;

	if ($value->is_checkin_bookstotal != NULL)
	{
		echo "
		<tr bgcolor=\"#FFF8C6\">
		<td><center>$i</center></td>
		<td><a class=\"modal-trigger\" href=\"$processurl\">$value->is_students_name</td>
		<td><center>$checkoutotal</center></td>
		<td><center>$value->is_checkin_bookstotal</center></td>
		<td><center>$value->is_checkout_damagestotal " . "/" . " $value->is_checkin_damagestotal</center></td>
		<td><center>$fulldate</center></td>
		<td><center>$value->is_checkin_time</center></td>
		<td><center>$value->is_stat_title</center></td>
		</tr>
		";
	}
	else
	{
		echo "
		<tr>
			<td><center>$i</center></td>
			<td><a class=\"modal-trigger\" href=\"$processurl\">$value->is_students_name</td>
			<td></td>
			<td></td>
			<td><center>$value->is_checkout_damagestotal</center></td>
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
