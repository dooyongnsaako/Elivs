<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
$email = $_POST["email"];

$dbc = mysqli_connect("localhost", "root", "", "makemeelvis") or die("Cant connect to database");

$query = " DELETE FROM email_list WHERE email = '$email'" ;

$result = mysqli_query($dbc, $query) or die("Cant insert to database");
mysqli_close($dbc);
echo "Successfully removed " . $email . " from the mailing list";

?>
</body>
</html>