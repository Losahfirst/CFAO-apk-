<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance 2 2024</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="src/cfao-infrastructure-800x450-1.png" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('src/oli.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            box-sizing: border-box;
        }

        @media (max-width: 768px) {
            body {
                background-image: url('src/1.jpg');
            }
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .overlay img {
            max-width: 70%;
            max-height: 70%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 id="logoSection"><img src="src/bedroom1.png" width="100%" alt="Logo"></h2>
        <form id="checkForm" method="post" action="verify.php">
            <label for="roomNumber">Numéro de chambre:</label>
            <input type="number" id="roomNumber" name="roomNumber" required>
            <button type="submit">Vérifier</button>
            
        </form>
        <div id="result"></div>
        <div id="addInterventionSection" style="display: none;">
            <h3><img src="src/image-removebg-preview (12).png" width="50%"> </h3>
            <h3>Intervenir</h3>
            <form id="addInterventionForm" method="post" action="add_intervention.php">
                <label for="roomNumber">Numéro de chambre:</label>
                <input type="number" id="roomNumber" name="roomNumber" required>
                <label for="observation">Observation:</label>
                <textarea id="observation" name="observation" rows="4" required></textarea>
                <label for="measure">Mesure:</label>
                <input type="text" id="measure" name="measure" required>
                <button type="submit">Enregistrer</button>
                <button type="button" id="backButton" onclick="showCheckForm()">Retour</button>
            </form>
        </div>
        <div id="overlay" class="overlay">
            <img id="statusImage" src="" alt="Status">
        </div>
    </div>
    <script>
        function showAddInterventionForm() {
            document.getElementById('checkForm').style.display = 'none';
            document.getElementById('logoSection').style.display = 'none';
            document.getElementById('addInterventionSection').style.display = 'block';
        }

        function showCheckForm() {
            document.getElementById('checkForm').style.display = 'block';
            document.getElementById('logoSection').style.display = 'block';
            document.getElementById('addInterventionSection').style.display = 'none';
        }

        function showOverlay(imageSrc) {
            var overlay = document.getElementById('overlay');
            var statusImage = document.getElementById('statusImage');
            statusImage.src = imageSrc;
            overlay.style.display = 'flex';
        }

        document.getElementById('overlay').addEventListener('click', function() {
    var statusImageSrc = document.getElementById('statusImage').src;
    
    // Vérifie si l'image affichée est 'ok.png'
    if (statusImageSrc.includes('niok.png')) {
        // Affiche le formulaire d'intervention si l'image est 'ok.png'
        showAddInterventionForm();
    }
    
    // Cache l'overlay après le clic
    this.style.display = 'none';
});


        <?php
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    switch ($status) {
        case "ok":
            echo "showOverlay('src/niok.png', 'Intervention ajoutée avec succès!');";
            break;
        case "notok":
            echo "showOverlay('src/ok.png', 'Aucune intervention trouvée.');";
            break;
        case "adderror":
            echo "showOverlay('src/adderror.png', 'Erreur lors de l\'ajout de l\'intervention.');";
            break;
        case "assocerror":
            echo "showOverlay('src/assocerror.png', 'Erreur lors de l\'association de l\'intervention avec la chambre.');";
            break;
        case "success":
            echo "showOverlay('src/success.png', 'Opération réussie!');";
            break;
        case "erroroom":
            echo "showOverlay('src/erroroom.png', 'La chambre avec le numéro $roomNumber n\'existe pas.');";
            break;
        default:
            echo "showOverlay('src/default.png', 'Erreur inconnue.');";
            break;
    }
}
?>

    </script>
</body>
</html>
