<?
// db.php je samostatný soubor. Stačí změna zde a reference na tento soubor u ostatních .php, a vše je pak konzistentní a stejné. 


// Přihlašovací údaje k databázovému serveru v Dockeru
$host = 'db';              // Název databázové služby z docker-compose.yml
$dbname = 'moje_databaze'; // Název vytvořené databáze
$user = 'student';         // Hlavní uživatel databáze
$pass = 'heslo';           // Heslo k databázi

// Try zkusí spustit kód uvnitř (pokus o připojení). Pokud nastane chyba, předá ji bloku catch.
try {
    // Vytvoření objektu PDO pro komunikaci s databází (nastavení spojení a kódování češtiny utf8)
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);

    // Zapne automatické hlášení všech chyb z databáze (pro debugování/hledání chyb)
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} 
// Catch zachytí chybu (např. špatné heslo) a uloží ji do proměnné $e, aby skript nespadl
catch (PDOException $e) {
    // die ukončí se a vypíše srozumitelnou hlášku, proč připojení selhalo
    die("Nepodařilo se připojit k databázi: " . $e->getMessage());
}
