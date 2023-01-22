<?php
// Connexion à la base de données
$host = "localhost";
$username = "root";
$password = "";
$dbname = "raspberrypi";
$conn = mysqli_connect($host, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Récupération des données de formulaire
$username = $_POST['username'];
$password = $_POST['password'];

// Préparation de la requête SQL
$sql = "SELECT * FROM connexion WHERE username='$username' AND password='$password'";

// Exécution de la requête SQL
$result = mysqli_query($conn, $sql);

// Vérification du résultat de la requête
if (mysqli_num_rows($result) > 0) {
    // Identification réussie
    echo "Identification réussie";
} else {
    // Identification échouée
    echo "Identification échouée";
}

// Fermeture de la connexion à la base de données
mysqli_close($conn);
?>