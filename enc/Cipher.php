<?php
namespace enc;

include 'Enc.php';
Class Cipher implements Enc {
    
    private static $Key= "dsfdshfvsdasawq2";
    private static $Algo = MCRYPT_BLOWFISH;
    
    public static function encrypt($input) {
        if(!$input)
            return false;

        $iv_size = mcrypt_get_iv_size(self::$Algo, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

        $crypt = mcrypt_encrypt(self::$Algo, self::$Key, $input, MCRYPT_MODE_ECB, $iv);
        return trim(base64_encode($crypt));
    }

    public static function decrypt($input) {
        if(!$input)
            return false;
		
        $crypt = base64_decode($input);

        $iv_size = mcrypt_get_iv_size(self::$Algo, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

        $decrypt = mcrypt_decrypt(self::$Algo, self::$Key, $crypt, MCRYPT_MODE_ECB, $iv);
        return trim($decrypt);
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


