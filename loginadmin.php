<?php
// Connexion à la base de données
$host = "localhost";
$username = "root";
$password = "Parking852!";
$dbname = "parking";
$conn = mysqli_connect($host, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Récupération des données de formulaire
$username = $_POST['username'];
$password = $_POST['password'];

// Préparation de la requête SQL
$sql = "SELECT * FROM adminaccount WHERE username='$username' AND password='$password'";

// Exécution de la requête SQL
$result = mysqli_query($conn, $sql);

// Vérification du résultat de la requête
if (mysqli_num_rows($result) > 0) {
    //echo "Identification réussi";
    $_SESSION['username'] = $username;


    header("Location: /dashboardadmin.php");
} 
else {
    // Identification échouée
    echo "Veuillez vous identifier avec les bons identifiants";
}


?>