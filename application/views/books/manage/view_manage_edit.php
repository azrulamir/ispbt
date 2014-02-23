<table id="page-header" width="100%">
	<tr>
		<td><h3><a href="<?php echo site_url('books/manage/classes/' . $bookdetail->is_books_year); ?>">PENGURUSAN MAKLUMAT BUKU</a> > BORANG PENGUBAHSUAIN</h3></td>
		<td align="right">&nbsp;</td>
	</tr>
	<tr>
		<td>Berikut adalah maklumat penuh dan borang pengubahsuaian bagi buku yang <br />telah dipilih.</td>
		<td align="right">&nbsp;</td>
	</tr>
</table>
<br />
<form method="post" action="<?php echo site_url('books/manage/process/edit/' . $bookdetail->is_books_ind); ?>">
<table border="1" cellpadding="5" width="100%">
	<tr>
		<td><label>Judul Buku</label></td>
		<td><input type="text" name="title" value="<?php echo $bookdetail->is_books_title; ?>" /></td>
	</tr>
	<tr>
		<td><label>Kod</label></td>
		<td><input type="text" name="code" value="<?php echo $bookdetail->is_books_code; ?>" /></td>
	</tr>

	<?php
	$output = "</tr><td><label>Tahun Kelas</label></td><td><select name=\"year\">";
	foreach($yearlist as $value)
	{
		$selected = "";
		if ($value['is_years_digit'] == $bookdetail->is_books_year)
		{
			$selected = "SELECTED";
		}
		$output .= "<option value=\"" . $value['is_years_digit'] . "\" $selected>" . $value['is_years_digit'] . " - " . $value['is_years_title'] . "</option>";
	}
	$output .= "</select></td></tr>";
	echo $output;
	?>

	<tr>
		<td><label>Harga (RM)</label></td>
		<td><input type="text" name="price" value="<?php echo number_format($bookdetail->is_books_price, 2, '.', ''); ?>" /></td>
	</tr>
	<tr>
		<td><label>Penulis Buku</label></td>
		<td><input type="text" name="author" value="<?php echo $bookdetail->is_books_author; ?>" /></td>
	</tr>
	<tr>
		<td><label>Label</label></td>
		<td><input type="text" name="label" value="<?php echo $bookdetail->is_books_label; ?>" /></td>
	</tr>
</table>
<br />
<table>
	<tr>
		<td><input type="submit" value="Simpan" /></form></td>
		<td><input id="alert" type="button" onClick="toggleConfirm()" value="Hapus rekod" /></td>
		<td colspan="2" id="confirm"><a id="modal-confirmlink" href="<?php echo site_url('books/manage/process/remove/' . $bookdetail->is_books_ind); ?>">Sila klik di sini sekiranya muktamad!!</a></td>
	</tr>
</table>
