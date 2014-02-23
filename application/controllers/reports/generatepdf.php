<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Generatepdf extends CI_Controller {

	public function checkout($year, $classInd)
	{
		$this->load->library('pdf');
		
		$this->pdf->SetAuthor('Azrul M. Amir');
		$this->pdf->SetTitle('Laporan Pengeluaran Buku');
		$this->pdf->SetSubject('Laporan Pengeluaran Buku');

		$this->pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$this->pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
		$this->pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
		
		$this->pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$this->pdf->SetFont('helvetica', '', 6);
		$this->pdf->AddPage();
		
		$query = $this->db->query("SELECT * FROM ispbt_books WHERE is_books_year = '$year' ORDER BY is_books_ind");
		$booksDetails = $query->result();
		
		$html = '<h3>LAPORAN PENGELUARAN BUKU</h3>';
		$this->pdf->writeHTML($html, true, false, true, false, '');
		
		$html = '
		<table border="1" cellpadding="2" width="100%">
		<thead>
		<td><center>No.</center></td>
		<td><center>Nama Pelajar</center></td>
		';
		
		$labelArrage = array();
		foreach ($booksDetails as $value)
		{
			$labelArray = explode(" ", $value->is_books_label);
			$labelArrage[] = $value->is_books_ind;
	
			$labels = "";
			foreach($labelArray as $labelVal)
			{
				$labels .= $labelVal . "<br />";
			}
			$html .= "<td><center>" . $labels . "</center></td>";
		}
		
		$html .= '
		<td><center>Jumlah<br /> Pinjaman</center></td>
		<td><center>Tandatangan<br /> Pelajar</center></td>
		</thead>
		<tbody>
		';
		
		$query = $this->db->query("SELECT * FROM ispbt_students LEFT JOIN ispbt_checkout ON is_students_ind = is_checkout_loaner WHERE is_students_year = '$year' AND is_students_class = $classInd");
		$checkoutDetails = $query->result();
		
		$bil = 1;
		foreach($checkoutDetails as $value)
		{

			$html .= "
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
					$html .= "<td><center>1</center></td>";
				}
				else
				{
					$html .= "<td><center>0</center></td>";
				}
				$i++;
			}
			
		$html .= "
		<td><center>" . $value->is_checkout_bookstotal . "</center></td>
		<td>&nbsp;</td>
		</tr>
		";

		$bil++;
		}
	
		$html .= "</tbody></table>";

		// Print text using writeHTML()
		$this->pdf->writeHTML($html, true, false, true, false, '');

        //Close and output PDF document
        ob_clean();
        $this->pdf->Output('pdt_example_001.pdf', 'I');
        
        //echo $html;
        
	}
	
}
