<?php
session_start(); 
if (!isset($_SESSION['prihlasen']) || $_SESSION['prihlasen'] !== true) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Můj Projekt - Barvy</title>
    <link rel="stylesheet" href="style.css"> <script src="main.js"></script> </head>
<body>
<nav>
    <strong>NASTAVENÍ BAREV</strong> | 
    <a href="zadani_dat.php">Zadat data</a> | 
    <a href="vypis_dat.php">Výpis dat</a> | 
    <a href="logout.php" class="logout-link">ODHLÁSIT SE</a>
</nav>

    <div class="box">
        <h1>Nastavení barev</h1>
        <p>Vítejte!</p>
        <p>Změň barvu pozadí pomocí tlačítek:</p>
        
        <button onclick="zmenBarvu('green')">Zelená</button>
        <button onclick="zmenBarvu('blue')">Modrá</button>
        <button onclick="zmenBarvu('pink')">Růžová</button>
        <button onclick="zmenBarvu('white')">Reset</button>

        <hr>
        
        <p>Nebo napiš vlastní barvu (např. red, gold, #eee, nebo rgb(0,0,0)):</p>
        <input type="text" id="vlastniBarva" placeholder="Napiš barvu...">
        <button onclick="nastavVlastni()">Použít barvu</button>
    </div>
</body>
</html>