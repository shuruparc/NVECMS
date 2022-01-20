<?php include 'conn.php'; ?>
<option value="">Select Url </option>
		<?php  
		
					echo	 $sql="select `nve` FROM `resource_hub` where `rsubject`='".$_REQUEST['sub']."' && `rstage`='".$_REQUEST['st']."' && `rtitle`='".$_REQUEST['res']."'"; 
						 $result=$conn->query($sql) ;
						 while ($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
						 {
							?>
						
						<option name="l_url" id="l_url" value="<?php echo $row['nve']; ?>"><?php echo $row['nve']; ?> </option>
						<?php 
						 }
						 
						 ?>
                         

			 


