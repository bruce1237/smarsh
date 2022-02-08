<?php


class intRoman
{
    // private key digit to Roman dicttionary
    private static $romanDic = [
        1 => 'I',
        5 => 'V',
        10 => 'X',
        50 => 'L',
        100 => 'C',
        500 => 'D',
        1000 => 'M'
    ];


    /**
     * convert int to roman letter
     *
     * @param integer $int
     * @return string roman letter
     */
    public static function intToRoman(int $int): string
    {
        $roman = [];
        $intArr = str_split((string)$int);
        $len = strlen((string)$int);
        foreach ($intArr as $place => $digit) {
            // $roman[$place] = self::convertDigitToRoman($digit, $len - $place);
            $roman[$place] = self::getRomanByDigitAndPlace($digit, $len - $place);
        }
        $romanString =  implode($roman);

        if($int != self::romanToInt($romanString)){
            echo 'Wrong----'.PHP_EOL;
        }

        return $romanString;
    }

    /**
     * repeat the roman letter 
     *
     * @param string $romanDigit
     * @param integer $repeat
     * @return string
     */
    private static function getRepeatRomanDigit(string $romanDigit, int $repeat): string
    {
        $rtn = '';
        for ($i = 0; $i < $repeat; $i++) {
            $rtn .= $romanDigit;
        }
        return $rtn;
    }


    private static function getRomanByDigitAndPlace(int $digit, int $place):string{
        $roman = ''; 
        switch ($digit) {
            case 0:
                $roman = '';
                break;
            case 4:
                $roman = self::$romanDic[str_pad(1,$place,"0")] . self::$romanDic[str_pad(5,$place,"0")];
                break;
            case 9:
                $roman = self::$romanDic[str_pad(1,$place,"0")] . self::$romanDic[str_pad(1,$place+1,"0")];
                break;
            case 1:
            case 5:
                $roman = self::$romanDic[str_pad($digit, $place, "0")];
                break;
            default:
                $roman = 5 - $digit > 0 ? (self::getRepeatRomanDigit( self::$romanDic[str_pad(1,$place,"0")], $digit)) :  self::$romanDic[str_pad(5,$place,"0")] . (self::getRepeatRomanDigit( self::$romanDic[str_pad(1,$place,"0")],  $digit - 5));
                break;
        }
        return $roman;
    }

    /**
     * convert Roman Letter into Int
     *
     * @param string $roman
     * @return integer
     */
    public static function romanToInt(string $roman):int{
        $romanArr = str_split($roman);
        $intArr = array();

        foreach($romanArr as $place=>$romanDigit){
            $intDigit = self::convetRomanDigitToInt($romanDigit);

            if(isset($intArr[$intDigit])){
                $intArr[$intDigit]+=$intDigit;
            }else{
                $intArr[$intDigit]=$intDigit;

            }
        }
        $lastKey = null;
        foreach($intArr as $key=>$value){
            
            if($lastKey){
                if($lastKey<$key){
                    $intArr[$key] = $value - $intArr[$lastKey];
                    unset($intArr[$lastKey]);
                }
            }
            
            $lastKey = $key;
        }

        return array_sum($intArr);
    }

    private static function convetRomanDigitToInt(string $romanDigit):?int{
        return isset(array_flip(self::$romanDic)[$romanDigit])?array_flip(self::$romanDic)[$romanDigit]:null;
    }


}


do{

    $handle = fopen("php://stdin", "r");
    echo "please type in a INT between 1 and 3999 Or Roman Number: ";
    
    $input = strtoupper(trim(fgets($handle)));
    
    if((int)$input == $input){
        echo "Roman For {$input} is ".  intRoman::intToRoman((int)$input) .PHP_EOL;
        
        
    }else{
        
            echo "INT For {$input} is ".  intRoman::romanToInt($input) .PHP_EOL;
        
    }
}
while(true);


