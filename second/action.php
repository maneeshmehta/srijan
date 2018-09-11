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
			echo $s1 = substr($s1,$i);
            $arr = explode(' ',$s1);
			$key = array_search($s2, $arr);
			if($key !== null){ 
				$pos = $key;
				for($i=0;$i<$key;$i++){
					$pos =$pos+strlen($arr[$i]);
				}
				
			}
			$pos = $pos+$i;
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
