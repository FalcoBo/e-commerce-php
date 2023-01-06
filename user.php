<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action="process_form.php" method="post">
  <label for="username">Username :</label><br>
  <input type="text" id="name" name="name"><br>
  <label for="email">Email :</label><br>
  <input type="text" id="email" name="email"><br>
  <input type="submit" value="Envoyer">
</form>


<?php
  //Paramètres de connexions en local à la base de données
  $host = "localhost";  
  $username = "root";
  $password = "";
  $dbname = "e_commerce";

  // Connection à la database e_commerce
  $db = mysqli_connect($host, $username, $password, $dbname);

  // Si on arrrive pas à se connecter à la base de données on affiche une erreur
  if (!$db) {
      die("Erreur de connexion :" . mysqli_connect_error());
  }

  // Récupère les valeurs des champs de formulaire
  $username = $_POST['username'];
  $email = $_POST['email'];

  // Crée une requête d'insertion
  $sql = "INSERT INTO user_admin (username, email) VALUES ('$username', '$email')";

  // Exécute la requête
  if (mysqli_query($db, $sql)) {
    // Si la requête a réussi, affiche un message de succès
    echo "Merci, votre message a été envoyé!";
  } else {
    // Si la requête a échoué, affiche un message d'erreur
    echo "Erreur : " . $sql . "<br>" . mysqli_error($db);
  }

  // Ferme la connexion à la base de données
  mysqli_close($db);
?>

</body>
</html>