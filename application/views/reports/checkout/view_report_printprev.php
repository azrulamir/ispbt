<div id="container">
<h3>LAPORAN PENGELUARAN BUKU</h3>
<table border="1" cellpadding="2" width="100%">
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
<td><center>Tandatangan<br /> Pelajar</center></td>
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
	<td></td>
	</tr>
	";
	
	$bil++;
}
?>
</tbody>
</table>
</div>
</body>
</html>
