<?php
include("../../Login/SessionManagement.php");
include("../../DB/connectdb.php");
include("../SupportFunctions.php");
ControlSession();
roleControl("Medico");

//_________________________________________________________________________________________________________
//(textcontent, link, id)
$navBarEntries = array(
    array("Immetti prescrizione", "#", "makePrescription"),
    array("Rimuovi prescrizione", "#", "removePrescription"),
    array("Aggiorna risultati", "inizialeMedico.php", "reload"),
    array('Cambia ruolo', '../../ChooseRole/ChooseRole.php', "changeRole"),
);
ob_start();
require '../NavBarGenerator';
$navBar = ob_get_clean();
//_________________________________________________________________________________________________________


//_________________________________________________________________________________________________________
$query = "select * from utente join ricetta r on (utente.Email = r.Utente) where Medico = '{$_SESSION[session_id()][0]}';";
                //"SQLAttribute"=>"NameColumn"
$columnNames = array("#"=>"#", "ID"=>"ID", "Data_emissione"=>"Data", "Dose_giornaliera"=>"Dose giornaliera (mg)",
    "Durata_terapia"=>"Durata terapia (giorni)", "Esenzione"=>"Esenzione", "Nome_principio"=>"Principio attivo",
    "Nome"=>"Nome paziente", "Cognome"=>"Cognome paziente", "Utente"=>"Email paziente");
$ID_Table = "tablePrescription";
ob_start();
require '../TableGenerator';
$tablePrescription = ob_get_clean();
//_________________________________________________________________________________________________________


?>
<!DOCTYPE html>

<html lang="it">

<head>
    <!-- Autore: Leonardo Magliolo
     Descrizione: La pagina implementa le funzioni del ruolo 'Medico'
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Medico</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../../../JS/Funzioni/Medico/inizialeMedico.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../CSS/Funzioni/Funzioni.css">

</head>

<body>
<?=$navBar ?>

<div class="informations">
    <img border="0" src="../../../IMGs/Medico.png" alt="Medico" width="100" height="100">
</div>

<div class="informations" id="prescriptions">
        <h3>Sono state effetuatte le seguenti prescrizioni:</h3>
    <?=$tablePrescription ?>
</div>

<div class="container" id="containerPrescription" >
    <button type="button" class="btn btn-light" id="closeButton" style="float: right;">X</button>
        <form id = "formPrescription">
            <h1>Inserisci i dati della prescrizione:</h1>
            <input type="number" name="Dose_giornaliera" placeholder="Dose giornaliera (mg)" required/>
            <input type="number" name="Durata_terapia" placeholder="Durata terapia (giorni)" required/>
            <p id="roleSelector">
                Esenzione:
                <input type="radio" name="Esenzione" value="1" checked="checked" id="radioChecked1">
                <label for="radioChecked1">Presente</label>
                <input type="radio" name="Esenzione" value="0" id="radioChecked0">
                <label for="radioChecked0">Assente</label>
            </p>
            <input type="text" name="Nome_principio" placeholder="Nome principio attivo" required/>
            <input type="email" name="Utente" placeholder="Email utente prescrizione" required/>
            <button type="submit" name="prescription" value="addPrescription">Immetti prescrizione</button>
            <p id="prescriptionErrorMessage"></p>
        </form>
</div>

<div class="container" id="containerRemovePrescription" >
    <button type="button" class="btn btn-light" id="closeButtonRemove" style="float: right;">X</button>
    <form id = "formRemovePrescription">
        <h1>Inserisci l'ID della prescrizione da rimuovere:</h1>
        <input type="number" name="ID" placeholder="ID presrizione" required/>
        <button type="submit" name="prescription" value="removePrescription">Rimuovi prescrizione</button>
        <p id="prescriptionRemoveErrorMessage"></p>
    </form>
</div>

</body>

</html>

