<?php
error_reporting(E_ALL ^ E_NOTICE);
	/*
		Place code to connect to your DB here.
	*/
	global $wpdb;   //Database connection wordpress//	// include your code to connect to DB.

	//$tbl_name1="tbl_sign";		//your table name
	// How many adjacent pages should be shown on each side?
	$adjacents = 2;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT COUNT(*) as num FROM  tbl_testimonial where status='Y' ORDER BY ordering ";
	$total_pages = mysql_fetch_array(mysql_query($query));
	$total_pages = $total_pages['num'];
	//print_r($total_pages);
	
	/* Setup vars for query. */
	$targetpage = get_option('siteurl').'/testimonials';
	//$targetpage = "upcoming-signings"; 	//your file name  (the name of this file)
	$limit = 10; 
	$page = $page;								//how many items to show per page
	//$page = $_GET['page'];
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	//$sql = "SELECT * FROM $tbl_name1 where status='Y'  order by ordering asc LIMIT $start, $limit";
 	//$result = mysql_query($sql);
	
	$sql_testimonial = "select * from   tbl_testimonial where status='Y' ORDER BY ordering asc LIMIT $start, $limit";
    $result_testimonial = mysql_query($sql_testimonial);
    $count_num_test = mysql_num_rows($result_testimonial); 
	
	
	
	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"paginationFaq\">";
		//previous button
		if ($page > 1) 
			//$pagination.= "<a href=\"$targetpage?page=$prev\">&laquo; Previous</a>";
			$pagination.= "<a href=\"$targetpage/$prev/\">&laquo; Previous</a>";
		else
			$pagination.= "<span class=\"disabled\">&laquo; Previous</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					//$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";	
					$pagination.= "<a href=\"$targetpage/$counter/\">$counter</a>";				
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						//$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";
						$pagination.= "<a href=\"$targetpage/$counter/\">$counter</a>";					
				}
				$pagination.= "...";
				//$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				//$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";	
				
				$pagination.= "<a href=\"$targetpage/$lpm1/\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage/$lastpage/\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				//$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				//$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				
				$pagination.= "<a href=\"$targetpage/1/\">1</a>";
				$pagination.= "<a href=\"$targetpage/2/\">2</a>";
				
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						//$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";	
						$pagination.= "<a href=\"$targetpage/$counter/\">$counter</a>";						
				}
				$pagination.= "...";
				//$pagination.= "<a href=\"$targetpage?page=$lpm1\">$lpm1</a>";
				//$pagination.= "<a href=\"$targetpage?page=$lastpage\">$lastpage</a>";	
				
				$pagination.= "<a href=\"$targetpage/$lpm1/\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage/$lastpage/\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				//$pagination.= "<a href=\"$targetpage?page=1\">1</a>";
				//$pagination.= "<a href=\"$targetpage?page=2\">2</a>";
				
				$pagination.= "<a href=\"$targetpage/1/\">1</a>";
				$pagination.= "<a href=\"$targetpage/2/\">2</a>";
				
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)

						$pagination.= "<span class=\"current\">$counter</span>";
					else
						//$pagination.= "<a href=\"$targetpage?page=$counter\">$counter</a>";	
						$pagination.= "<a href=\"$targetpage/$counter/\">$counter</a>";						
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			//$pagination.= "<a href=\"$targetpage?page=$next\">Next &raquo;</a>";
			
			$pagination.= "<a href=\"$targetpage/$next/\">Next &raquo;</a>";
		else
			$pagination.= "<span class=\"disabled\">Next &raquo;</span>";
		$pagination.= "</div>\n";		
	}

?>
