<?php
    include("../Login/Login.php");
    include("../InputFunctions.php");

    $attributiUtente = array("Nome" => $regexOnlyText, "Cognome" => $regexOnlyText, "Codice_fiscale" => $regexCODFiscale,
                        "Data_nascita" => $regexDate, "Città_residenza" => $regexOnlyText, "Indirizzo_residenza" => $regexAtLeastOneText,
                        "Città_nascita" => $regexOnlyText, "Email" => $regexEmail, "Password"=> $regexPassword);
    $attributiMedico = array();
    $attributiFarmacista = array("Nome_farmacia" => $regexAtLeastOneText, "Città_farmacia" => $regexOnlyText, "Indirizzo_farmacia" => $regexAtLeastOneText);


    $mismatchList = array();
    $thereAreErrors = false;

    $mismatchList = isValidInput($attributiUtente, $mismatchList);

    if($_POST["role"] == "Medico"){
        $mismatchList = isValidInput($attributiMedico, $mismatchList);
    }else if($_POST["role"] == "Farmacista") {
        $mismatchList = isValidInput($attributiFarmacista, $mismatchList);
    }

    if(sizeof($mismatchList)>0){
        $thereAreErrors = true;
        ?>
        <p>
            <h2>Errore</h2>I seguenti campi non rispettano la sintassi corretta:
        <ul>
        <?php foreach ($mismatchList as $attribute){ ?>

        <li><?= $attribute?></li>

        <?php
        } ?>
        </ul>
        </p>
        <?php
    }

    if(!array_key_exists("Email", $_POST) || isEmailValid($_POST["Email"])){
        $thereAreErrors = true;
        print "<p><h3>Errore: L'email usata è già associata ad un account esistente</h3></p>";
    }

    if($thereAreErrors){
        die();
    }

    foreach ($_POST as $attribute => $value){
        $_POST[$attribute] = $GLOBALS["conn"]->real_escape_string($_POST["$attribute"]);
    }

    $_POST["Password"] = hash('sha256', $_POST["Password"]);
    $sql = "INSERT INTO utente (Nome, Cognome, Codice_fiscale, Data_nascita, Indirizzo_residenza, Email, Password, Città_residenza, Città_nascita) 
                VALUES ('{$_POST["Nome"]}','{$_POST["Cognome"]}','{$_POST["Codice_fiscale"]}','{$_POST["Data_nascita"]}','{$_POST["Indirizzo_residenza"]}',
                        '{$_POST["Email"]}','{$_POST["Password"]}', '{$_POST["Città_residenza"]}', '{$_POST["Città_nascita"]}')";
    performInsertQuery($sql, true);

    if($_POST["role"] == "Medico"){
        $sqlMedico = "INSERT INTO medico (Email) VALUES ('{$_POST["Email"]}');";
        performInsertQuery($sqlMedico, true);
    }else if($_POST["role"] == "Farmacista") {
        $sqlFarmacia = "INSERT INTO farmacia (Nome, Indirizzo, Città) VALUES ('{$_POST["Nome_farmacia"]}', '{$_POST["Indirizzo_farmacia"]}', '{$_POST["Città_farmacia"]}');";
        $sqlFarmacista = "INSERT INTO farmacista (Email, Nome, Indirizzo) VALUES ('{$_POST["Email"]}','{$_POST["Nome_farmacia"]}', '{$_POST["Indirizzo_farmacia"]}');";
        performInsertQuery($sqlFarmacia, false);
        performInsertQuery($sqlFarmacista, true);
    }

    print !$thereAreErrors;
    ?>


