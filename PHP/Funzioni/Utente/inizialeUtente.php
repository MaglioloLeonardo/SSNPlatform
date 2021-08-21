<?php
include("../../Login/SessionManagement.php");
include("../../DB/connectdb.php");
ControlSession();


//_________________________________________________________________________________________________________
                            //(textcontent, link, id)
$navBarEntries = array(
                        array("Visualizza prescrizioni", "#", "viewPrescriptions"),
                        array("Visualizza acquisti", "#", "viewPurchases"),
                        array("Aggiorna risultati", "inizialeUtente.php", "reload"),
                        array('Cambia ruolo', '../../ChooseRole/ChooseRole.php', "changeRole"),
                );
ob_start();
require '../NavBarGenerator';
$navBar = ob_get_clean();
//_________________________________________________________________________________________________________


//_________________________________________________________________________________________________________
$query = "select * from utente join ricetta r on (utente.Email = r.Medico) where Utente = '{$_SESSION[session_id()][0]}';";
                    //"SQLAttribute"=>"NameColumn"
$columnNames = array("#"=>"#", "ID"=>"ID", "Data_emissione"=>"Data", "Dose_giornaliera"=>"Dose giornaliera (mg)",
                    "Durata_terapia"=>"Durata terapia (giorni)", "Esenzione"=>"Esenzione", "Nome_principio"=>"Principio attivo",
                     "Nome"=>"Nome medico", "Cognome"=>"Cognome medico", "Medico"=>"Email medico");
$ID_Table = "tablePrescription";
ob_start();
require '../TableGenerator';
$tablePrescription = ob_get_clean();
//_________________________________________________________________________________________________________


//_________________________________________________________________________________________________________
$query = "select a.ID_ricetta, a.Numero_confezioni, a.Costo, a.Costo_paziente, a.Data_vendita, a.Nome_Farmaco,
          a.Produttore_farmaco, u.Nome, u.Cognome, u.Email, a.Nome_farmacia, a.Indirizzo_farmacia
          from acquisto a join utente u on (a.Farmacista = u.Email) join ricetta r on (a.ID_ricetta = r.ID)
          where Utente = '{$_SESSION[session_id()][0]}';";
                    //"SQLAttribute"=>"NameColumn"
$columnNames = array("#"=>"#", "ID_ricetta"=>"ID ricetta", "Numero_confezioni"=>"Numero confezioni", "Costo"=>"Costo totale",
                    "Costo_paziente"=>"Costo paziente", "Data_vendita"=>"Data", "Nome_Farmaco"=>"Farmaco",
                    "Produttore_farmaco"=>"Produttore", "Nome"=>"Nome Farmacista", "Cognome"=>"Cognome Farmacista",
                    "Email"=>"Email farmacista", "Nome_farmacia"=>"Farmacia", "Indirizzo_farmacia"=>"Indirizzo farmacia");

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
     Descrizione: La pagina implementa le funzioni del ruolo 'Utente'
     -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>Utente</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="../../../JS/Funzioni/Utente/inizialeUtente.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../CSS/Funzioni/Funzioni.css">

</head>

<body>
 <?=$navBar ?>

 <div class="informations">
     <img border="0" src="../../../IMGs/Utente.png" alt="Utente" width="100" height="100">
 </div>

 <div class="informations" id="prescriptions">
        <h3>Sono state effetuatte le seguenti prescrizioni:</h3>
 <?=$tablePrescription ?>
 </div>

 <div class="informations" id="purchases">
     <h3>Sono state effetuati i seguenti ordini:</h3>
     <?=$tablePurchases ?>
 </div>
</body>

</html>

