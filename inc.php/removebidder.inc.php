<?php
    if(isset($_SESSION['login'])) {
        $bidderid = $_POST['bidderID'];
        $bidder = Bidder :: findBidder($bidderid);
        $result = $bidder->removeBidder();
        if($result) 
            echo "<h2> Bidder $bidderid removed </h2> \n";
        else 
            echo "<h2> Sorry, problem removing bidder $bidderid </h2>\n";
    } else {
        echo "<h2>Please login first</h2>";
    }
?>