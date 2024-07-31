<?php
// Connexion à la base de données
$serveur = "localhost:3306";
$nom_utilisateur_db = "inovalwh_adminbd";
$mot_de_passe_db = "gp!w{tG!2C1(";
$nom_base_de_donnees = "inovalwh_db_inovatec";

$connexion = new mysqli($serveur, $nom_utilisateur_db, $mot_de_passe_db, $nom_base_de_donnees);

if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
}

// Récupération des données depuis le formulaire
$roomNumber = intval($_POST['roomNumber']);

// Vérification des interventions pour la chambre
$sql = "SELECT i.numintervention, i.observation, i.Mesure 
        FROM intervention i 
        JOIN effectuer e ON i.numintervention = e.intervenantk 
        WHERE e.num_chambk = ?";
$stmt = $connexion->prepare($sql);
$stmt->bind_param("i", $roomNumber);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Intervention trouvée
    header("Location: index.php?status=notok&room=$roomNumber");
} else {
    // Aucune intervention trouvée
     header("Location: index.php?status=ok&room=$roomNumber");
    
}

$stmt->close();
$connexion->close();
?>
