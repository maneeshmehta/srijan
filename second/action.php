<?php

Class Action{
    function test($data){
        
        foreach($data as $row){
        $s1 = $row[0];
        $s2 = $row[1];
        $c = $row[2];
        $i = $row[3];
        $pos = null;
        if($c == 'Y'){
            if($i==0){
                    if(strpos($s1,$s2.' ') !== false)  
                             $pos = strpos($s1,$s2.' ');
            }
            if($pos == null){
                    if(strpos($s1,' '.$s2.' ',$i) !== false)  
                             $pos = strpos($s1,' '.$s2.' ',$i);
                    elseif(strrpos($s1,' '.$s2,$i) !== false)  
                             $pos = strrpos($s1,' '.$s2,$i);
        if($pos != (strlen($s1)-strlen($s2)-1))
        $pos = null;
            }
        }elseif($c == 'N'){
            if(strpos($s1,$s2) !== false)  
                    $pos = strpos($s1,$s2,$i);
        }
        echo $pos ? $pos : 'No Worries','</br>';
        }
        }
}

if(!empty($_POST['data'])){
	$obj = new Action;
        echo "Output is: </br >";
	$obj->test($_POST['data']);
}
?>
