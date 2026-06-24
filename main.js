// Funkce zmenBarvu je pro tlačítka, kde je barva už definovaná.
function zmenBarvu(novaBarva) {
    // document.body je prvek <body>.
    // .style.backgroundColor mění CSS vlastnost přímo v prohlížeči.
    document.body.style.backgroundColor = novaBarva; // Nastavení barvy pozadí (background color).
}


// Funkce nastavVlastni je pro vlastní vstup do textového pole, aby se změnila barva podle toho, co zadáme.
function nastavVlastni() {
    // document.getElementById najde prvek podle jeho ID, kterou získá ze zadaného hex kódu či názvu barvy (např. Red).
    const vstup = document.getElementById('vlastniBarva'); // Najde input políčko a uloží ho do proměnné, aby z něj mohl vzít hodnotu (value).
    const barva = vstup.value; // Vezme text (název barvy nebo hex kód), který jsi napsala.
    
    document.body.style.backgroundColor = barva; // Nastavení barvy pozadí (background color).
}