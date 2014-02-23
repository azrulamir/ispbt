<table id="page-header" width="100%">
	<tr>
		<td><h3><a href="<?php echo site_url('reports/checkout'); ?>">LAPORAN PENGELUARAN BUKU</a> > MAKLUMAT PENGELUARAN</h3></td>
		<td align="right"><a id="topright-menu" class="modal-trigger" href="<?php echo site_url('reports/checkout/reportsummary'); ?>">RUMUSAN PENGELUARAN</a></td>
	</tr>
	<tr>
		<td>Berikut adalah laporan pengeluaran buku bagi kelas yang telah dipilih.</td>
		<td align="right">Kelas <?php echo $yeartitle . " (" . $yeardigit . ")" . " - " . $classname; ?></td>
	</tr>
</table>
<br />
<div id="report-container">
<table border="1" cellpadding="2" width="150%">
<thead>
<td><center>No.</center></td>
<td><center>Nama Pelajar</center></td>
<?php
$labelArrage = array();
foreach ($booksdetails as $value)
{
	$labelArray = explode(" ", $value->is_books_label);
	$labelArrage[] = $value->is_books_ind;
	
	$labels = "";
	foreach($labelArray as $labelVal)
	{
		$labels .= $labelVal . "<br />";
	}
	echo "<td><center>" . $labels . "</center></td>";
}
?>
<td><center>Jumlah<br /> Pinjaman</center></td>
</thead>
<tbody>
<?php
$bil = 1;
foreach($checkoutdetails as $value)
{

	echo "
	<tr><td><center>" . $bil . "</center></td><td>" . $value->is_students_name . "</td>
	";
	
	$loanedbooks = explode(',', $value->is_checkout_books);
	
	$i = 0;
	foreach ($labelArrage as $value2)
	{
		$output = false;
		for ($j=0; $j<sizeof($loanedbooks); $j++)
		{	
			if ($loanedbooks["$j"] == $labelArrage["$i"])
			{
				$output = true;
			}
		}
		
		if ($output == true)
		{
			echo "<td><center>1</center></td>";
		}
		else
		{
			echo "<td><center>0</center></td>";
		}
		$i++;
	}
	
	echo "
	<td><center>" . $value->is_checkout_bookstotal . "</center></td>
	</tr>
	";
	
	$bil++;
}
?>
</tbody>
</table>
</div>
<br />
<table>
	<tr>
		<td>
		<form action="<?php echo site_url('reports/checkout/printprev/' . $yeardigit . '/' . $classind); ?>">
		<input type="submit" value="Print Preview" />
		</form>
		</td>
		<td><form action="<?php echo site_url('reports/generatepdf/checkout/' . $yeardigit . '/' . $classind); ?>">
		<input type="submit" value="Jana Dokumen PDF" />
		</form>
		</td>
	</tr>
</table>
<?php echo $ajaxmodal; ?>
