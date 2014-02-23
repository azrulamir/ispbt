<table id="page-header" width="100%">
	<tr>
		<td><h3>LAPORAN PEMULANGAN BUKU > MAKLUMAT KEMASUKAN</h3></td>
		<td align="right"></td>
	</tr>
	<tr>
		<td></td>
		<td align="right"><p>Kelas <?php echo $yeartitle . " (" . $yeardigit . ")" . " - " . $classname; ?></p></td>
	</tr>
</table>
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
</thead>
<tbody>
<?php
$bil = 1;
foreach($checkindetails as $value)
{
	echo "<tr><td><center>" . $bil . "</center></td><td>" . $value->is_students_name . "</td>";
	$loanedbooks = explode(',', $value->is_checkin_books);
	
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
	<td><center>" . $value->is_checkin_bookstotal . "</center></td>
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
		<form action="<?php echo site_url('reports/checkin/printprev/' . $yeardigit . '/' . $classind); ?>">
		<input type="submit" value="Print Preview" />
		</form>
		</td>
		<td><form action="<?php echo site_url('reports/generatepdf/checkout/' . $yeardigit . '/' . $classind); ?>">
		<input type="submit" value="Create PDF" />
		</form>
		</td>
	</tr>
</table>
