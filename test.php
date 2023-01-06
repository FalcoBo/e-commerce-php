<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form method="post" action="">
  <label for="username">Username :</label><br>
  <input type="text" name="username"><br>
  <label for="email">Email :</label><br>
  <input type="text" name="email"><br><br>
  <input type="submit" value="Envoyer">
</form> 


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérez les données du formulaire ici
    $user_name = $_POST['username'];
    $email = $_POST['email'];

    // Paramètres de connexions à la base de données
    $host = "localhost";  
    $username = "root";
    $password = "";
    $dbname = "ecommerce";

    // Connectez-vous à la base de données
    $dbc = mysqli_connect($host, $username, $password, $dbname);

    // Requête d'envoye des données dans la base de données
    $query = "INSERT INTO test (name, email) VALUES ('$user_name','$email')";

    // Requête de vérification d'email et de l'username s'il sont déjà utilisé 
    $email_check = "SELECT * FROM test WHERE email = '$email'";
    $username_check = "SELECT * FROM test WHERE name = '$username'";

    // Variables de vérification de données déjà utilisées dans la base de données
    $email_check_result = mysqli_query($dbc, $email_check);
    $username_check_result = mysqli_query($dbc, $username_check);

    // Vérifiez si la requête a retourné au moins un résultat
    if (mysqli_num_rows($email_check_result) == 1) {
      // Vérifier si l'email n'est pas déjà utilisé
      echo 'Cette adresse email est déjà utilisée.';
    } else {
      // Exécutez la requête si les données ne sont pas utilisées
      // Vérification d'email
      if (isset($_POST['email'])) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo "L'adresse email est valide.";
          mysqli_query($dbc, $query);
          $request = mysqli_query($dbc, $query);
        if ($request) {
        // Redirection à la page home
        header('Location: http://localhost/e-commerce/home.php');
        exit;
      }
        } else {
          echo "L'adresse email n'est pas valide.";
        }
      }
    } 
    mysqli_close($dbc);
}
?>
</body>
</html>