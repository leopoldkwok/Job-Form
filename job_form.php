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


	$firstnameError ="";
	$lastnameError="";
	$emailError ="";
	$phone_numberError="";
	$messageError ="";
	// $fileError ="";
	$errors = 0;



	//validation

	//we first confirm whether the form has been submitted by checking if submit has been set. isset function in php checks if a variable is set and is not null.

	if(isset($_POST['submit'])) { // output all the data if the user clicks on submit. Checking null values in message and validates the form
		$ok = true;
		
		if(!isset($_POST['firstname']) || $_POST['firstname'] === '') {
			$ok = false;
			$firstnameError = "First Name is required";

		} elseif (!preg_match("/^[a-zA-Z]*$/",$_POST['firstname'])) {
			$ok = false;
			$firstnameError = "Only letters and white space not allowed";
		} else {
			$firstname = $_POST['firstname'];
		}

		if(!isset($_POST['lastname']) || $_POST['lastname'] === '') {
			$ok = false;
			$lastnameError="Last name is required";

		} elseif (!preg_match("/^[a-zA-Z]*$/",$_POST['lastname'])) {
			$ok = false;
			$lastnameError = "Only letters and white space not allowed";

		} else {
			$lastname = $_POST['lastname'];
		}


		if(!isset($_POST['email']) || $_POST['email'] === '') {
			$ok = false;
			$emailError = "Email is required";

		}   elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			$ok = false;
			$emailError = "Email is not valid";

		}	else {
			$email = $_POST['email'];
		}

		// if(!isset($_POST['phone_number']) || $_POST['phone_number'] === '') {
		// 	$ok = false;
		// }   else {
		// 	$phone_number = $_POST['phone_number'];
		// }

		// if(!isset($_POST['message']) || $_POST['message'] === '') {
		// 	$ok = false;
		// }   else {
		// 	$message = $_POST['message'];
		// }


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
	?>"><br>
	<div class="error"><?php echo $firstnameError;?></div><br>

	Last Name:<br><input type="text" name="lastname" value="<?php
		echo htmlspecialchars($lastname); // prefilled the form fields
	?>"><br>
	<div class="error"><?php echo $lastnameError;?></div><br>

	Email:<br><input type="text" name="email" value="<?php
		echo htmlspecialchars($email); // prefilled the form fields
	?>"><br>
	<div class="error"><?php echo $emailError;?></div><br>

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