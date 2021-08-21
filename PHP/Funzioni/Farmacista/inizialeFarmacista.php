<?php
include("../../Login/SessionManagement.php");
include("../../DB/connectdb.php");
include("../SupportFunctions.php");
ControlSession();
roleControl("Farmacista");

//_________________________________________________________________________________________________________
//(textcontent, link, id)
$navBarEntries = array(
    array("Immetti ordine", "#", "makeOrder"),
    array("Rimuovi ordine", "#", "removeOrder"),
    array("Aggiorna risultati", "inizialeFarmacista.php", "reload"),
    array('Cambia ruolo', '../../ChooseRole/ChooseRole.php', "changeRole"),
);
ob_start();
require '../NavBarGenerator';
$navBar = ob_get_clean();
//_________________________________________________________________________________________________________


//_________________________________________________________________________________________________________
$query = "select a.ID_ricetta, a.Numero_confezioni, a.Costo, a.Costo_paziente, a.Data_vendita, a.Nome_Farmaco,
          a.Produttore_farmaco, u.Nome, u.Cognome, u.Email from acquisto a join ricetta r on(a.ID_ricetta  = r.ID) join utente u on (r.Utente = u.Email)
          where Farmacista = '{$_SESSION[session_id()][0]}';";

                //"SQLAttribute"=>"NameColumn"
$columnNames = array("#"=>"#", "ID_ricetta"=>"ID ricetta", "Numero_confezioni"=>"Numero confezioni", "Costo"=>"Costo totale (€)",
    "Costo_paziente"=>"Costo paziente (€)", "Data_vendita"=>"Data", "Nome_Farmaco"=>"Farmaco",
    "Produttore_farmaco"=>"Produttore", "Nome"=>"Nome cliente", "Cognome"=>"Cognome cliente",
    "Email"=>"Email cliente");

$ID_Table = "tablePurchases";
ob_start();
require '../TableGenerator';
$tablePurchases = ob_get_clean();
//_________________________________________________________________________________________________________


?>
<!DOCTYPE html>

<html lang="it">

<head>
    <!-- Autore: Leonardo Magliolo
     Descrizione: La pagina implementa le funzioni del ruolo 'Farmacista'
     -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Farmacista</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../../../JS/Funzioni/Farmacista/inizialeFarmacista.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../CSS/Funzioni/Funzioni.css">
</head>

<body>
<?=$navBar ?>

<div class="informations">
    <img border="0" src="../../../IMGs/Farmacista.png" alt="Farmacista" width="120" height="120">
</div>

<div class="informations" id="prescriptions">
        <h3>Sono stati effettuati i seguenti ordini:</h3>
    <?=$tablePurchases ?>
</div>

<div class="container" id="containerOrder" >
    <button type="button" class="btn btn-light" aria-label="Close" id="closeButton" style="float: right;">X</button>
    <form id = "formOrder">
        <h1>Inserisci i dati dell'ordine:</h1>
        <input type="number" name="ID_ricetta" placeholder="ID ricetta" required/>
        <input type="text" name="Nome_Farmaco" placeholder="Nome farmaco" required/>
        <input type="text" name="Produttore_farmaco" placeholder="Produttore farmaco" required/>
        <input type="number" name="Numero_confezioni" placeholder="Numero confezioni" required/>
        <input type="number" min="0.0" step="0.01" name="Costo_paziente" placeholder="Costo paziente (€)" required/>
        <input type="number" min="0.0" step="0.01" name="Costo" placeholder="Costo totale (€) " required/>
        <button type="submit" name="order" value="sendOrder">Immetti ordine</button>
        <p id="orderErrorMessage"></p>
    </form>
</div>

<div class="container" id="containerRemoveOrder" >
    <button class="btn btn-light" type="button" id="closeButtonRemove"  style="float: right;">X</button>
    <form id = "formRemoveOrder">
        <h1>Inserisci l'ID della prescrizione per cui desideri rimuovere l'ordine:</h1>
        <input type="number" name="ID_ricetta" placeholder="ID prescrizione" required/>
        <button type="submit" name="order" value="removeOrder">Rimuovi ordine</button>
        <p id="removeErrorMessage"></p>
    </form>
</div>


</body>

</html>

