<?php
session_start();
$host = "localhost";
$database = "id583441_selfcare";
$user = "id583441_root";
$password = "password";

// Connection to the database
$connected = mysqli_connect($host, $user, $password, $database) or die(mysql_error());

// Taking values from the login form
$email = $_POST['email'];
$password = $_POST['password'];

// Query for verifying if the user is in the database
$sql_query = "select * from users where email like '$email' and password like (PASSWORD('" . $password . "'));";
$email_query = "select * from users where email like '$email';";


$mysqli_result = mysqli_query($connected, $sql_query);
$email_result = mysqli_query($connected, $email_query);

// Executing the query
$row_cnt = mysqli_num_rows($mysqli_result);
$email_row_cnt = mysqli_num_rows($email_result);

// If no email found in the database
if($email_row_cnt == 0) {
    echo "No user registered with this email ID! Try Again!";
} else {
    // If email found, but password not found
    if($row_cnt == 0) {
        echo "Email or password incorrect!";
    } else {
        // If everything is all right.
        while($row = mysqli_fetch_array($mysqli_result)) {
            // Session is added just for fun. // TODO: To be removed later
            $_SESSION['email'] = $row['email'];

            // Check if email belongs to a doctor.
            if($row['email'] == "talktopancham@gmail.com") {
                echo "Hello doctor!";
            } else {
                // If belongs to a normal user.
                $query = "select * from users where email like '$email'";
                $result = mysqli_query($connected, $query);
                $response = array();

                while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                    // JSON query to push the results in array.
                    array_push($response, array("firstName"=>$row[0], "lastName"=>$row[1], "email"=>$row[2], "phone"=>$row[4]));
                    echo json_encode(array("users"=>$response));
                }
            }
        }
    }
}
?>
