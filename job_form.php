<!DOCTYPE html>
<html>
<head>
	<title>PHP Job Form</title>
</head>
<body>
<?php
	// readfile('navigation.tmpl.html');

	$firstname = '';
	$lastname = '';
	$email = '';
	$phone_number = '';
	$message = '';
	$cv_upload = '';




	//validation

	if(isset($_POST['submit'])) { // out put all the data if the user clicks on submit
		$ok = true;
		
		if(!isset($_POST['firstname']) || $_POST['firstname'] === '') {
			$ok = false;
		} else {
			$firstname = $_POST['firstname'];
		}

		if(!isset($_POST['lastname']) || $_POST['lastname'] === '') {
			$ok = false;
		} else {
			$lastname = $_POST['lastname'];
		}


		if(!isset($_POST['email']) || $_POST['email'] === '') {
			$ok = false;
		}   else {
			$email = $_POST['email'];
		}

		if(!isset($_POST['phone_number']) || $_POST['phone_number'] === '') {
			$ok = false;
		}   else {
			$phone_number = $_POST['phone_number'];
		}

		if(!isset($_POST['message']) || $_POST['message'] === '') {
			$ok = false;
		}   else {
			$message = $_POST['message'];
		}


		if($ok) {
			// $hash = password_hash($password, PASSWORD_DEFAULT); // password api

			// add database code here
			$db = mysqli_connect('localhost', 'root', '', 'job_form'); //connect to the database
			$sql = sprintf("INSERT INTO form (firstname, lastname,  email,  phone_number, message) VALUES (
				'%s','%s','%s','%s', '%s'
				)", mysqli_real_escape_string($db, $firstname),
					mysqli_real_escape_string($db, $lastname),
					mysqli_real_escape_string($db, $email),
					mysqli_real_escape_string($db, $phone_number),
					mysqli_real_escape_string($db, $message));
			mysqli_query($db, $sql); // send to database
			mysqli_close($db); //close session to free resources
			echo '<p>Success! Your details was successfully added! Thank you for sending your details.</p>';

		}
	}
?>



	<form method="post" action="">
	First Name:<br><input type="text" name="firstname" value="<?php
		echo htmlspecialchars($firstname); // prefilled the form fields
	?>"><br><br>

	Last Name:<br><input type="text" name="lastname" value="<?php
		echo htmlspecialchars($lastname); // prefilled the form fields
	?>"><br><br>

	Email:<br><input type="text" name="email" value="<?php
		echo htmlspecialchars($email); // prefilled the form fields
	?>"><br><br>

	Phone Number:<br><input type="text" name="phone_number" value="<?php
		echo htmlspecialchars($phone_number); // prefilled the form fields
	?>"><br><br>

	Message: <br><textarea name="message" rows="5" cols="40" "<?php
		echo htmlspecialchars($message); // prefilled the form fields
	?>"></textarea>
	<br><br>

	<!-- Password: <input type="password" name="password"><br> --> <!-- should not prefill the password -->

	

	<input type="submit" name="submit" value="Submit">
</form>
</body>
</html>