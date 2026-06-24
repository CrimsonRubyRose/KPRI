<?php
session_start();
require 'db.php';
$zprava = "";

// Pokud nejsme přihlášeni, zpět na login
if (!isset($_SESSION['prihlasen'])) { header("Location: index.php"); exit; }

// V podstatě nic nového až na INSERT což vloží data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jmeno = trim($_POST['jmeno_dat']);
    $obsah = trim($_POST['obsah_dat']);

    $sql = "INSERT INTO tabulka (jmeno, text_dat) VALUES (:jmeno, :obsah)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['jmeno' => $jmeno, 'obsah' => $obsah]);
    $zprava = "Data uložena!";
}
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Zadání</title>
</head>
<body>
<nav>
    <a href="barvy.php">Nastavení barev</a> | 
    <strong>ZADAT DATA</strong> | 
    <a href="vypis_dat.php">Výpis dat</a> | 
    <a href="logout.php" class="logout-link">ODHLÁSIT SE</a>
</nav>

    <div class="box">
        <h1>Vložit záznam</h1>
        <form method="POST">
            <input type="text" name="jmeno_dat" placeholder="Jméno" maxlength="20" required>
            <textarea name="obsah_dat" placeholder="Text" maxlength="99" required></textarea>
            <button type="submit">Uložit</button>
        </form>
        <p><strong><?php echo $zprava; ?></strong></p>
    </div>
</body>
</html>