<?php

namespace App\Helpers;

/*
 * this class will contain all string match helper method
*/
class StringMatchHelper{
    /*
    * Compare the string 
    */
    public static function matchNames($string1, $string2) {
        \Log::debug("String 1 : " . $string1 . "\n String 2 : " . $string2);
        // Normalize both strings
        $normalizedString1 = self::normalizeString($string1);
        $normalizedString2 = self::normalizeString($string2);
        
        // Split the normalized strings into words
        $parts1 = explode(' ', $normalizedString1);
        $parts2 = explode(' ', $normalizedString2);
        
        // Check if all parts of string2 are present in string1
        foreach ($parts2 as $part) {
            if (!in_array($part, $parts1)) {
                return false;
            }
        }
        
        return true;
    }

    public static function matchAddresses($string1, $string2) {
        \Log::debug("Strings from address");
        \Log::debug("String 1 : " . $string1 . "\n String 2 : " . $string2);
        // Normalize both strings
        $normalizedString1 = self::normalizeString($string1);
        $normalizedString2 = self::normalizeString($string2);
        
        // Split the normalized strings into words
        $parts1 = explode(' ', $normalizedString1);
        $parts2 = explode(' ', $normalizedString2);
        
        // Check if all parts of string2 are present in string1
        foreach ($parts2 as $part) {
            if (!in_array($part, $parts1)) {
                return false;
            }
        }
        
        return true;
    }

    /*
    * Normalize string
    */
    public static function normalizeString($string) {
        $string = strtolower($string);
        $string = preg_replace('/[^a-z0-9\s]/', '', $string);
        $string = preg_replace('/\s+/', ' ', $string);
        return trim($string);
    }
}
