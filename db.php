<?
// db.php je samostatný soubor. Stačí změna zde a reference na tento soubor u ostatních .php, a vše je pak konzistentní a stejné. 


// Přihlašovací údaje k databázi z docker-compose.yml
$host = 'db';
$dbname = 'moje_databaze';
$user = 'student';
$pass = 'heslo';

// Try zkusí příkaz uvnitř, pokud se nepovede, tak vrátí chybu
try {
    // Vytvoření objektu PDO pro komunikaci s DB
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    // Nastavení vyhazování chyb (pomůže při debugování)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Nepodařilo se připojit k databázi: " . $e->getMessage());
}
