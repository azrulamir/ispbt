<table id="page-header" width="100%">
	<tr>
		<td><h3><a href="<?php echo site_url('books/stocks/classes/' . $bookdetail->is_books_year); ?>">PENGURUSAN STOK</a> > UBAHSUAI MAKLUMAT STOK</h3></td>
		<td align="right">&nbsp;</td>
	</tr>
	<tr>
		<td>Berikut adalah maklumat penuh serta borang ubahsuai maklumat stok.</td>
		<td align="right">&nbsp;</td>
	</tr>
</table>
<h3>MAKLUMAT BUKU</h3>
<table border="1" cellpadding="5" width="100%">
	<tr>
		<td><label>Judul Buku</label></td>
		<td><input type="text" name="instocks" value="<?php echo $bookdetail->is_books_title; ?>" /></td>
	</tr>
	<tr>
		<td><label>Kod Buku</label></td>
		<td><input type="text" name="outstocks" value="<?php echo $bookdetail->is_books_code; ?>" readonly/></td>
	</tr>
	<tr>
		<td><label>Label Buku</label></td>
		<td><input type="text" name="totalstocks" value="<?php echo $bookdetail->is_books_label; ?>" readonly/></td>
	</tr>
</table>

<h3>MAKLUMAT STOK</h3>
<form method="post" action="<?php echo site_url('books/stocks/process/edit/' . $bookdetail->is_books_ind); ?>">
<table border="1" cellpadding="5" width="100%">
	<tr>
		<td><label>Baki Simpanan</label></td>
		<td><input type="text" name="instocks" value="<?php echo $stocks->instocks; ?>" /></td>
	</tr>
	<tr>
		<td><label>Jumlah Keluar</label></td>
		<td><input type="text" name="outstocks" value="<?php echo $stocks->outstocks; ?>" readonly/></td>
	</tr>
	<tr>
		<td><label>Jumlah Keseluruhan</label></td>
		<td><input type="text" name="totalstocks" value="<?php echo $stocks->totalstocks; ?>" readonly/></td>
	</tr>
</table>
<br />
<table>
<tr>
<td><input type="submit" value="Simpan" /></td>
</tr>
</table>
</form>
