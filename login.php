<?php
// Connexion à la base de données
$host = "localhost";
$username = "root";
$password = "Parking852!";
$dbname = "parking";
$conn = mysqli_connect($host, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
    die("Erreur de connexion à la base de données : " . mysqli_connect_error());
}

// Récupération des données de formulaire
$username = $_POST['username'];
$password = $_POST['password'];

echo "$password";
$password = hash('sha256', $password);
echo "$password";

// Préparation de la requête SQL pour la table "useraccount"
$user_sql = "SELECT * FROM useraccount WHERE username='$username' AND password='$password'";

// Exécution de la requête SQL pour la table "useraccount"
$user_result = mysqli_query($conn, $user_sql);

// Vérification du résultat de la requête pour la table "useraccount"
if (mysqli_num_rows($user_result) > 0) {
    //echo "Identification réussie pour l'utilisateur";
    $_SESSION['username'] = $username;
    $row = mysqli_fetch_assoc($user_result);
    $_SESSION['rfid'] = $row['RFID'];

    header("Location: /reservation.php");
} 

// Sinon, vérification de la table "adminaccount"
else {
    // Préparation de la requête SQL pour la table "adminaccount"
    $admin_sql = "SELECT * FROM adminaccount WHERE username='$username' AND password='$password'";

    // Exécution de la requête SQL pour la table "adminaccount"
    $admin_result = mysqli_query($conn, $admin_sql);

    // Vérification du résultat de la requête pour la table "adminaccount"
    if (mysqli_num_rows($admin_result) > 0) {
        //echo "Identification réussie pour l'administrateur";
        $_SESSION['username'] = $username;
        header("Location: /tableaudebord.php");
    } 
    else {
        // Identification échouée
        echo "Veuillez vous identifier avec les bons identifiants";
    }
}
?>
