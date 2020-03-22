		<?php
		   
		   $dbhost = "localhost";
		   $dbuser = "root";
		   $dbpass = "";
		   $dbname = "project";
		   
		   //Connect to MySQL Server
		   $link=mysqli_connect($dbhost, $dbuser, $dbpass,$dbname) or die('faild ot connect');
		  
		   
		   // Retrieve data from Query String
		   $age = $_GET['age'];
		   $sex = $_GET['sex'];
		   $wpm = $_GET['wpm'];
		   
		   // Escape User Input to help prevent SQL Injection
		   $age = mysqli_real_escape_string($link,$age);
		   $sex = mysqli_real_escape_string($link,$sex);
		   $wpm = mysqli_real_escape_string($link,$wpm);
		   
		   //build query
		   $query = "SELECT * FROM ajex_example WHERE sex = '$sex'";
		   
		   if(is_numeric($age))
		   $query .= " AND age <= $age";
		   
		   if(is_numeric($wpm))
		   $query .= " AND wpm <= $wpm";
		   
		   //Execute query
		   $qry_result = mysqli_query($link,$query) or die(mysqli_error($link));
		   
		   //Build Result String
		   $display_string = "<table class='table table-responsive table-striped table-hover table-bordered table-condensed text-center'>";
		   $display_string .= "<tr class='text-center'>";
		   $display_string .= "<th class='text-center'>Name</th>";
		   $display_string .= "<th class='text-center'>Age</th>";
		   $display_string .= "<th class='text-center'>Sex</th>";
		   $display_string .= "<th class='text-center'>WPM</th>";
		   $display_string .= "</tr>";
		   
		   // Insert a new row in the table for each person returned
		   while($row = mysqli_fetch_array($qry_result)) {
			  $display_string .= "<tr>";
			  $display_string .= "<td>$row[name]</td>";
			  $display_string .= "<td>$row[age]</td>";
			  $display_string .= "<td>$row[sex]</td>";
			  $display_string .= "<td>$row[wpm]</td>";
			  $display_string .= "</tr>";
		   }
		   echo "Query: your result is here <br />";
		   
		   $display_string .= "</table>";
		   echo $display_string;
		?>