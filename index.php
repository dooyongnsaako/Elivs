<?php
    require_once("connectivity.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>makeMeElvis.com</title>
    <link rel="stylesheet" href="css/styles.css">
    <style>
        .box {
            color: #333;
            padding: 15px ;
            font-size: 1rem;
            border-radius: 1rem;
            width:400px;
            position:relative;
            margin-bottom:20px;
        }
        .danger {
            background-color: #b92d2d;
            
        }
        .alert {
            background-color: #52a755;
        }

        .exit {
            position:absolute;
            top:10px;
            right:10px;
            font-size:1.5rem;
            font-weight:bold;
            display:block;
            cursor:pointer;
        }
        .text {
            display:block;
            margin-bottom:5px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen,
    Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  font-size: 1rem;
  color:#fff;
        }
    </style>
</head>
<body>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="sendmail.html">Send Mail</a></li>
        <li><a href="deleteEmail.php">Delete Member</a></li>
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
        echo '<div class="box danger">';
        echo '<span class="text">You forgot to fill in the all fields</span>';
        echo '</div>';
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
        $dbc = mysqli_connect(Host, Username, pwd, Database) or die("Cant connect to database");
    
        $query = " INSERT INTO email_list  VALUES (0, '$firstName','$lastName','$email') ";
    
        $result = mysqli_query($dbc, $query) or die("Cant insert to database");

        echo '<div class="box alert">';
        echo '<span class="exit">X</span>';
        echo '<span class="text">Full Name: ' . $firstName . '</span>';
        echo '<span class="text">Email: ' . $email . '</span>';
        echo '<span class="text">Successfully add: ' . $email . ' to the mailing list</span>';
        echo '</div>';

        $firstName = "";
        $lastName = "";
        $email = "";

        mysqli_close($dbc);
    
        $output_form = true;
    }
} else {
    $output_form = true;

    $firstName = "";
    $lastName = "";
    $email = "";
}

if($output_form) {
?>   
<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="form">
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
<script>
let alert = document.querySelector(".alert"),
    exit = document.querySelector(".exit");
    exit.addEventListener("click", function(e){
        alert.style.display="none";
    
});
</script>
</body>
</html>