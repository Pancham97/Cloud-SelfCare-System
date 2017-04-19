<?php
session_start();
$host = "localhost";
$database = "id583441_selfcare";
$user = "id583441_root";
$password = "password";

$connected = mysqli_connect($host, $user, $password, $database) or die(mysql_error());


$email = $_POST['email'];
$password = $_POST['password'];

// $name_query = "select parentName from userInfo ;";
$sql_query = "select * from users where email like '$email' and password like (PASSWORD('" . $password . "'));";
$email_query = "select * from users where email like '$email';";

// $name_result = mysqli_query($connected, $name_query);
$mysqli_result = mysqli_query($connected, $sql_query);
$email_result = mysqli_query($connected, $email_query);

// while ($rows = mysqli_fetch_assoc($name_result)) {
//     foreach ($rows as $key => $value) {
//         $$key = $value;
//     }
// }

$row_cnt = mysqli_num_rows($mysqli_result);
$email_row_cnt = mysqli_num_rows($email_result);

if($email_row_cnt == 0) {
    echo "No user registered with this email ID! Try Again!";
} else {
    if($row_cnt == 0) {
        echo "Email or password incorrect!";
    } else {
        //$row = mysqli_fetch_assoc($mysqli_result);
        while($row = mysqli_fetch_array($mysqli_result)) {
            $_SESSION['email'] = $row['email'];
            //      echo $_SESSION['email'];
            if($row['email'] == "talktopancham@gmail.com") {
                echo "Hello doctor!";
            } else {
                $query = "select * from users where email like '$email'";

                $result = mysqli_query($connected, $query);
                $response = array();

                while($row = mysqli_fetch_array($result, MYSQLI_BOTH)) {
                    array_push($response, array("firstName"=>$row[0], "lastName"=>$row[1], "email"=>$row[2], "phone"=>$row[4]));
                    echo json_encode(array("users"=>$response));
                }
            }
        }
    }
}
?>
