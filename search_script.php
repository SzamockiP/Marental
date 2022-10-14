<?php
    if(urlencode($_POST['phrase'])) $url = htmlentities("search.php?phrase=".urlencode($_POST['phrase']))."&page=1";
    else $url= "search.php?page=1";

    if($_POST['tag']){
        $url .= "&tags=".urlencode(implode("%",$_POST['tag']));
    }
    
    if($_POST['publisher']){
        $url .= "&publisher=".urlencode(implode("%",$_POST['publisher']));
    }

    if($_POST['sort_by']){
        $url .= "&sort=".$_POST['sort_by'];
    }

    header("Location: ".$url);
?>