<table id="page-header" width="100%">
	<tr>
		<td><h3><a href="<?php echo site_url('books/stocks'); ?>">PENGURUSAN STOK</a> > RUMUSAN</td>
		<td align="right"></td>
	</tr>
</table>
<table border="1" cellpadding="5" width="100%">
<tr>
	<td>Jumlah Dalam Simpanan</td>
	<td><center><?php echo number_format($stocks->instocks); ?></center></td>
</tr>
<tr>
	<td>Jumlah Pengeluaran Buku</td>
	<td><center><?php echo number_format($stocks->outstocks); ?></center></td>
</tr>
<tr>
	<td align="right"><span style="font-weight: bold; color: #F87431">Jumlah</span></td>
	<td><span style="font-weight: bold; color: #F87431"><center><?php echo number_format($stocks->totalstocks); ?></span></center></td>
</tr>
</table>
