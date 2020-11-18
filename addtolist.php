<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>makeMeElvis.com</title>
    <link rel="stylesheet" href="css/styles.css">
    
</head>
<body>
<nav>
    <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="sendmail.html">Send Mail</a></li>
        <li><a href="deleteEmail.html">Delete Member</a></li>
    </ul>
</nav>
<div class="wrapper">
<p>Enter your firstname, lastname and email to be addded to the makeMeElvis mailing list</p>
<?php

if(ISSET($_POST['submit'])) {
    $firstName = $_POST["firstname"];
    $lastName = $_POST["lastname"];
    $email = $_POST["email"];
    $output_form = false;

    if(empty($firstName ) && empty($lastName) && empty($$email)) {
        echo "You forgot to fill in the all fields";
        $output_form = true;
    } 
    if((!empty($firstName )) && (!empty($lastName)) && (empty($email))) {
        echo "You forgot to fill in the email";
        $output_form = true;
    } 
    
    if((!empty($firstName )) && (empty($lastName)) && (!empty($email))) {
        echo "You forgot to fill in the lastname";
        $output_form = true;
    } 
    
    if((empty($firstName )) && (!empty($lastName)) && (!empty($email))) {
        echo "You forgot to fill in the firstname";
        $output_form = true;
    }

    if((!empty($firstName )) && (empty($lastName)) && (empty($email))) {
        echo "You forgot to fill in the lastname and email";
        $output_form = true;
    }

    if((empty($firstName )) && (!empty($lastName)) && (empty($email))) {
        echo "You forgot to fill in the firstname and email";
        $output_form = true;
    }

    if((empty($firstName )) && (empty($lastName)) && (!empty($email))) {
        echo "You forgot to fill in the firstname and lastname";
        $output_form = true;
    }
    

    if(!(empty($firstName )) && (!empty($lastName)) && (!empty($email))) {
        $dbc = mysqli_connect("localhost", "root", "", "makemeelvis") or die("Cant connect to database");
    
        $query = " INSERT INTO email_list  VALUES (0, '$firstName','$lastName','$email') ";
    
        $result = mysqli_query($dbc, $query) or die("Cant insert to database");
        mysqli_close($dbc);
    
        echo $firstName . "<br>";
        echo $lastName . "<br>";
        echo $email . "<br>";
        echo "Successfully add " . $email . " to the mailing list" . "<br>";
    }
} else {
    $output_form = true;

    $firstName = "";
    $lastName = "";
    $email = "";
}

if($output_form) {
?>   
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="firstname">First Name</label>
    <input type="text" id="firstname" name="firstname" value="<?php echo $firstName; ?>"> <br>
    <label for="lastname">Last Name</label>
    <input type="text" id="lastname" name="lastname" value="<?php echo $lastName; ?>"> <br>
    <label for="email">Email Address</label>
    <input type="text" id="email" name="email" value="<?php echo $email; ?>"> <br>
    <input type="submit" name="submit">
</form>

<?php
}
?>

</div>


</body>
</html>

