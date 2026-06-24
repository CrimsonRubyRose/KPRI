<?php
session_start();
require 'db.php';

// Ochrana - stejná jako v zadání dat
if (!isset($_SESSION['prihlasen'])) { header("Location: index.php"); exit; }

// Logika pro smazání (zkrácená verze)
if (isset($_GET['smazat'])) {
    $pdo->prepare("DELETE FROM tabulka WHERE id = :id")->execute(['id' => $_GET['smazat']]);
    header("Location: vypis_dat.php");
    exit;
}

// Vyhledávání - tady nově používám ?? (pokud GET neexistuje, dej druhou hodnotu, neboli prázdno)
$sj = $_GET['sj'] ?? '';
$so = $_GET['so'] ?? '';

// Zde mám nově LIKE, což vyhledá i částečnou shodu
$stmt = $pdo->prepare("SELECT * FROM tabulka WHERE jmeno LIKE :sj AND text_dat LIKE :so ORDER BY id DESC");
$stmt->execute(['sj' => "%$sj%", 'so' => "%$so%"]);
$vysledky = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Výpis</title>
</head>
<body>
    <nav>
        <a href="barvy.php">Barvy</a> | <a href="zadani_dat.php">Zadat</a> | <strong>VÝPIS</strong> | <a href="logout.php" class="logout-link">ODHLÁSIT</a>
    </nav>

    <div class="box box-siroky">
        <h1>Uložená data</h1>
        
        <form method="GET">
            <input type="text" name="sj" placeholder="Jméno" value="<?php echo $sj; ?>">
            <input type="text" name="so" placeholder="Obsah" value="<?php echo $so; ?>">
            <button type="submit">Hledat</button>
        </form>

        <table>
            <tr>
                <th>Jméno</th>
                <th>Text</th>
                <th>Smazat</th>
            </tr>
            <?php foreach ($vysledky as $r): ?>
            <tr> <!--  htmlspecialchars by mělo chránit před XSS (cross site scripting) útokem ?> -->
                <td><?php echo htmlspecialchars($r['jmeno']); ?></td>
                <td><?php echo htmlspecialchars($r['text_dat']); ?></td>
                <td>
                    <a href="?smazat=<?php echo $r['id']; ?>" class="delete-link">X</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>