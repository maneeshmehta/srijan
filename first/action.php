<?php

Class Action{
	public function countWord($word, $questions){
		for($i=0;$i<count($questions);$i++){
                // Find question in each word.
		echo $this->replaceQuery($questions[$i], $word);
		echo '</br>';
				
		}
	}
        // Find the ? and its position and remove it from question and remove character from each word from same position. 
	private function replaceQuery($question, $words){ 
                $pos = strpos($question, '?');
                if($pos === 0 || $pos >0){
                    $question = substr_replace($question,"",$pos,1);
                    $words = $this->removeElementFromPosition($words, $pos);
                    $this->replaceQuery($question, $words); 
                }else{
                    $count = 0;
                    for($i=0;$i<count($words);$i++){  
                         if($words[$i] === $question){
                             $count++;
                         }
                     }
                     echo $count;
                }        	
	}
        // Remove character from each word from ? position
        private function removeElementFromPosition($word, $pos){ 
		for($i=0;$i<count($word);$i++){
                    $wd[] = substr_replace($word[$i],"",$pos,1); 
		}
                return $wd;
        }
	
}

if(!empty($_POST['word']) && !empty($_POST['question'])){
	$obj = new Action;
        echo "Output is: </br >";
	$obj->countWord($_POST['word'], $_POST['question']);
}
?>
