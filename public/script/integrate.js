const navLinks = document.querySelectorAll('nav a.nav-link');

// Ajouter un écouteur d'événement 'click' à chaque lien



const data = [
    { date: '2024-01-01', chambre: 'Chambre 601', mesure: '123', observation: 'Aucune anomalie' },
    { date: '2024-01-02', chambre: 'Chambre 602', mesure: '456', observation: 'Remplacer l\'ampoule' },
    { date: '2024-01-02', chambre: 'Chambre 605', mesure: '456', observation: 'Nettoyer les filtres' },
    { date: '2024-01-02', chambre: 'Chambre 606', mesure: '456', observation: 'Vérifier les prises électriques' },
    { date: '2024-01-02', chambre: 'Chambre 608', mesure: '456', observation: 'Réparer la serrure' },
    { date: '2024-01-02', chambre: 'Chambre 606', mesure: '456', observation: 'Vérifier les fenêtres' },
    { date: '2024-01-02', chambre: 'Chambre 615', mesure: '456', observation: 'Tester la climatisation' },
    { date: '2024-01-02', chambre: 'Chambre 610', mesure: '456', observation: 'Nettoyer les tapis' },
    { date: '2024-01-02', chambre: 'Chambre 609', mesure: '456', observation: 'Réparer les rideaux' },
    { date: '2024-01-02', chambre: 'Chambre 616', mesure: '456', observation: 'Vérifier les systèmes d\'alarme' },
    { date: '2024-01-02', chambre: 'Chambre 618', mesure: '456', observation: 'Remplacer les ampoules défectueuses' },
    { date: '2024-01-02', chambre: 'Chambre 617', mesure: '456', observation: 'Vérifier les niveaux de chauffage' },
];

let currentPage = 1;
const rowsPerPage = 10;

function displayTable() {
    const tableBody = document.querySelector('#maintenanceTable tbody');
    tableBody.innerHTML = '';

    const start = (currentPage - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const pageData = data.slice(start, end);

    pageData.forEach(row => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
                        <td>${row.date}</td>
                        <td>${row.chambre}</td>
                        <td>${row.mesure}</td>
                        <td>${row.observation}</td>
                    `;
        tableBody.appendChild(tr);
    });

    updatePagination();
}

function updatePagination() {
    const pageNumbers = document.getElementById('pageNumbers');
    pageNumbers.innerHTML = '';

    const totalPages = Math.ceil(data.length / rowsPerPage);
    for (let i = 1; i <= totalPages; i++) {
        const button = document.createElement('button');
        button.textContent = i;
        button.classList.add(i === currentPage ? 'active' : '');
        button.onclick = () => {
            currentPage = i;
            displayTable();
        };
        pageNumbers.appendChild(button);
    }

    document.getElementById('prevBtn').classList.toggle('disabled', currentPage === 1);
    document.getElementById('nextBtn').classList.toggle('disabled', currentPage === totalPages);
}

function changePage(step) {
    const totalPages = Math.ceil(data.length / rowsPerPage);
    currentPage = Math.max(1, Math.min(currentPage + step, totalPages));
    displayTable();
}

function filterTable() {
    const input = document.getElementById('searchInput').value.toUpperCase();
    const rows = document.querySelectorAll('#maintenanceTable tbody tr');

    rows.forEach(row => {
        const cells = row.getElementsByTagName('td');
        let visible = false;
        for (let i = 0; i < cells.length; i++) {
            if (cells[i].textContent.toUpperCase().indexOf(input) > -1) {
                visible = true;
                break;
            }
        }
        row.style.display = visible ? '' : 'none';
    });
}

// Initial display
displayTable();