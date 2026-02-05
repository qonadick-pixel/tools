<?php
    include $_SERVER['DOCUMENT_ROOT']."/pages/config.php";

    $sql = $con->query("SELECT * FROM `qwe_cmds` WHERE active = 1");

    $rows = array();
    while($r = mysqli_fetch_assoc($sql)) {
        $rows[] = $r;
    }
    
    $rows = Array(
        'json'=>$rows,
    );
    $json = json_encode($rows);
    
    echo $json;
?>