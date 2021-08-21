<!DOCTYPE html>

<html lang="it">

<head>
    <!-- Autore: Leonardo Magliolo
     Descrizione: La pagina permette di selezionare il ruolo su cui si vuole lavorare
    -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css"  href="../../CSS/ChooseRole/ChooseRole.css">
    <title>ScegliRuolo</title>
</head>

<body>
<?php
include("../Login/Login.php");
include("../Login/SessionManagement.php");
function getRoles($Email){
    $userRoles = array("Utente");
    $Email = $GLOBALS["conn"]->real_escape_string($Email);
    $sql = "select * from medico where Email = '{$Email}';";
    if($result = $GLOBALS["conn"]->query($sql) and $result->num_rows > 0){
        array_push($userRoles, "Medico");
    }
    $sql = "select * from farmacista where Email = '{$Email}';";
    if($result = $GLOBALS["conn"]->query($sql) and $result->num_rows > 0){
        array_push($userRoles, "Farmacista");
    }
    return $userRoles;
}

$email = ""; $password = "";

if(array_key_exists("Email", $_GET) && array_key_exists("Password", $_GET)){
    $email = $_GET["Email"]; $password = $_GET["Password"];
}

if((!isLoginValid($email, $password)) and !isset($_COOKIE[session_name()])){
    header("Location: ../Login/LoginSignupForm.php");
    die();
}else{
    if(isset($_COOKIE[session_name()])){
        ControlSession();
    }
    if(session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if(isLoginValid($email, $password)){
        $_SESSION[session_id()] = array($email, getRoles($email));
    }

    //_________________________________________________________________
    $navBarEntries = array();
    $logout = "../Login/Logout.php";
    ob_start();
    require '../Funzioni/NavBarGenerator';
    $navBar = ob_get_clean();
    //_________________________________________________________________
?>

<?=$navBar?>
<?php
if(in_array("Utente", $_SESSION[session_id()][1]) and !in_array("Medico", $_SESSION[session_id()][1]) and !in_array("Farmacista", $_SESSION[session_id()][1])){
    header("Location: ../Funzioni/Utente/inizialeUtente.php");
    die();
}
if(in_array("Utente", $_SESSION[session_id()][1])){
?>
<div id="info">	<h1>Seleziona un ruolo:</h1> </div>
<div id="Utente">
    <p>
        <a href="../Funzioni/Utente/inizialeUtente.php">
            <img border="0" src="../../IMGs/Utente.png" alt="Utente" width="300" height="300">
        </a>
    </p>
    <p class="description"> Utente</p>
</div>
<?php
}
if(in_array("Medico", $_SESSION[session_id()][1])){
?>

<div id="Medico">
    <p>
        <a href="../Funzioni/Medico/inizialeMedico.php">
            <img border="0" src="../../IMGs/Medico.png" alt="Medico" width="300" height="300">
        </a>
    </p>
    <p class="description">	Medico</p>
</div>
<?php
}
if(in_array("Farmacista", $_SESSION[session_id()][1])){
?>
<div id="Farmacista">
    <p>
        <a href="../Funzioni/Farmacista/inizialeFarmacista.php">
            <img border="0" src="../../IMGs/Farmacista.png" alt="Farmacista" width="300" height="300">
        </a>
    </p>
    <p class="description">	Farmacista</p>
</div>
<?php
}
?>

    </body>
</html>

<?php } ?>