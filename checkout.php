<?php
session_start();

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    echo "No tienes artículos en el carrito.";
    echo "<a href='index.php'>Volver a la tienda</a>";
    exit;
}

$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['Precio'];
}

$pagoExitoso = true;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Pago</title>
    <link rel="stylesheet" href="styleComprobante.css">
</head>
<body>
    <div class="receipt-container">
        <?php if ($pagoExitoso): ?>
            <h1>Comprobante de Pago</h1>
            <p>Gracias por tu compra. A continuación se detalla tu pedido:</p>

            <table>
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Talla</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <tr>
                            <td><?php echo $item['Nombre']; ?></td>
                            <td><?php echo $item['Talla']; ?></td>
                            <td>$<?php echo number_format($item['Precio'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <p><strong>Total: $<?php echo number_format($total, 2); ?></strong></p>
            <p>¡Esperamos verte pronto!</p>
            <?php echo "<a href='index.php'>Volver a la tienda</a>"; ?>
        <?php else: ?>
            <p>Hubo un problema con tu pago. Por favor, intenta nuevamente.</p>
        <?php endif; ?>
    </div>
</body>
</html>

<?php
unset($_SESSION['cart']);

?>
