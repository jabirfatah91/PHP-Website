<?php

include('class.phpmailer.php');



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['name'];

    $subjetc = $_POST['subject'];

    $comment = $_POST['comment'];

    $email = $_POST['mail'];

    if (!empty($name) && !empty($subjetc) && !empty($comment) && !empty($email)) {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // invalid e-mail address

            echo "invalid e-mail address";
            exit;
        } else {





            $to = "info@dhbangladesh.com";

            $mail = new PHPMailer();

            $mail->IsSMTP();  // telling the class to use SMTP

            $mail->SMTPAuth = true; // enable SMTP authentication

            $mail->SMTPSecure = "tls"; // sets the prefix to the servier

            $mail->Host = "dhbangladesh.com"; // SMTP server

            $mail->Port = 587; // set the SMTP port

            $mail->Username = "contactform@dhbangladesh.com";

            $mail->Password = "hnUJ7^ghuiK";



            $mail->From = $email;

            $mail->FromName = $name;

            $mail->AddAddress($to);

            $mail->IsHTML(true);



            $mail->Subject = $subjetc . '-DH Bangladesh contact form';

            $mail->Body = '<head><title>Contact Form of DH Bangladesh</title></head>

						<body>
							<p>Message: ' . "$comment" . '</p>

						</body>

				';



            if (!$mail->Send()) {

                echo 'Message was not sent.';

                echo 'Mailer error: ' . $mail->ErrorInfo;
            } else {

                echo 'Success';
            }
        }
    } else {

        echo "All fields are required";
    }
}

