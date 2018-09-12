<?php
include 'Enc.php';
Class Second implements Enc {

public function encription($input) {
   echo 'first enc';
}

public function decription($input) {
    echo "first dec";
}

}

$a = new First;
$a->encription('abc');
$a->decription('abc');

