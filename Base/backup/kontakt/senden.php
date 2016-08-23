<?php
 
// ======= Konfiguration:
$absender = "{$_POST["Vorname"]} {$_POST["Nachname"]}";

$mailTo = 'kontakt@lausboehl.de';
$mailFrom = $absender . ' <' . $_POST["mail"] .'>';
$mailSubject    = $_POST["Betreff"];
$returnPage = 'http://lausboehl.de/test-mode/kontakt/erfolg.html';
$returnErrorPage = 'http://lausboehl.de/test-mode/kontakt/fehler.html';
$mailText = "";
 
// ======= Text der Mail aus den Formularfeldern erstellen:
 
// Wenn Daten mit method="post" versendet wurden:
if(isset($_POST)) { 
   // alle Formularfelder der Reihe nach durchgehen:
   
    $mailText = $_POST["Nachricht"] . "\n\n von: \n " . $_POST["Anrede"] . " " . $_POST["Vorname"] . " " . $_POST["Nachname"] . ", " . $_POST["Funktion"] . "\n E-mail: " . $_POST["mail"] . "\n Telefon: " . $_POST["Telefon"];
        
} // if
 
// ======= Korrekturen vor dem Mailversand 
 
// Wenn PHP "Magic Quotes" vor Apostrophzeichen einfügt:
 if(get_magic_quotes_gpc()) {
     // eventuell eingefügte Backslashes entfernen
     $mailtext = stripslashes($mailtext);
 }
 
// ======= Mailversand
 
// Mail versenden und Versanderfolg merken
$mailSent = @mail($mailTo, $mailSubject, $mailText, "From: ".$mailFrom);
 
// ======= Return-Seite an den Browser senden
 
// Wenn der Mailversand erfolgreich war:
if($mailSent == TRUE) {
   // Seite "Formular verarbeitet" senden:
   header("Location: " . $returnPage);
}
// Wenn die Mail nicht versendet werden konnte:
else {
   // Seite "Fehler aufgetreten" senden:
   header("Location: " . $returnErrorPage);
}
 
// ======= Ende
 
exit();
 
?>