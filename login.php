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

        .password-container {
            position: relative;
            display: flex;
            align-items: center;
        }

        .password-container input {
            padding-right: 30px;
        }

        .password-container .toggle-password {
            position: absolute;
            right: 10px;
            cursor: pointer;
        }
    </style>
</head>

<body>
<div class="container">
    <h2 id="logoSection"><img src="src/log.png" width="70%" alt="Logo"></h2>
    <form id="checkForm" method="post" action="verify.php">
        <label style="text-align: left" for="roomNumber">Matricule:</label>
        <input type="number" id="roomNumber" name="roomNumber" required>
        <label style="text-align: left" for="password">Password:</label>
        <div class="password-container">
            <input type="password" id="password" name="password" required>
            <span class="toggle-password" onclick="togglePasswordVisibility()">
                <i class="fas fa-eye"></i>
            </span>
        </div>
        <button type="submit">Se connecter</button>
        <h4><?php
            if (isset($_GET['status'])) {
                $status = $_GET['status'];
                switch ($status) {
                    case "nook":
                        echo "Mot de passe ou Matricule incorrecte ";
                        break;
                }
            }
            ?></h4>
    </form>
</div>

<script>
    function togglePasswordVisibility() {
        const passwordInput = document.getElementById('password');
        const toggleIcon = document.querySelector('.toggle-password i');

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            toggleIcon.classList.remove('fa-eye');
            toggleIcon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            toggleIcon.classList.remove('fa-eye-slash');
            toggleIcon.classList.add('fa-eye');
        }
    }
</script>


</body>

</html>
