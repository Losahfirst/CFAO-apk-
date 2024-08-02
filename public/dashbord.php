
<?php
/*session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// Récupérer le nom de l'utilisateur depuis la session
$name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Utilisateur';
*/?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Visualisation</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="style/body.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="icon" href="src/cfao-infrastructure-800x450-1.png" type="image/x-icon">
</head>

<body>

<div class="container">
    <nav style="background-color: white;color: #0056b3">
        <a href="dashbord.php" style="background-color: white"><img src="../src/cfao-infrastructure-800x450-1.png" width="90%"></a>
        <a href="#table" class="active"><span class="material-symbols-outlined"> table_chart_view </span> Tableau</a>
        <a href="#chart"><span class="material-symbols-outlined">monitoring</span> Graphiques</a>
        <a href="../index.php"><span class="material-symbols-outlined">edit_square</span> Saisir</a>
        <a href="#chart"><span class="material-symbols-outlined">event_available</span> Planning </a>

        <a href="../login.php"> <span class="material-symbols-outlined">logout</span></a>

    </nav>

    <main class="main-content">
        <section class="main-content">
            <div id="table" class="table-container">
                <p style="color: #0056b3;">welcome back,
                   <!-- --><?php /*echo htmlspecialchars($name); */?>
                    ! 👋🏽</p>
                <h2>Dashboard</h2>

                <!-- Barre de recherche -->




                <div class="printf">
                    <div class="search-bar">
                        <input type="text" id="searchInput" placeholder="Rechercher une chambre..." onkeyup="filterTable()">
                        <i class="fas fa-search"></i>
                    </div>

                    <div>
                        <button class="print-button" style="margin-bottom: 15px; font-size: 2em;" onclick="printTable()">
                            <i class="fas fa-print"></i>

                        </button>

                    </div>

                </div>
                <div class="tal">
                <table id="maintenanceTable" style="text-align: center">
                    <thead>
                    <tr>
                        <th>Date</th>
                        <th>#</th>
                        <th>Mesure</th>
                        <th>Observation</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="pagination">
                    <div class="page-numbers" id="pageNumbers"></div>
                    <div>
                        <button id="prevBtn" onclick="changePage(-1)">Précédent</button>
                        <button id="nextBtn" onclick="changePage(1)">Suivant</button>
                    </div>
                </div>
            </div>
            </div>
            <script src="script/integrate.js"></script>

            <div id="chart" class="chart-container">
                <h2 style="text-align: center">Statistiques</h2>
                <canvas id="myChart"></canvas>
            </div>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script/graph.js"></script>
    <script>
        function printTable() {
            const printWindow = window.open('', '', 'height=600,width=800');

            // Récupérer tous les tableaux de la page
            const tables = document.querySelectorAll('table');
            let tablesHtml = '';

            // Concaténer le HTML de chaque tableau
            tables.forEach(table => {
                tablesHtml += table.outerHTML + '<br><br>'; // Ajoute des sauts de ligne entre les tableaux
            });

            // Construire le contenu de la nouvelle fenêtre
            printWindow.document.write('<html><head>');
            printWindow.document.write('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">');
            printWindow.document.write('<style>');
            printWindow.document.write('table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }');
            printWindow.document.write('th, td { padding: 10px; text-align: left; border: 1px solid #ccc; }');
            printWindow.document.write('header { text-align: center; margin-bottom: 20px; }');
            printWindow.document.write('footer { text-align: center; margin-top: 20px; font-size: 12px; color: #555; }');
            printWindow.document.write('</style>');
            printWindow.document.write('</head><body>');

            // Logo et en-tête
            printWindow.document.write('<header>');
            printWindow.document.write('<p style="text-align: left"><img src="../src/cfao-infrastructure-800x450-1.png" width="150px" style="margin-bottom: 20px;"></p>');
            printWindow.document.write('<h2>Rapport de Maintenance</h2>');
            printWindow.document.write('</header>');

            // Contenu des tableaux
            printWindow.document.write(tablesHtml);

            // Pied de page
            printWindow.document.write('<footer>');
            printWindow.document.write('<p>Généré par Inovatec by CFAO | ' + new Date().toLocaleDateString() + '</p>');
            printWindow.document.write('</footer>');

            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.focus();
            printWindow.print();
        }

    </script>
    <script>
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Supprimer la classe 'active' de tous les liens
                navLinks.forEach(link => link.classList.remove('active'));

                // Ajouter la classe 'active' au lien cliqué
                this.classList.add('active');
            });
        });

    </script>

</div>

</body>

</html>
