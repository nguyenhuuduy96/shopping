<!DOCTYPE html>
<html>
<head>
	<title>tets</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
	<form action="{{route('cart.add')}}" method="post">
		@csrf
		<input type="text" name="middle_id" placeholder="id"><br>
		<input type="text" name="color" placeholder="color"><br>
		<input type="text" name="size" placeholder="size"><br>
		<input type="number" name="price" placeholder="price"><br>
		<input type="text" name="name" placeholder="name"><br>
		<input type="text" name="image" placeholder="image"><br>
		<input type="submit" value="submit">
		
	</form>
	<form action="javascript:void(0)" id="submit">
		<div class="test">
			<input type="text" name="name" class="name" value="2">
			<p style="color: red" class="error"></p>
		</div>
		<div class="test">
			<input type="text" name="name" class="name" value="4">
			<p style="color: red" class="error"></p>
		</div>
		<div class="test">
			<input type="text" name="name" class="name" value="8">
			<p style="color: red" class="error"></p>
		</div>
		<div class="test">
			<input type="text" name="name" class="name" value="10">
			<p style="color: red" class="error"></p>
		</div>
		<div class="test">
			<input type="text" name="name" class="name" value="2">
			<p style="color: red" class="error"></p>
		</div>
		<div id="demo">
			<input type="submit" value="submit" >
		</div>
		
	</form>
</body>
<script type="text/javascript">
	
	let submit = document.getElementById('submit');
	let test = document.getElementsByClassName('test');
	let errors = document.getElementsByClassName('error');
	
	submit.addEventListener('submit', function(e) {
		let nameArray = document.getElementsByClassName('name');
		for (var i = 0; i < nameArray.length; i++) {
			if (nameArray[i].value==2) {
				errors[i].innerHTML='errors';
				// console.log(test)
				// $('.test')[i].append('<p>nội dung thêm vào</p>');
				// $('#demo').append('<p>nội dung thêm vào</p>')
			}else{
				// errors[i].style.display="none";
				errors[i].innerHTML='';
			}
		
		}
		// console.log(nameArray)

	});
	

</script>
</html>