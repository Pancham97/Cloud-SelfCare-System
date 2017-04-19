<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Welcome to the Cloud Selfcare System!</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="css/universal.css">
    <link rel="stylesheet" href="css/signup.css">



    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <head>
        <title>Login to CSC</title>
        <script>
        function validate(userForm) {
            var div = document.getElementById("fname");
            div.style.color="red";
            if(div.hasChildNodes()) {
                div.removeChild(div.firstChild);
            }
            if(userForm.firstName.value == 0) {
                div.appendChild(document.createTextNode("First Name cannot be blank!"));
                userForm.firstName.focus();
                return false;
            }

            var div = document.getElementById("lname");
            div.style.color="red";
            if(div.hasChildNodes()) {
                div.removeChild(div.firstChild);
            }
            if(userForm.lastName.value == 0) {
                div.appendChild(document.createTextNode("Last Name cannot be blank!"));
                userForm.lastName.focus();
                return false;
            }

            div=document.getElementById("emailmsg");
            div.style.color="red";
            if(div.hasChildNodes()) {
                div.removeChild(div.firstChild);
            }
            regex=/(^\w+\@\w+\.\w+)/;
            match=regex.exec(userForm.email.value);
            if(!match) {
                div.appendChild(document.createTextNode("Invalid Email!"));
                userForm.email.focus();
                return false;
            }

            div=document.getElementById("passwdmsg");
            div.style.color="red";
            if(div.hasChildNodes()) {
                div.removeChild(div.firstChild);
            }
            if(userForm.password.value.length <= 5) {
                div.appendChild(document.createTextNode("The password should be at least 6 characters long!"));
                userForm.password.focus();
                return false;
            }

            div=document.getElementById("repasswdmsg");
            div.style.color="red";
            if(div.hasChildNodes()) {
                div.removeChild(div.firstChild);
            }
            if(userForm.password.value != userForm.repassword.value) {
                div.appendChild(document.createTextNode("Passwords do not match!"));
                userForm.password.focus();
                return false;
            } return true;
        }

        </script>
    </head>
    <body>

        <?php
          include 'navbar.php';
        ?>

        <div class="row signup">
            <div class="container">
                <div class="col-md-4"></div>
                <div class="col-md-4 form">
                    <h2>Sign Up to CSC!</h2><br>
                    <form action="register.php" method="post" onsubmit="return validate(this);">
                        <label for="firstName" class="sr-only">First Name</label>
                        <input class="form-control" placeholder="First Name" type="text" name="firstName"><span id="fname"></span>

                        <br>

                        <label for="lastName" class="sr-only">Last Name</label>
                        <input class="form-control" placeholder="Last Name" type="text" name="lastName"><span id="lname"></span>

                        <br>

                        <label for="email" class="sr-only">Email address</label>
                        <input class="form-control" placeholder="Email address" type="text" name="email"><span id="emailmsg"></span>

                        <br>

                        <label for="password" class="sr-only">Password</label>
                        <input class="form-control" placeholder="Password" type="password" name="password"><span id="passwdmsg"></span>

                        <br>

                        <label for="repassword" class="sr-only">Re-enter password</label>
                        <input class="form-control" placeholder="Retype Password" type="password" name="repassword"><span id="repasswdmsg"></span>

                        <br>

                        <label for="phone" class="sr-only">Phone Number</label>
                        <input class="form-control" placeholder="Phone Number" type="text" name="phone">

                        <br>

                        <!--
                        <div class="checkbox">
                        <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>
            -->

            <button class="btn btn-primary" type="submit">Sign Up</button>
            <button class="btn btn-primary" type="reset">Reset</button>
        </form>
    </div>
</div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<!-- <script src="js/checkform.js" type="text/javascript"></script> -->

</body>
</html>
