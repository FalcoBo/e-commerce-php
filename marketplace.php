
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Home</title>
</head>
<body>
<?php
    require_once './include/header.php';
?>

<?php
//Paramètres de connexions en local à la base de données
$host = "localhost";  
$username = "root";
$password = "";
$dbname = "e_commerce";

$db = mysqli_connect('localhost', 'user', 'password', 'database');

$query = "SELECT * FROM product";
$result = mysqli_query($db, $query);

echo "<table>";
while($product = mysqli_fetch_assoc($result)) {
  echo "<tr>";
  echo "<td>" . $product['title'] . "</td>";
  echo "<td>" . $product['price'] . "</td>";
  echo "</tr>";
}
echo "</table>";

?>

<?php
    require_once './include/footer.php';
?>    
</body>
</html>
