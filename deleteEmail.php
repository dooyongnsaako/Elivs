<?php
    require_once("connectivity.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/delete.css">
</head>
<body>
<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="sendmail.html">Send Mail</a></li>
        <li><a href="deleteEmail.php">Delete Member</a></li>
    </ul>
</nav>

<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<?php

$dbc = mysqli_connect(Host, Username, pwd, Database) or die("Cant connect to database");
if(ISSET($_POST['submit'])){
    $arrayData = $_POST['todelete'];
    foreach($arrayData as $customer){
        $query = "DELETE FROM email_list WHERE id = '$customer'";
        mysqli_query($dbc, $query ) or die("Cant connect to database");
    }

    echo 'customers removed <br>';
}

$query = "SELECT * FROM email_list" ;
$result = mysqli_query($dbc, $query) or die("Cant insert to database");

while($row = mysqli_fetch_array($result)) {

    echo "<input type='checkbox' name='todelete[]' id='delete' value='". $row["id"] ."' > ";
    echo "<span>" . $row["firstname"] . " | <span>";
    echo "<span>" . $row["lastname"] . " | <span>";
    echo "<span>" . $row["email"] . " <span>";
    echo "<br>";

}

mysqli_close($dbc);
?>
<input type="submit" name="submit" value="Remove">
</form>
</body>
</html>