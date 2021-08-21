<?php
function roleControl($role){
    if(!in_array($role, $_SESSION[session_id()][1])){
        header("Location: ../../ChooseRole/ChooseRole.php");
        die();
    }
}

function doesExists($sql){
    $result = $GLOBALS["conn"]->query($sql);
    if($result and $result->num_rows > 0){
        return 1;
    }else return 0;
}

function isEmailValid($email){
    if(!isset($email)) return 2;
    $email = $GLOBALS["conn"]->real_escape_string($email);
    return  doesExists("Select * from utente where Email = '$email';");
}

function isPrescriptionValid($id){
    if(!isset($id)) return 2;
    $id = $GLOBALS["conn"]->real_escape_string($id);
    return doesExists("Select * from ricetta where ID = '$id';");
}

function isPrescriptionOfMed($id_prescription, $id_med){
    if(!isset($id_prescription)||!isset($id_med)) return 2;
    $id_prescription = $GLOBALS["conn"]->real_escape_string($id_prescription);
    $id_med = $GLOBALS["conn"]->real_escape_string($id_med);
    return doesExists("Select * from ricetta where ID = '$id_prescription' and Medico = '$id_med';");
}

function isPrescriptionSold($id){
    if(!isset($id)) return 2;
    $id = $GLOBALS["conn"]->real_escape_string($id);
    return doesExists("Select * from acquisto where ID_ricetta = '$id';");
}

function isOrderOfPharm($id_order, $id_pharm){
    if(!isset($id_order)||!isset($id_pharm)) return 2;
    $id_order = $GLOBALS["conn"]->real_escape_string($id_order);
    $id_pharm = $GLOBALS["conn"]->real_escape_string($id_pharm);
    return doesExists("Select * from acquisto where ID_ricetta = '$id_order' and Farmacista = '$id_pharm';");
}

function getPharmFromEmail($email){
    if(!isset($email)) return 0;
    $email = $GLOBALS["conn"]->real_escape_string($email);
    $sql = "select * from farmacista where Email = '$email';";
    $result = $GLOBALS["conn"]->query($sql);
    while($row = $result->fetch_assoc()){
        foreach($row as $cname => $cvalue){
            if($cname == "Nome"){
                $Nome_farmacia = $cvalue;
            }else if($cname == "Indirizzo"){
                $Indirizzo_farmacia = $cvalue;
            }
        }
    }
    return array("Nome_farmacia" => $Nome_farmacia, "Indirizzo_farmacia" => $Indirizzo_farmacia);
}

?>