<?php
$host = "localhost";
$database = "id583441_selfcare";
$user = "id583441_root";
$password = "password";

$connected = mysqli_connect($host, $user, $password, $database);

$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$phoneNumber = $_POST['phone'];

//$email = $_POST['email'];
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
     //for email validation (refer: http://us.php.net/manual/en/function.filter-var.php)
     $email = $_POST['email'];
}

$select_query = "select * from users where email like '$email';";
$select_result = mysqli_query($connected, $select_query);

if(mysqli_num_rows($select_result) > 0) {
    while($row = mysqli_fetch_assoc($select_result)) {
        if($email == $row['email']) {
            echo "Email already registered! Try again with different email ID!";
        }
    }
} else {
    if($password == $repassword) {
        $query = "insert into users VALUES ('$firstName', '$lastName', '$email', PASSWORD('$password'), '$phoneNumber');";

        $to = "$email";
        $subject = "Welcome to Cloud Selfcare System!";
        $txt = "Hello, $firstName! Greetings from the Cloud Selfcare System! Your account has been registered as a user in the CSC Club! Download the app from the link below." . "\r\n" . "https://github.com/Pancham97/Cloud-Selfcare-System" . "\r\n" . "Your details are as follows:" . "\r\n" . "Email: " . $email . "\r\n" . "Password: " . $password . "\r\n\r\n" . "Your registered phone number is: " . $phoneNumber . "\r\n" . "If you have not registered to CSC, kindly disregard this email.";
        $headers = "From: CSC" . "\r\n";

        mail($to,$subject,$txt,$headers);
        $result = mysqli_query($connected, $query); //Query for the resultant users table

        if($result) {
            echo "Registration successful!";
        } else {
            echo "Error in registration!";
        }
    } else {
        echo "Passwords do not match!";
    }
}

?>
