<?php
error_reporting(E_ALL ^ E_NOTICE);
	/*
		Place code to connect to your DB here.
	*/
	global $wpdb;   //Database connection wordpress//	// include your code to connect to DB.

	//$tbl_name1="tbl_sign";		//your table name
	// How many adjacent pagess should be shown on each side?
	$adjacents = 2;
	
	/* 
	   First get total number of rows in data table. 
	   If you have a WHERE clause in your query, make sure you mirror it here.
	*/
	$query = "SELECT DISTINCT  COUNT(Distinct subcategory_name ) as num FROM tbl_gallerysubcategory c inner join tbl_gallery_main gm on c.subcategory_id=gm.subcategory_id  where c.status='Y' and gm.status='Y' and c.category_id='18' ORDER BY c.ordering
";
	$total_pagess = mysql_fetch_array(mysql_query($query));
	$total_pagess = $total_pagess['num'];
	//print_r($total_pagess);
	
	/* Setup vars for query. */
	$targetpages = get_option('siteurl').'/smile-gallery/';
	//$targetpages = "upcoming-signings"; 	//your file name  (the name of this file)
	$limit = 10; 
	//$pages = $pages;								//how many items to show per pages
	$pages = $_GET['pages'];
	if($pages) 
		$start = ($pages - 1) * $limit; 			//first item to display on this pages
	else
		$start = 0;								//if no pages var is given, set start to 0
	
	/* Get data. */
	//$sql = "SELECT * FROM $tbl_name1 where status='Y'  order by ordering asc LIMIT $start, $limit";
 	//$result = mysql_query($sql);
	
	   $sql_cat = "SELECT DISTINCT subcategory_name,c.*  FROM tbl_gallerysubcategory c inner join tbl_gallery_main gm on c.subcategory_id=gm.subcategory_id  where c.status='Y' and gm.status='Y' and c.category_id='18' ORDER BY c.ordering asc LIMIT $start, $limit";
    $result_cat = mysql_query($sql_cat);
    $count_num_cat = mysql_num_rows($result_cat); 
	
	
	
	/* Setup pages vars for display. */
	if ($pages == 0) $pages = 1;					//if no pages var is given, default to 1.
	$prev = $pages - 1;							//previous pages is pages - 1
	$next = $pages + 1;							//next pages is pages + 1
	$lastpages = ceil($total_pagess/$limit);		//lastpages is = total pagess / items per pages, rounded up.
	$lpm1 = $lastpages - 1;						//last pages minus 1
	
	/* 
		Now we apply our rules and draw the pagination object. 
		We're actually saving the code to a variable in case we want to draw it more than once.
	*/
	$pagination = "";
	if($lastpages > 1)
	{	
		$pagination .= "<br clear='all'/><div class=\"paginationFaq\">";
		//previous button
		if ($pages > 1) 
			$pagination.= "<a href=\"$targetpages?pages=$prev\" class=\"pag-prev\">&laquo; Previous</a>";
			//$pagination.= "<a href=\"$targetpages/$prev/\">&laquo; Previous</a>";
		else
			$pagination.= "<span class=\"disabled disable-previous\"></span>";	
		
		//pagess	
		if ($lastpages < 7 + ($adjacents * 2))	//not enough pagess to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpages; $counter++)
			{
				if ($counter == $pages)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpages?pages=$counter\">$counter</a>";	
					//$pagination.= "<a href=\"$targetpages/$counter/\">$counter</a>";				
			}
		}
		elseif($lastpages > 5 + ($adjacents * 2))	//enough pagess to hide some
		{
			//close to beginning; only hide later pagess
			if($pages < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $pages)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpages?pages=$counter\">$counter</a>";
						//$pagination.= "<a href=\"$targetpages/$counter/\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpages?pages=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpages?pages=$lastpages\">$lastpages</a>";	
				
				//$pagination.= "<a href=\"$targetpages/$lpm1/\">$lpm1</a>";
				//$pagination.= "<a href=\"$targetpages/$lastpages/\">$lastpages</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpages - ($adjacents * 2) > $pages && $pages > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpages?pages=1\">1</a>";
				$pagination.= "<a href=\"$targetpages?pages=2\">2</a>";
				
				//$pagination.= "<a href=\"$targetpages/1/\">1</a>";
				//$pagination.= "<a href=\"$targetpages/2/\">2</a>";
				
				$pagination.= "...";
				for ($counter = $pages - $adjacents; $counter <= $pages + $adjacents; $counter++)
				{
					if ($counter == $pages)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpages?pages=$counter\">$counter</a>";	
						//$pagination.= "<a href=\"$targetpages/$counter/\">$counter</a>";						
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpages?pages=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpages?pages=$lastpages\">$lastpages</a>";	
				
				//$pagination.= "<a href=\"$targetpages/$lpm1/\">$lpm1</a>";
				//$pagination.= "<a href=\"$targetpages/$lastpages/\">$lastpages</a>";		
			}
			//close to end; only hide early pagess
			else
			{
				$pagination.= "<a href=\"$targetpages?pages=1\">1</a>";
				$pagination.= "<a href=\"$targetpages?pages=2\">2</a>";
				
				//$pagination.= "<a href=\"$targetpages/1/\">1</a>";
				//$pagination.= "<a href=\"$targetpages/2/\">2</a>";
				
				$pagination.= "...";
				for ($counter = $lastpages - (2 + ($adjacents * 2)); $counter <= $lastpages; $counter++)
				{
					if ($counter == $pages)

						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpages?pages=$counter\">$counter</a>";	
						//$pagination.= "<a href=\"$targetpages/$counter/\">$counter</a>";						
				}
			}
		}
		
		//next button
		if ($pages < $counter - 1) 
			$pagination.= "<a href=\"$targetpages?pages=$next\" class=\"pag-next\">Next &raquo;</a>";
			
			//$pagination.= "<a href=\"$targetpages/$next/\">Next &raquo;</a>";
		else
			$pagination.= "<span class=\"disabled disable-next\"></span>";
		$pagination.= "</div>\n";		
	}

?>
