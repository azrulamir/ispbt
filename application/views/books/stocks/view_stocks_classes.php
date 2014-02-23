<table id="page-header" width="100%">
	<tr>
		<td><h3><a href="<?php echo site_url('books/stocks'); ?>">PENGURUSAN STOK</a> > SENARAI BUKU</h3></td>
		<td align="right">&nbsp;</td>
	</tr>
	<tr>
		<td>Berikut adalah senarai buku bagi tahun yang dipilih. Klik pada nama buku untuk menyemak atau mengubahsuai maklumat stok.</td>
		<td align="right">&nbsp;</td>
	</tr>
</table>
<br />
<table border="1" cellpadding="5" width="100%">
	<thead>
		<td><center>No.</center></td>
		<td>Judul Buku</td>
		<td><center>Kod<br /> Buku</center></td>
		<td><center>Label<br /> Buku</center></td>
		<td><center>Stok<br /> Simpanan</center></td>
		<td><center>Jumlah<br /> Pengeluaran</center></td>
		</thead>
<tbody>

<?php
$output = "";
foreach($classprofile as $value)
{	
	$output .= "<tr bgcolor=\"#C9C299\"><td colspan=\"6\">Senarai Buku Tahun " . $value->is_years_title . " (" . $value->is_years_digit . ")". "</td></tr>";
	
	$i = 1;
	$booksInStocks = 0;
	$booksOutStocks = 0;
	foreach($books as $booksval)
	{
		if ($booksval->is_books_year == $value->is_years_digit)
		{
		$url = site_url('books/stocks/edit/' . $booksval->is_books_ind);
		$rel = $booksval->is_books_ind;
		$output .= "<tr>";
		$output .= "<td><center>$i</center></td>";
		$output .= "<td><a class=\"modal-trigger\" rel=\"$rel\" href=\"$url\">" . $booksval->is_books_title . "</a></td>";
		$output .= "<td><center>" . $booksval->is_books_code . "</center></td>";
		$output .= "<td><center>" . $booksval->is_books_label . "</center></td>";
		$output .= "<td><center>" . $booksval->is_books_instocks . "</center></td>";
		$output .= "<td><center>" . $booksval->is_books_outstocks . "</center></td>";
		$output .= "</tr>";
		
		$booksInStocks += $booksval->is_books_instocks;
		$booksOutStocks += $booksval->is_books_outstocks;
		}
		$i++;
	}
	
	$output .= "
	<tr>
	<td colspan=\"4\" align=\"right\"><span style=\"font-weight: bold; color: #F87431\">Jumlah Keseluruhan</span></td>
	<td><center><span style=\"font-weight: bold; color: #F87431\">$booksInStocks</span></center></td>
	<td><center><span style=\"font-weight: bold; color: #F87431\">$booksOutStocks</span></center></td>
	</tr>
	";
}
echo $output;
?>
</tbody>
</table>
<?php echo $ajaxmodal; ?>
