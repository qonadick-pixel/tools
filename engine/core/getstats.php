<?php
    include $_SERVER['DOCUMENT_ROOT']."/pages/config.php";
    
    $date = $_GET['calendar'];

    $sql = $con->query("SELECT * FROM `qwe_stats` WHERE `date`='".$date."'");
    
    if ($sql->num_rows != 0) {

        while($r = mysqli_fetch_assoc($sql)) {
            echo "[".$r['zero'].", ".$r['one'].", ".$r['two'].", ".$r['three'].", ".$r['four'].", ".$r['five'].", ".$r['six'].", ".$r['seven'].", ".$r['eight'].", ".$r['nine'].", ".$r['ten'].", ".$r['eleven'].", ".$r['twelve'].", ".$r['thirteen'].", ".$r['fourteen'].", ".$r['fifteen'].", ".$r['sixteen'].", ".$r['seventeen'].", ".$r['eighteen'].", ".$r['nineteen'].", ".$r['twenty'].", ".$r['twenty_one'].", ".$r['twenty_two'].", ".$r['twenty_three']."]";
        }
        
    } else {
        $sql = mysqli_query($con,"INSERT INTO `qwe_stats`(`date`) VALUES ('$date')");
    }
?>