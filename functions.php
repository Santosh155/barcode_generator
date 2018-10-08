	
<?php
 
 include('config.php');
 if(isset($_POST["Import"])){
		
		$filename=$_FILES["file"]["tmp_name"];		
 
 
		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, ",")) !== FALSE)
	         {
 
 
	           $sql = "INSERT into daily_product (product_id,product_category,product_name,product_price) 
                   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."')";
                   $result = mysqli_query($con, $sql);
				if(!isset($result))
				{
					echo "<script>
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"index.php\"
						  </script>";		
				}
				else {
					  echo "<script>
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php\"
					</script>";
				}
	         }
			
	         fclose($file);	
		 }
	}	 
	function get_all_records(){
		$con = getdb();
		$Sql = "SELECT * FROM daily_product";
		$result = mysqli_query($con, $Sql);  
	
	
		if (mysqli_num_rows($result) > 0) {
		echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
				<thead><tr><th>EMP ID</th>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
							</tr></thead><tbody>";
	
	
		while($row = mysqli_fetch_assoc($result)) {
	
			echo "<tr><td>" . $row['product_id']."</td>
					<td>" . $row['product_category']."</td>
					<td>" . $row['product_name']."</td>
					<td>" . $row['product_price']."</td>
					</tr>";        
		}
		
		echo "</tbody></table></div>";
		
	} else {
		echo "you have no records";
	}
	}
	
?>