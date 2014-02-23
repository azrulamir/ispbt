<table id="page-header" width="100%">
	<tr>
		<td><h3><a href="<?php echo site_url('books/checkout/classes/' . $student->is_students_year . '/' . $student->is_students_class); ?>">PENYERAHAN BUKU</a> > BORANG SERAHAN BUKU</h3></td>
		<td align="right"><a id="topright-menu" class="modal-trigger" title="Papar maklumat pelajar" href="<?php echo site_url('books/checkout/studentinfo/' . $student->is_students_ind); ?>"><?php echo $student->is_students_name; ?></a></td>
	</tr>
	<tr>
		<td>Berikut adalah maklumat pelajar dan senarai buku mengikut tahun yang dipilih. Sila pilih buku - buku yang akan <br />diserahkan dan klik 'Simpan' untuk menyimpan maklumat transaksi.</td>
		<td align="right">&nbsp;</td>
	</tr>
</table>
<br />
<form id="main-form" action="<?php echo site_url("books/checkout/process"); ?>" method="post">
<table border="1" cellpadding="5" width="100%">
<thead>
<td><center>Bil.</center></td>
<td><center><input type="checkbox" id="select-all" title="Pilih Semua" onClick="toggleChecked(this.checked)" /></center></td>
<td>Judul Buku</td>
<td><center>Buku <br />Rosak</center></td>
<td><center>Kod</center></td>
<td><center>Harga</center></td>
<td><center>Penulis Buku</center></td>
<td><center>Label Buku</center></td>
</thead>
<tbody>
<?php
	$i = 1;
foreach($books as $iBooks)
{	
	$loanedchecked = "";
	$loaneddisabled = "disabled";
	$damagedisabled = "disabled";
	foreach($outloanedbooks as $results => $value)
	{
		if ($iBooks['is_books_ind'] == $value)
		{
			$loanedchecked = "checked";
			$damagedisabled = "";	
		}
	}
	
	if ($iBooks['is_books_instocks'] > 0)
	{
		$loaneddisabled = "";
	}
	
	$damagedchecked = "";
	foreach($damagedbooks as $results => $value)
	{
		if ($iBooks['is_books_ind'] == $value)
		{
			$damagedchecked = "checked";
		}
	}
	
	echo "
	<tr>
	<td><center>$i</center></td>
	<td><center><input class=\"checkbox\" type=\"checkbox\" name=\"books-$i\" value=\"" . $iBooks['is_books_ind'] . "\" onclick=\"outDamageToggle(this.checked, " . $iBooks['is_books_ind'] . ")\" title=\"" . $iBooks['is_books_title'] . "\" $loanedchecked $loaneddisabled /></center></td>
	<td>" . $iBooks['is_books_title'] . "</td>
	<td><center><input class=\"damagebooks\" type=\"checkbox\" name=\"damagebooks-$i\" value=\"" . $iBooks['is_books_ind'] . "\" title=\"" . $iBooks['is_books_title'] . "\" $damagedchecked $damagedisabled /></center></td>
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
		<td><label>Status Pinjaman : </label></td>
		<td>
		<select name="status">
		<?php
			foreach($statusarray as $iStatus)
			{
				$selected = "";
				if ($iStatus['is_stat_ind'] == $status)
				{
					$selected = "SELECTED";
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
		<input id="main-form" class="modal-button-trigger" type="button" alt="<?php echo site_url('books/checkout/confirm/edit/' . $student->is_students_ind . "/main-form"); ?>" value="Simpan" />
		<input type="hidden" name="studentid" value="<?php echo $student->is_students_ind; ?>" />
		<input type="hidden" name="inserted" value="<?php echo $inserted ?>" /></form>
	</td>
	<td>
		<form id="alert" action="<?php echo site_url('books/checkout/remove/' . $student->is_students_ind); ?>" method="post">
		<input id="alert" class="modal-button-trigger" type="button" alt="<?php echo site_url('books/checkout/confirm/remove/' . $student->is_students_ind . "/alert"); ?>" value="Hapus rekod" />
		</form>
	</td>
</tr>
</table>
<?php echo $ajaxmodal; ?>
