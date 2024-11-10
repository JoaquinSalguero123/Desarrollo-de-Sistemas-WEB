<?php
function getProducts($conn) {
    $stmt = $conn->prepare("SELECT ID, Nombre, Talla, Precio, IMAGEN FROM Productos");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProductById($conn, $id) {
    $stmt = $conn->prepare("SELECT ID, Nombre, Talla, Precio, IMAGEN FROM Productos WHERE ID = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getProductsByTalla($conn, $talla) {
    if ($talla) {
        $stmt = $conn->prepare("SELECT ID, Nombre, Talla, Precio, IMAGEN FROM Productos WHERE Talla = ?");
        $stmt->execute([$talla]);
    } else {
        $stmt = $conn->prepare("SELECT ID, Nombre, Talla, Precio, IMAGEN FROM Productos");
        $stmt->execute();
    }
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

