<?
session_start(); // Najdi tu naši session pokud už je zaplá 
session_unset();    // Vymaž data ze session
session_destroy();  // Znič celou session 
header("Location: index.php"); // Pošli zpět na login
exit; // Ukonči skript a dál nic nečti kdybych tam něco přidala + mezery a cokoliv za tímto kódem nic nedělá