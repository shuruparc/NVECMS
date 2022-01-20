<?php include 'conn.php'; ?>
<option value="">Select Subject </option>
		<?php  
		
						 $sql="select DISTINCT `rsubject` FROM `resource_hub` where `rstage`='".$_REQUEST['cls']. "'"; 
						 $result=$conn->query($sql) ;
						 while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
						 {
							?>
						
						<option name="l_subject" id="l_subject" value="<?php echo $row['rsubject']; ?>"><?php echo $row['rsubject']; ?> </option>
					
						<?php 
						 }
						 ?>

			 


