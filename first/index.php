<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
 var length;
  $('#wordAndNumber').blur(function() {
    let wordAndNumber = $('#wordAndNumber').val();
	let split = wordAndNumber.split(' ');
	if(split.length === 2){
	let word = split[0]; 
	length = split[1];
	var html="";
	for(let i =0; i< word;i++){
		html +='<div class="form-group"><input type="text" minlength="'+length+'" maxlength="'+length+'" placeholder="Enter Word" class="word form-control" name ="word[]" id="word'+i+'r" required></div>';
	}
	$('#div-wordAndNumber').after(html);
	}else{
		alert('Invalid Input');
		return false;
	}
	
  });
  
  $('#question').keyup(function() {
	  var qlength = $('#question').val();
	  var html="";
		for(let i =0; i< qlength;i++){
			html +='<div class="form-group"><input type="text" minlength="'+length+'" maxlength="'+length+'" placeholder="Enter question Word" class="question form-control" name ="question[]" id="question'+i+'r" required></div>';
		}
	  $('#div-question').after(html);
  });
 
});

</script>
</head>
	<body>
	<div class="container">
	<h2>First Answer:</h2>
	<form id="first_form" method="post" action="action.php">
	  <div class="form-group" id="div-wordAndNumber">
		<label for="wordAndNumber">Enter Numver of word And Length:</label>
		<input type="text" class="form-control" name ="wordAndNumber" id="wordAndNumber" required>
	  </div>
	  
	  <div class="form-group" id="div-question">
		<label for="question">Enter Numver of Question:</label>
		<input type="number" class="form-control" name ="question" id="question" required>
	  </div>
	 <div class="form-group">
		<input type="submit" value="Submit" />
	 </div>
	  </div>
	</form>
		
		</div>
	</body>
</html>