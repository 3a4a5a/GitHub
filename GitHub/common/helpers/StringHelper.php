<?php

namespace common\helpers;

?>

<?php

class StringHelper
{
    /**
     * 
     * @param string $string a még levágatlan string
     * @param int $maxLength a levágás pozíciója (string kívánt hossza)
     * @return string a levágott string
     */
    public static function truncateString($string, $maxLength)
    {
        $result = $string;
        
        if (strlen($string) > $maxLength) {
            $result = substr($string, 0, $maxLength);
        }
        
        return $result;
    }
}
?>