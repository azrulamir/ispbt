<table id="page-header" width="100%">
	<tr>
		<td><h3><a href="<?php echo site_url('books/manage'); ?>">PENGURUSAN BUKU</a> > BORANG PENDAFTARAN BUKU</h3></td>
		<td align="right"></td>
	</tr>
	<tr>
		<td>Berikut adalah borang bagi pendaftaran buku baru. Sila isi kesemua ruang borang <br />di bawah.</td>
		<td align="right">&nbsp;</td>
	</tr>
</table>
<br />
<form method="post" action="<?php echo site_url('books/manage/process/add/new'); ?>">
<table border="1" cellpadding="5" width="100%">
	<tr>
		<td><label>Judul Buku</label></td>
		<td><input type="text" name="title" value="" /></td>
	</tr>
	<tr>
		<td><label>Kod Buku</label></td>
		<td><input type="text" name="code" value="" /></td>
	</tr>
	<tr>
		<td><label>Tahun Kelas</label></td>
		<td><select name="year">
		<?php
		foreach ($selYear as $value)
		{
			echo "<option value=\"" . $value['is_years_digit'] . "\">" . $value['is_years_digit'] . " - " . $value['is_years_title'] . "</option>";
		}
		?>
		</select></td>
	</tr>
	<tr>
		<td><label>Harga (RM)</label></td>
		<td><input type="text" name="price" value="" /></td>
	</tr>
	<tr>
		<td><label>Penulis</label></td>
		<td><input type="text" name="author" value="" /></td>
	</tr>
	<tr>
		<td><label>Label</label></td>
		<td><input type="text" name="label" value="" /></td>
	</tr>
</table>
<br />
<table>
	<tr>
		<td><input type="submit" value="Daftar" /></form></td>
	</tr>
</table>
