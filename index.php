<?php
session_start();
require_once 'db.php';
require_once 'product_model.php';


$talla_filtrada = isset($_GET['talla']) ? $_GET['talla'] : '';
$products = getProductsByTalla($conn, $talla_filtrada);


$total = 0;
if (isset($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $total += $item['Precio'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <div class="logo">
        <img src="images\logo.png" alt="Logo Tienda">
    </div>
    <nav>
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Productos</a></li>
            <li><a href="#">Contacto</a></li>
        </ul>
    </nav>
    <div id="cart-icon">
        <img src="images\Carrito.png" alt="Carrito" id="cart-btn">
        <span id="cart-count"><?php echo count($_SESSION['cart'] ?? []); ?></span>
    </div>
</header>

<main>
    <aside>
        <h3>Filtros</h3>
        <form method="GET" action="index.php" id="filterForm">
            <button type="submit" name="talla" value="" class="filter-btn <?php echo $talla_filtrada == '' ? 'active' : ''; ?>">Todas</button>
            <button type="submit" name="talla" value="S" class="filter-btn <?php echo $talla_filtrada == 'S' ? 'active' : ''; ?>">S</button>
            <button type="submit" name="talla" value="M" class="filter-btn <?php echo $talla_filtrada == 'M' ? 'active' : ''; ?>">M</button>
            <button type="submit" name="talla" value="L" class="filter-btn <?php echo $talla_filtrada == 'L' ? 'active' : ''; ?>">L</button>
            <button type="submit" name="talla" value="XL" class="filter-btn <?php echo $talla_filtrada == 'XL' ? 'active' : ''; ?>">XL</button>
        </form>
        <p id="Descuento"></p>
    </aside>

    <section id="productList">
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <h2><?php echo $product['Nombre']; ?></h2>
                    <p>Talla: <?php echo $product['Talla']; ?></p>
                    <p>Precio: $<?php echo number_format($product['Precio'], 2); ?></p>
                    <img src="images/<?php echo $product['IMAGEN']; ?>" alt="<?php echo $product['Nombre']; ?>" class="product-img">
                    <form method="POST" action="cart.php">
                        <input type="hidden" name="product_id" value="<?php echo $product['ID']; ?>">
                        <button type="submit" name="add_to_cart">Agregar al carrito</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay productos disponibles para esta talla.</p>
        <?php endif; ?>
    </section>
</main>

<div id="cart-dropdown">
    <h2>Carrito</h2>
    <ul>
        <?php if (!empty($_SESSION['cart'])): ?>
            <?php foreach ($_SESSION['cart'] as $item): ?>
                <li><?php echo $item['Nombre']; ?> (Talla: <?php echo $item['Talla']; ?>) - $<?php echo number_format($item['Precio'], 2); ?></li>
            <?php endforeach; ?>
        <?php else: ?>
            <li>El carrito está vacío.</li>
        <?php endif; ?>
    </ul>
    <p>Total: $<?php echo number_format($total, 2); ?></p>
    <form method="POST" action="cart.php">
        <button type="submit" name="clear_cart">Vaciar Carrito</button>
    </form>
    <form method="POST" action="checkout.php">
        <button type="submit">Pagar</button>
    </form>
</div>

<script src="script.js"></script>
<script src="descuento.js"></script>

</body>
</html>
