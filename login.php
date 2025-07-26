<?php
// login.php

// Datos simulados de usuario
$usuario_valido = "tics@itess.edu.mx";
$contrasena_valida = "TImatricula";

// Obtener y limpiar datos del formulario
$usuario = trim($_POST['username'] ?? '');
$contrasena = trim($_POST['password'] ?? '');

// Validar
if ($usuario === $usuario_valido && $contrasena === $contrasena_valida) {
    // Redirigir a la página de inicio simulada
    header("Location: home.php");
    exit();
} else {
    echo "<script>alert('Usuario o contraseña incorrectos'); window.location.href='index.php';</script>";
}
?>
