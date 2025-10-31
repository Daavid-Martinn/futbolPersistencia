<?php
session_start();

// Si el usuario ya consultó los partidos de un equipo
if (isset($_SESSION['equipo_actual'])) {
    $idEquipo = $_SESSION['equipo_actual'];
    header("Location: ./app/partidosEquipo.php?id=$idEquipo");
    exit;
}

// Si no hay sesión activa, va a la página de equipos
header("Location: ./app/equipos.php");
exit;
?>
