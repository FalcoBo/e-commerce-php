<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="login.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <br>
        <input type="submit" name="submit" value="Log in">
    </form>

    <form action="main.php" method="post">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
        <br>
        <label for="first_name">First name:</label>
        <input type="text" name="username" id="first_name">
        <br>
        <label for="last_name">Last name:</label>
        <input type="text" name="username" id="last_name">
        <br>
        <label for="email">Email:</label>
        <input type="text" name="username" id="email">
        <br>

<?php
/*
// Vérification d'email
  if (isset($_POST['email'])) {
    $email = $_POST['email'];
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "L'adresse email est valide.";
    } else {
      echo "L'adresse email n'est pas valide.";
    }
  }
  */
?>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <br>
        <input type="submit" name="submit" value="Register">
    </form>

<?php
    //Paramètres de connexions en local
    $host = "localhost";  
    $username = "root";
    $password = "";
    $dbname = "ecommerce";

    // Connection à la database e-commerce
    $db = mysqli_connect($host, $username, $password, $dbname);

    // Si on arrrive pas à se connecter à la base de données on affiche une erreur
    if (!$db) {
        die("Erreur de connexion :" . mysqli_connect_error());
    }

        // Vérification de l'existence de l'utilisateur dans la base de données
        if (isset($_POST['submit'])) {
            $username = mysqli_real_escape_string($db, $_POST['username']);
            $password = mysqli_real_escape_string($db, $_POST['password']);
            $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
            $last_name = mysqli_real_escape_string($db, $_POST['last_name']);
            $email = mysqli_real_escape_string($db, $_POST['email']);
            
            // Requête d'insertion
            $add_querry = "INSERT INTO user (username, password, first_name, last_name, email) VALUES ('username', 'password', 'first_name', 'last_name', 'email')";
            $result = mysqli_query($db, $add_query);
        
            //Si la requête trouve une ligne alors l'utilisateur est trouvé
            if (mysqli_num_rows($result) == 1) {
                session_start();
                $_SESSION['user_id'] = $row['id'];
        
                // Redirection à la page home.php
                header('Location: http://localhost/e-commerce/home.php');
                exit;
            } else {
                // Le username et le mot de passe n'ont pas été trouvé dans la base de données
                $error = 'Incorrect username or password';
                }
            }
    
  // Ferme la connexion à la base de données
  mysqli_close($db);
?>
</body>
</html>


