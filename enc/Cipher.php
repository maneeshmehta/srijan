<?php
namespace enc;

include 'Enc.php';
Class Cipher implements Enc {

public static function encrypt($input) {
    if(!$input)
        return false;
   // perform OpenSSL or mcrypt algo here.
    return trim(base64_encode($input));
}

public static function decrypt($input) {
    if(!$input)
        return false;
    // perform OpenSSL or mcrypt algo here.
    return base64_decode($input);
}

}

$input = "This is the Sampel text";
echo "Input : ".$input;
echo "<br /><br />";
$encdata = Cipher::encrypt($input);
echo "Encription :". $encdata;
echo "<br /><br />";
$decdata = Cipher::decrypt($encdata);
echo "Decription :". $decdata;


