<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(document).ready(function() {

  $('#testCase').keyup(function() {
    let testCase = $('#testCase').val();
	var html="";
	for(let i =0; i< testCase;i++){
		html +='<div class="row">'+
                '<div class="col"><input type="text" class="form-control" name="data['+i+'][]" placeholder="String 1" required></div>'+
                '<div class="col"><input type="text" class="form-control" name="data['+i+'][]" placeholder="String 2" required></div>'+
                '<div class="col"><select class="form-control" name="data['+i+'][]" required><option>Y</option><option>N</option></select></div>'+
                '<div class="col"><input type="number" class="form-control" name="data['+i+'][]" placeholder="String 2" required></div>'+
            '</div>';
	}
	$('#div-wordAndNumber').after(html);
	
  });
  

 
});

</script>
</head>
	<body>
	<div class="container">
	<h2>Second Answer:</h2>
	<form id="first_form" method="post" action="action.php">
	  <div class="form-group" id="div-wordAndNumber">
		<label for="testCase">Enter Number of test case:</label>
		<input type="number" class="form-control" name ="testCase" id="testCase" required>
	  </div>
            
            
            
            
            
           
            
            
            <div class="clearfix"></div>
	  
	 <div class="form-group">
		<input type="submit" value="Submit" />
	 </div>
	  </div>
	</form>
		
		</div>
	</body>
</html>