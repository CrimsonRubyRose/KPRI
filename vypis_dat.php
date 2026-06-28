<?php
// session_start() inicializuje/obnoví relaci (session)
session_start();
require 'db.php';

// Kontrola, zda je uživatel přihlášený. Pokud v $_SESSION není klíč tak vrátí zpět na index.php
if (!isset($_SESSION['prihlasen']) || $_SESSION['prihlasen'] !== true) {
    header("Location: index.php");
    // ukončí skript
    exit;
}

// Logika pro smazání záznamu 
if (isset($_GET['smazat'])) {
    $stmt = $pdo->prepare("DELETE FROM tabulka WHERE id = :id");
    $stmt->bindParam(':id', $_GET['smazat']);
    $stmt->execute();
    
    header("Location: vypis_dat.php");
    // ukončí skript
    exit;
}

// Vyhledávání - tady nově používám ?? (pokud GET neexistuje, dej druhou hodnotu, neboli prázdno)
$sj = $_GET['sj'] ?? '';
$so = $_GET['so'] ?? '';

// Zde mám nově LIKE, což vyhledá i částečnou shodu
$stmt = $pdo->prepare("SELECT * FROM tabulka WHERE jmeno LIKE :sj AND text_dat LIKE :so ORDER BY id DESC");

// Vytvoření proměnných (%% znamená jakýkoliv znak proto jako like), protože bindParam potřebuje reálnou proměnnou
$like_sj = "%$sj%";
$like_so = "%$so%";

$stmt->bindParam(':sj', $like_sj);
$stmt->bindParam(':so', $like_so);

$stmt->execute();
$vysledky = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <link rel="stylesheet" href="style.css">
    <title>Výpis dat</title>
</head>
<body>

    <nav>
        <a href="barvy.php">Nastavení barev</a> | 
        <a href="zadani_dat.php">Zadat data</a> | 
        <strong>VÝPIS DAT</strong> |
        <a href="logout.php" class="logout-link">ODHLÁSIT SE</a>

    </nav>

    <div class="box box-siroky">
        <h1>Uložená data</h1>
        
        <form method="GET">
            <input type="text" name="sj" placeholder="Jméno" value="<?php echo htmlspecialchars($sj); ?>">
            <input type="text" name="so" placeholder="Obsah" value="<?php echo htmlspecialchars($so); ?>">
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
