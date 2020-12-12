<?php

$yes = explode(".", "football.yes");

if(count($yes) == 1){
    echo "only one bruv";
}else{
    foreach($yes as $field){
        echo $field;
        echo "<br>";
    }
}

//foreach ($yes as $output){
  //  echo $output;
//}



?>