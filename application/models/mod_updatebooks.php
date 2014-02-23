<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mod_updatebooks extends CI_Model {

    function outstocks($currentBooks, $allYearBooks, $booksArray)
    {
		
		foreach ($allYearBooks as $value)
		{
			$BooksInd = $value->is_books_ind;
			$BooksStocksIn = $value->is_books_instocks;
			$BooksStocksOut = $value->is_books_outstocks;
		
			$check1 = 0;
			foreach ($booksArray as $value2)
			{
				if ($value->is_books_ind == $value2)
				{
					$check1 = 1;
				}
			}
			if ($check1 == 1)
			{
				$check2 = 0;
				foreach ($currentBooks as $value3)
				{
					if ($value->is_books_ind == $value3)
					{
						$check2 = 1;
					}
				}
				if ($check2 == 0)
				{
					if ($BooksStocksIn <= 1)
					{
						$stocksOutTotal = 0;
					}
					else
					{
						$stocksInTotal = $BooksStocksIn - 1;
					}
					$this->db->query("UPDATE ispbt_books SET is_books_instocks = '$stocksInTotal' WHERE is_books_ind = '$BooksInd'");
					$stocksOutTotal = $BooksStocksOut + 1;
					$this->db->query("UPDATE ispbt_books SET is_books_outstocks = '$stocksOutTotal' WHERE is_books_ind = '$BooksInd'");
				}
			}
			else
			{
				$check3 = 0;
				foreach ($currentBooks as $value3)
				{
					if ($value->is_books_ind == $value3)
					{
						$check3 = 1;
					}
				}
				if ($check3 == 1)
				{
					if ($BooksStocksIn <= 1)
					{
						$stocksTotal = 0;
					}
					else
					{
						$stocksTotal = $BooksStocksIn + 1;
						$this->db->query("UPDATE ispbt_books SET is_books_instocks = '$stocksTotal' WHERE is_books_ind = '$BooksInd'");
					
						if ($BooksStocksOut <= 1)
						{
							$stocksOutTotal = 0;
						}
						else
						{
							$stocksOutTotal = $BooksStocksOut - 1;
						}
					$this->db->query("UPDATE ispbt_books SET is_books_outstocks = '$stocksOutTotal' WHERE is_books_ind = '$BooksInd'");
					}
				}					
			}
		}	
    }
    
    function instocks($currentBooks, $allYearBooks, $booksArray)
    {
    	foreach ($allYearBooks as $value)
		{
			$BooksInd = $value->is_books_ind;
			$BooksStocksIn = $value->is_books_instocks;
			$BooksStocksOut = $value->is_books_outstocks;
			
			$check1 = 0;
			foreach ($booksArray as $value2)
			{
				if ($value->is_books_ind == $value2)
				{
					$check1 = 1;
				}
			}
			if ($check1 == 1)
			{
				$check2 = 0;
				foreach ($currentBooks as $value3)
				{
					if ($value->is_books_ind == $value3)
					{
						$check2 = 1;
					}
				}
				if ($check2 == 0)
				{
					$stocksTotal = $BooksStocksIn + 1;
						$this->db->query("UPDATE ispbt_books SET is_books_instocks = '$stocksTotal' WHERE is_books_ind = '$BooksInd'");
						$stocksOutTotal = $BooksStocksOut - 1;
					$this->db->query("UPDATE ispbt_books SET is_books_outstocks = '$stocksOutTotal' WHERE is_books_ind = '$BooksInd'");
				}
			}
			else
			{
				$check3 = 0;
				foreach ($currentBooks as $value3)
				{
					if ($value->is_books_ind == $value3)
					{
						$check3 = 1;
					}
				}
				if ($check3 == 1)
				{
					if ($BooksStocksIn <= 1)
					{
						$stocksTotal = 0;
					}
					else
					{
						$stocksInTotal = $BooksStocksIn - 1;
						$this->db->query("UPDATE ispbt_books SET is_books_instocks = '$stocksInTotal' WHERE is_books_ind = '$BooksInd'");
						$stocksOutTotal = $BooksStocksOut + 1;
						$this->db->query("UPDATE ispbt_books SET is_books_outstocks = '$stocksOutTotal' WHERE is_books_ind = '$BooksInd'");
					}
				}		
			}
		}
    }
}
