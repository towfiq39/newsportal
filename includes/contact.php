<!-- <section class="container-fluid my-3">
	<h3 class="text-center">Contact Us</h3>
	<div class="row justify-content-center">
		<div class="col-lg-6">
			<form action="" method="POST">
				<div class="form-group">
					<label for="Name">Name</label>
					<input type="text" name="name" class="form-control" id="" placeholder="Enter Name">
				</div>
				<div class="form-group">
					<label for="Email">Email</label>
					<input type="email" name="email" class="form-control" id="" placeholder="Enter Email">
				</div>
				<div class="form-group">
					<label for="Subject">Subject</label>
					<input type="text" name="subject" class="form-control" id="" placeholder="Enter Subject">
				</div>
				<div class="form-group">
					<label for="Message">Message</label>
					<textarea id="" cols="30" rows="5" name="body" class="form-control "></textarea>
				</div>
				<input type="submit" value="Send Mail" class="btn btn-outline-primary btn-block">
			</form>
		</div>
	</div>
</section> -->
<!-- contact start -->
<?php
if (isset($_REQUEST['contact'])) {
	require 'smtp/PHPMailerAutoload.php';

	$name = $_REQUEST['name'];
	$email = $_REQUEST['email'];
	$subject = $_POST["subject"];
	$body = $_POST["mail_body"];

	$mail = new PHPMailer;
	//smtp settings
	$mail->isSMTP(); // send as HTML
	$mail->Host = "smtp.gmail.com"; // SMTP servers
	$mail->SMTPAuth = true; // turn on SMTP authentication
	$mail->Username = "imrosetowfik@gmail.com"; // Your mail
	$mail->Password = '458880741556'; // Your password mail
	$mail->Port = 587; //specify SMTP Port
	$mail->SMTPSecure = 'tls';
	$mail->setFrom($email);
	$mail->addAddress('imrosetowfik@gmail.com');
	$mail->addReplyTo($email);
	$mail->isHTML(true);
	$mail->Subject = 'Form Submission:' . $subject;
	$mail->Body = '<h3> Name: ' . $name . '<br>Email: ' . $email . '<br>Message: ' . $body . '</h3>';
	if (!$mail->send()) {
		echo "Something went worng. Please try again.";
	} else {
		echo "Thanks\t" . $_POST['name'] . " for contacting us.";
	}
}

?>
		<section class="contact container my-5 py-5" id="contact">
			<h2 class="text-center">Contact Us</h2>
			<div class="row">
				<div class="col-lg-8 col-md-7 col-sm-12 col-12">
					<form action="" method="POST">
						<div class="form-group">
							<label for="name">Name</label>
							<input type="text" name="name" class="form-control" placeholder="Enter Name">
						</div>
						<div class="form-group">
							<label for="Email">Email</label>
							<input type="email" name="email" class="form-control" placeholder="Enter Mail">
						</div>
						<div class="form-group">
							<label for="text">Subject</label>
							<input type="text" name="subject" class="form-control" placeholder="Enter Subject">
						</div>

						<div class="form-group">
			                <label for="exampleFormControlTextarea1">Your Opinion</label>
			                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="mail_body"></textarea>
		                </div>
              			<input type="submit"  class="btn btn-primary" name="contact" value="Send Mail">
					</form>
				</div>
				<div class="col-lg-4 col-md-5 col-sm-10 col-10 text-white text-center stripe mx-auto">
					<h4>Blogging</h4>
					<p>
						Hamirkutsha,Bagmara <br>
						Boalia,Rajshahi<br>
						phone:01311425570<br>
						www.webdevtowfiq.xyz
					</p>
				</div>
			</div>
		</section>
		<!-- contact end -->