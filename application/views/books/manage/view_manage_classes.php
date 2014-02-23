<table id="page-header" width="100%">
	<tr>
		<td><h3><a href="<?php echo site_url('books/manage'); ?>">PENGURUSAN MAKLUMAT BUKU</a> > SENARAI BUKU</h3></td>
		<td align="right"><a id="topright-menu" class="modal-trigger" href="<?php echo site_url('books/manage/add/new'); ?>">DAFTAR BUKU</a></td>
	</tr>
	<tr>
		<td>Berikut adalah senarai buku bagi tahun kelas yang telah dipilih. Sila klik pada judul buku untuk menyemak atau <br />mengubahsuai maklumat.</td>
		<td align="right">&nbsp;</td>
	</tr>
</table>
<br />
<table border="1" cellpadding="5" width="100%">
	<thead>
		<td><center>No.</center></td>
		<td>Judul Buku</td>
		<td><center>Kod<br /> Buku</center></td>
		<td><center>Harga</center></td>
		<td>Penulis</td>
		<td><center>Label Buku</center></td>
		</thead>
<tbody>

<?php
$output = "";
foreach($classprofile as $value)
{	
	$url = 
	$output .= "<tr bgcolor=\"#C9C299\"><td colspan=\"8\">Senarai Buku Tahun " . $value->is_years_title . " (" . $value->is_years_digit . ")". " </td></tr>";
	$i = 1;
	foreach($books as $booksval)
	{
		if ($booksval->is_books_year == $value->is_years_digit)
		{
		$url = site_url('books/manage/exist/' . $booksval->is_books_ind);
		$rel = $booksval->is_books_ind;
		$output .= "<tr>";
		$output .= "<td><center>$i</center></td>";
		$output .= "<td><a class=\"modal-trigger\" rel=\"$rel\" href=\"$url\">" . $booksval->is_books_title . "</a></td>";
		$output .= "<td><center>" . $booksval->is_books_code . "</center></td>";
		$output .= "<td><center>RM " . number_format($booksval->is_books_price, 2, '.', '') . "</center></td>";
		$output .= "<td>" . $booksval->is_books_author . "</td>";
		$output .= "<td><center>" . $booksval->is_books_label . "</center></td>";
		$output .= "</tr>";
		}
		$i++;
	}
	$classyear = $value->is_years_digit;
}
echo $output;
?>

</tbody>
</table>
<?php echo $ajaxmodal; ?>
