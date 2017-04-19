<?php
$host = "localhost";
$database = "id583441_selfcare";
$user = "id583441_root";
$password = "password";

//Connection to the database on the 000WebHost
$connected = mysqli_connect($host, $user, $password, $database);

// Variables for various form fields
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$phoneNumber = $_POST['phone'];

// Consider the email only if the email meets the basic validation criteria like x@y.z
if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
     //for email validation (refer: http://us.php.net/manual/en/function.filter-var.php)
     $email = $_POST['email'];
}

// Query to check if the email already exists in the database
$select_query = "select * from users where email like '$email';";
// Executing the query
$select_result = mysqli_query($connected, $select_query);

// If the query is executed without errors
if(mysqli_num_rows($select_result) > 0) {
    // Fetching the data of the table in the form of variable $row
    while($row = mysqli_fetch_assoc($select_result)) {
        // If the email already exists in the database
        if($email == $row['email']) {
            echo "Email already registered! Try again with different email ID!";
        }
    }
} else {
    // Validation of password
    if($password == $repassword) {
        // Inserting the form data into the table
        $query = "insert into users VALUES ('$firstName', '$lastName', '$email', PASSWORD('$password'), '$phoneNumber');";

        // Basic query to send a welcome mail to the recipient.
        $to = "$email";
        $subject = "Welcome to Cloud Selfcare System!";
        $txt = "Hello, $firstName! Greetings from the Cloud Selfcare System! Your account has been registered as a user in the CSC Club! Download the app from the link below." . "\r\n\n\n" . "https://github.com/Pancham97/Cloud-SelfCare-System/blob/master/Android/CSC/app/app-release.apk?raw=true" . "\r\n" . "Your details are as follows:" . "\r\n" . "Email: " . $email . "\r\n" . "Password: " . $password . "\r\n\r\n" . "Your registered phone number is: " . $phoneNumber . "\r\n\n\n" . "If you have not registered to CSC, kindly disregard this email.";
        $headers = "From: CSC" . "\r\n";

        mail($to,$subject,$txt,$headers);
        $result = mysqli_query($connected, $query); //Query for the resultant users table

        // Check if the query to insert the data into the database is successful or not.
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
