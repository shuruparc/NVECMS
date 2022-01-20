<?php include 'conn.php'; ?>
<option value="">Select Resource </option>
		<?php  
		
						 $sql="select `rtitle` FROM `resource_hub` where `rstage`='".$_REQUEST['st']."' && `rsubject`='".$_REQUEST['sub']."'";
						 $result=$conn->query($sql) ;
						 while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
						 {
							?>
						
						<option name="l_resources" id="l_resources" value="<?php echo $row['rtitle']; ?>"><?php echo $row['rtitle']; ?> </option>
					
						<?php 
						 }
						 
						 ?>
                       
                         

			 


