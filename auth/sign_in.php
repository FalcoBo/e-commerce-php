<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>S'inscrire</title>
</head>
<body>
  <form action="" method="post">
    <label for="username">Username :</label><br>
      <input type="text" id="username"><br>

    <label for="first_name">Prénom :</label><br>
      <input type="text" id="first_name"><br>

    <label for="last_name">Nom :</label><br>
      <input type="text" id="last_name"><br>

    <label for="email">Email :</label><br>
      <input type="email" id="email"><br>

    <label for="password">Mot de passe :</label><br>
      <input type="password" id="password"><br>

    <label for="password_verif">Comfirmation Mot de passe :</label><br>
      <input type="password" id="password_verif"><br>

    <input type="submit" value="S'inscrire">
  </form>

  <input type="submit" value="Se connecter" href="auth/log_in.php" >

<?php
  // Vérifier si le formulaire a été soumis
  if (isset($_POST['username']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_verfi'])) {

    // Récupérer les valeurs des champs du formulaire
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_verif = $_POST['password_verif'];

    // Se connecter à la base de données
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "ecommerce";
    $db = mysqli_connect($host, $user, $pass, $dbname);

    // Vérifier la connexion
    if (!$db) {
      die("Connection failed: " . mysqli_connect_error());
    }

    //Requête d'envoye des données dans la base de données
    $query = "INSERT INTO user (user_photo_id, username, password, first_name, last_name, phone_number, email) VALUES ('','$username','$password','$first_name','$last_name','','$email')";

    // Requête de vérification d'email et de l'username s'il sont déjà utilisé 
    $email_check = "SELECT * FROM user WHERE email = '$email'";
    /*$username_check = "SELECT * FROM user WHERE name = '$username'";*/

    // Variables de vérification de données déjà utilisées dans la base de données
    $email_check_result = mysqli_query($db, $email_check);
    /*$username_check_result = mysqli_query($db, $username_check);*/

    if ($password_verif != $password) {
      echo 'Les mots de passe ne correspondent pas';
    }

    // Vérifiez si la requête a retourné au moins un résultat
    // Vérification d'email
    if (mysqli_num_rows($email_check_result) == 1) {
      // Vérifier si l'email n'est pas déjà utilisé
      echo 'Cette adresse email est déjà utilisée.';
    } else {
      if (isset($_POST['email'])) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo "L'adresse email est valide.";
          mysqli_query($db, $query);
          $request = mysqli_query($db, $query);
        if ($request) {
        // Redirection à la page home
        header('Location: http://localhost/e-commerce/home.php');
        exit;
        } else {
          echo "L'adresse email n'est pas valide.";
        }
      }
      } else {
        echo 'Le mot de passe n\'est pas le bon';
      }
    } 
    mysqli_close($db);
}
?>


</body>
</html>