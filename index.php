<?php
session_start(); // Spustí se session (aby si stránka pamatovala, kdo jsme, a šlo přihlašování atd.).
require 'db.php';  // Načte naši databázi.  Dám formulář na insert 

// NAČTENÍ JSON SOUBORU
$json_data = file_get_contents('config.json'); // Přečte soubor
$config = json_decode($json_data, true);       // Přemění JSON na PHP pole

$zprava = ""; // Inicializace + zpráva vždy existuje, jen je defaultně prázdná.

// Zapnout: docker compose up -d, Vypnout: docker compose down -v      pak jen localhost:8080. 


// Když klikneme na tlačítko, pošle se metoda, která zkontroluje naše zadané údaje oproti těm v databázi.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jmeno = trim($_POST['uzivatel']); // trim se zbaví mezer za textem a $_POST vytáhne text, který uživatel napsal do políčka.
    $heslo = trim($_POST['heslo']);

    $sql = "SELECT * FROM uzivatele WHERE jmeno = :jmeno AND heslo = :heslo"; // Vytvoříme příkaz do kterého pak přidáme hodnoty 
    $stmt = $pdo->prepare($sql);  // pdo definované v db.php, chrání proti SQL injection tím, že vloží text do databáze pomocí bindParam jako čistý text.
    $stmt->bindParam(':jmeno', $jmeno); 
    $stmt->bindParam(':heslo', $heslo);
    $stmt->execute(); // Příkaz se spustí.

    // fetch zkusí vzít výsledek. Jestli správně, tak pustí na barvy.php, jestli ne, tak zpráva.
    if ($stmt->fetch()) {
        $_SESSION['prihlasen'] = true;
        header("Location: barvy.php");
        exit;
    } else {
        $zprava = "Špatné přihlašovací údaje.";
    }
}
?>
<!DOCTYPE html>   <html lang="cs">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení</title>
    <link rel="stylesheet" href="style.css"> </head>
<body>
                 <!-- htmlspecialchars prevence Cross site scripting (XSS) útokům -->
    <nav> <strong><?php echo htmlspecialchars($config['web_nazev']); ?></strong>
    </nav>

<div class="box">       
        <h1>Vstup</h1> 
        <form method="POST">
            <p>Jméno: <input type="text" name="uzivatel" required></p> 
            <p>Heslo: <input type="password" name="heslo" required></p>
            <button type="submit">Vstoupit</button> 
        </form>
        <p class="chyba"><strong><?php echo htmlspecialchars($zprava); ?></strong></p>
    </div> </body>
</html>
