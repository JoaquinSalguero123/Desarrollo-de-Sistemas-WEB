<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM Clientes WHERE Email = ? AND Password = ?");
    $stmt->execute([$email, $password]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cliente) {
        $_SESSION['cliente'] = $cliente;
        header('Location: index.php');
        exit;
    } else {
        $error = "Email o contraseña incorrectos";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="styleLoging.css">
</head>
<body id='Tienda' >
    <div class="login-container">
        <h1>Bienvenido de nuevo</h1>
        <p id="currentDate"></p>
        <p>Los Dias Lunes, Miercoles y Viernes 15% de descuento</p>

        <form method="POST" action="login.php">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Iniciar sesión</button>
            <?php if (isset($error)): ?>
                <p class="error"><?php echo $error; ?></p>
            <?php endif; ?>
        </form>
    </div>

    <script src="DiaLogin.js"></script>

    <script>
        const images = [
            'Images/Tienda2.jpg',
            'Images/Tienda3.jpg',
            'Images/Tienda4.jpg',
            'Images/Tienda5.jpg'
        ];

       
        const randomIndex = Math.floor(Math.random() * images.length);

        const myDiv = document.getElementById('Tienda');

        
        myDiv.style.backgroundImage = `url(${images[randomIndex]})`;
    </script>
</body>
</html>