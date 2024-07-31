<?php
// Connexion à la base de données
$serveur = "localhost:3306"; // Adresse du serveur MySQL
$nom_utilisateur_db = "inovalwh_adminbd"; // Nom d'utilisateur de la base de données
$mot_de_passe_db = "gp!w{tG!2C1("; // Mot de passe de la base de données
$nom_base_de_donnees = "inovalwh_db_inovatec"; // Nom de la base de donnée

$connexion = new mysqli($serveur, $nom_utilisateur_db, $mot_de_passe_db, $nom_base_de_donnees);

if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
}

// Récupération des données depuis le formulaire
$observation = $_POST['observation'];
$measure = $_POST['measure'];
$roomNumber = intval($_POST['roomNumber']);

// Récupération du dernier numéro d'intervention
$sql = "SELECT MAX(numintervention) AS last_id FROM intervention";
$result = $connexion->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $lastId = $row['last_id'];
    $newId = $lastId ? $lastId + 1 : 1; // Incrémente le dernier ID ou commence à 1 si aucune intervention existante
} else {
    die("Error fetching last intervention ID: " . $connexion->error);
}

// Insertion de l'intervention avec le nouveau numéro
$sql = "INSERT INTO intervention (numintervention, observation, Mesure) VALUES (?, ?, ?)";
$stmt = $connexion->prepare($sql);
if (!$stmt) {
    die("Prepare failed: " . $connexion->error);
}
$stmt->bind_param("iss", $newId, $observation, $measure);
if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

// Vérifiez si l'insertion de l'intervention a réussi
if ($stmt->affected_rows > 0) {
    // Association de l'intervention avec la chambre
    $sql = "INSERT INTO effectuer (num_chambk, intervenantk) VALUES (?, ?)";
    $stmt = $connexion->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $connexion->error);
    }
    $stmt->bind_param("ii", $roomNumber, $newId);
    if (!$stmt->execute()) {
        die("Execute failed: " . $stmt->error);
    }

    if ($stmt->affected_rows > 0) {
       header("Location: index.php?status=success");
    } else {
        header("Location: index.php?status=adderror");
    }
} 


$stmt->close();
$connexion->close();
?>
