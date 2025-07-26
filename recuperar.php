<?php
// recuperar.php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'] ?? '';

    if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        // Simula envío de enlace
        echo "<script>
                alert('Se ha enviado un enlace de recuperación a $correo');
                window.location.href='index.php';
              </script>";
    } else {
        echo "<script>
                alert('Correo electrónico no válido');
                window.location.href='index.php';
              </script>";
    }
} else {
    header("Location: index.php");
    exit();
}
