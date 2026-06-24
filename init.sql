CREATE TABLE IF NOT EXISTS uzivatele (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jmeno VARCHAR(50),
    heslo VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS tabulka (
    id INT AUTO_INCREMENT PRIMARY KEY,
    jmeno VARCHAR(100) NOT NULL,
    text_dat TEXT NOT NULL
);

INSERT INTO uzivatele (jmeno, heslo) 
VALUES ('admin', '12345'), ('student', 'ujep');

INSERT INTO tabulka (jmeno, text_dat) VALUES 
('Pondělí', 'Uvařit na týden'),
('Úterý', 'Učit se'),
('Středa', 'Uklízet'),
('Čtvrtek', 'Uvařit na týden'),
('Pátek', 'Učit se'),
('Sobota', 'Uklízet'),
('Neděle', 'Odpočívat a učit se');