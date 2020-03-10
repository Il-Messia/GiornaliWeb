--Accounts:       Passwords:
--lettore                     
--admin           adminDeLeo_290801
--scrittore       scrittoreDeLeo_290801
--validatore      validatoreDeLeo_290801


--Comands:
--admin: 
GRANT USAGE ON *.* TO 'admin'@'localhost' IDENTIFIED BY PASSWORD '*59D5607105A3B0D0B270578D23222B9B24065B95';
GRANT ALL PRIVILEGES ON `giornali_de_leo`.* TO 'admin'@'localhost' WITH GRANT OPTION;
--lettore:
GRANT USAGE ON *.* TO 'lettore'@'localhost';
GRANT SELECT ON `giornali_de_leo`.`categorie` TO 'lettore'@'localhost';
GRANT SELECT ON `giornali_de_leo`.`studenti` TO 'lettore'@'localhost';
GRANT SELECT ON `giornali_de_leo`.`ha` TO 'lettore'@'localhost';
GRANT SELECT ON `giornali_de_leo`.`ca` TO 'lettore'@'localhost';
GRANT SELECT ON `giornali_de_leo`.`hotwords` TO 'lettore'@'localhost';
GRANT SELECT ON `giornali_de_leo`.`articolo` TO 'lettore'@'localhost';
GRANT SELECT (Studente, IdAccount, Username, PassWord) ON `giornali_de_leo`.`account` TO 'lettore'@'localhost';
--scrittore:
GRANT USAGE ON *.* TO 'scrittore'@'localhost' IDENTIFIED BY PASSWORD '*A5117F40676A60CE06213601FC02C603040BBFCC';
GRANT SELECT ON `giornali_de_leo`.`account` TO 'scrittore'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON `giornali_de_leo`.`ca` TO 'scrittore'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON `giornali_de_leo`.`ha` TO 'scrittore'@'localhost';
GRANT SELECT, INSERT, UPDATE, DELETE ON `giornali_de_leo`.`categorie` TO 'scrittore'@'localhost';
GRANT SELECT, INSERT (DataInizioVis, IdArticolo, Titolo, Abstract, DataFineVis, Testo, Autore), UPDATE (DataInizioVis, IdArticolo, Titolo, Abstract, DataFineVis, Testo, Autore), ALTER ON `giornali_de_leo`.`articolo` TO 'scrittore'@'localhost';
GRANT SELECT, INSERT, DELETE ON `giornali_de_leo`.`hotwords` TO 'scrittore'@'localhost';
--validatore
GRANT USAGE ON *.* TO 'validatore'@'localhost' IDENTIFIED BY PASSWORD '*5889705D6166831BF2D612080C1285C219A88379';
GRANT SELECT ON `giornali_de_leo`.`studenti` TO 'validatore'@'localhost';
GRANT SELECT (IdAccount, Studente, Username) ON `giornali_de_leo`.`account` TO 'validatore'@'localhost';
GRANT SELECT, INSERT (Visionatore), UPDATE (Visionatore), DELETE ON `giornali_de_leo`.`articolo` TO 'validatore'@'localhost';