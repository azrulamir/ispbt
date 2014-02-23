<table id="page-header" width="100%">
	<tr>
		<td><h3><a href="<?php echo site_url('books/checkin/classes/' . $student->is_students_year . '/' . $student->is_students_class); ?>">PEMULANGAN BUKU</a> > BORANG PEMULANGAN BUKU</h3></td>
		<td align="right"><a id="topright-menu" class="modal-trigger" title="Papar maklumat pelajar" href="<?php echo site_url('books/checkin/studentinfo/' . $student->is_students_ind); ?>"><?php echo $student->is_students_name; ?></td>
	</tr>
	<tr>
		<td>Berikut adalah maklumat pelajar dan senarai buku mengikut tahun yang dipilih. Sila pilih buku - buku yang akan <br />dipulangkan dan klik 'Simpan' untuk meneruskan transaksi.</td>
		<td align="right">&nbsp;</td>
	</tr>
</table>
<br />
<form id="main-form" action="<?php echo site_url("books/checkin/process"); ?>" method="post">
<table border="1" cellpadding="5" width="100%">
<thead>
<td><center>Bil.</center></td>
<td><center><input type="checkbox" id="select-all" title="Pilih Semua" onClick="toggleChecked(this.checked)" /></center></td>
<td>Judul Buku</td>
<td><center>Buku <br />Rosak</center></td>
<td><center>Kod</center></td>
<td><center>Harga</center></td>
<td>Penulis Buku</td>
<td>Label Buku</td>
</thead>
<tbody>
<?php
$i = 1;
foreach($books as $iBooks)
{	
	$altvalue = "fixed";
	$loanedchecked = "";
	$loaneddisabled = "disabled";
	
	$damagedchecked = "";
	$damagedisabled = "disabled";
	
	foreach($inloanedbooks as $results => $value)
	{
		if ($iBooks['is_books_ind'] == $value)
		{
			$loanedchecked = "checked";
			$damagedisabled = "";
		}
		
		foreach($outloanedbooks as $results2 => $value2)
		{
			if ($iBooks['is_books_ind'] == $value2)
			{
				$loaneddisabled = "";
				$altvalue = "";
			}
		}
		
	}
	
	foreach($indamagedbooks as $results => $value)
	{
		if ($iBooks['is_books_ind'] == $value)
		{
			$damagedchecked = "checked";
		}
		
		foreach($outdamagedbooks as $results2 => $value2)
		{
			if ($iBooks['is_books_ind'] == $value2)
			{
				$damagedisabled = "disabled";
				$damagedchecked = "checked";
				$altvalue = "fixed";
			}
		}
	}
	
	echo "
	<tr>
	<td><center>$i</center></td>
	<td><center><input class=\"checkbox\" type=\"checkbox\" name=\"books-$i\" value=\"" . $iBooks['is_books_ind'] . "\" onclick=\"inDamageToggle(this.checked, " . $iBooks['is_books_ind'] . ")\" title=\"" . $iBooks['is_books_title'] . "\" $loanedchecked $loaneddisabled /></center></td>
	<td>" . $iBooks['is_books_title'] . "</td>
	<td><center><input class=\"damagebooks\" type=\"checkbox\" name=\"damagebooks-$i\" value=\"" . $iBooks['is_books_ind'] . "\" alt=\"$altvalue\" title=\"" . $iBooks['is_books_title'] . "\" $damagedchecked $damagedisabled /></center></td>
	<td><center>" . $iBooks['is_books_code'] . "</center></td>
	<td><center>RM " . number_format($iBooks['is_books_price'], 2, '.', '') . "</center></td>
	<td>" . $iBooks['is_books_author'] . "</td>
	<td>" . $iBooks['is_books_label'] . "</td>
	</tr>";
	$i++;
}
?>
</tbody>
</table>
<br />
<table border="1" cellpadding="5" width="100%">
	<tr>
		<td><label>Status Pemulangan : </label></td>
		<td>
		<select name="status">
		<?php
			foreach($statusarray as $iStatus)
			{
				if ($iStatus['is_stat_ind'] == $status)
				{
					$selected = "SELECTED";
				}
				else
				{
					$selected = "";
				}
				echo "<option value=\"" . $iStatus['is_stat_ind'] . "\" $selected>" . $iStatus['is_stat_title'] . "</option>";
			}
		?>
		</select>
		</td>
	</tr>
	<tr>
		<td><label>Catatan : </label></td>
		<td><textarea name="remark" value="<?php echo $remark; ?>"><?php echo $remark; ?></textarea></td>
	</tr>
</table>
<br />
<table>
<tr>
	<td>
	<input id="main-form" type="submit" value="Simpan" />
	<input type="hidden" name="studentid" value="<?php echo $student->is_students_ind; ?>" />
	<input type="hidden" name="checkoutid" value="<?php echo $checkoutid; ?>" />
	<input type="hidden" name="inserted" value="<?php echo $inserted; ?>" />
	</form>
	</td>
	<td>
	<form id="alert" action="<?php echo site_url('books/checkin/remove/' . $student->is_students_ind); ?>" method="post">
	<input id="alert" class="modal-button-trigger" type="button" alt="<?php echo site_url('books/checkin/confirm/remove/' . $student->is_students_ind) . "/alert"; ?>" value="Hapus rekod" />
	</form>
	</td>
</tr>
</table>
<?php echo $ajaxmodal; ?>
