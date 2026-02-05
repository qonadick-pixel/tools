<?php
$ircServer = "irc.esper.net";
$ircPort = "6667";
$ircChannel = "#grndtools";

set_time_limit(0);

$ircSocket = fsockopen($ircServer, $ircPort, $eN, $eS);

if ($ircSocket) {

    fwrite($ircSocket, "USER Lost rawr.test lol :code\n");
    fwrite($ircSocket, "NICK Rawr" . rand() . "\n");
    fwrite($ircSocket, "JOIN " . $ircChannel . "\n");

    while(1) {
        while($data = fgets($ircSocket, 128)) {
            echo nl2br($data);
            flush();

            // Separate all data
            $exData = explode(' ', $data);

            // Send PONG back to the server
            if($exData[0] == "PING") {
                fwrite($ircSocket, "PONG ".$exData[1]."\n");
            }
        }
    }
} else {
    echo $eS . ": " . $eN;
}
?>