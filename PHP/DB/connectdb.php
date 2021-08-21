<?php
$host='localhost';
$user='root';
$password='root';
$db='tweb';
$GLOBALS["conn"]= new mysqli($host,$user,$password,$db);
if(!$GLOBALS["conn"] || $GLOBALS["conn"]->connect_errno > 0)
{
    print "Errore: impossibile connettersi al database";
    die();
}

function printQuery($sql){
    $result = $GLOBALS["conn"]->query($sql);
    while($row = $result->fetch_assoc()){
        foreach($row as $cname => $cvalue){
            print "$cname: $cvalue\t";
        }
        print "\r\n";
    }
}

function performInsertQuery($query, $printError){
    if($results = $GLOBALS["conn"]->query($query)) {
    }else{
        $error = $GLOBALS["conn"]->errno . ' ' . $GLOBALS["conn"]->error;
        if($printError)echo $error;
    }
}
?>
