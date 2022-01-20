<script type="text/javascript"> 
      $(document).ready( function() {       
		setTimeout('$("#alert_msg").hide()',3000);
				
			$("#add_new").click(function(){
				var empty='';
				$("#fname").val(empty);
        $("#lname").val(empty);
				$("#id").val(empty);
				$("#password").val(empty);
				$("#role").val(empty);	
				$("#school").val(empty);	
				$("#username").val(empty);		
				});
      });
function check(id){
try{
		$.ajax({
			
						type : "POST",
						url : "<?php echo ADMIN_URL; ?>ajax/editor_ajax.php",
						dataType : "json", 
						data : "id="+id,
						success : function(data) {						
							/*alert(data.flag);*/
							try{
								 $('#draggable').modal('show');
								 $("#id").val(data.id); 								
								 $("#fname").val(data.fname);
                 $("#lname").val(data.lname);		
								 $("#password").val(data.password);	
								 $("#role").val(data.role);	
								 $("#school").val(data.school);	
								 $("#username").val(data.username);				
								
							}
							catch(err){
								alert(err.message);
							}
						
						}
					});
				}catch(err){
					alert(err.message);
				}
setInterval(function(){
   $('#error_msg').html('');
  }, 5000);
 
}
	  
</script>