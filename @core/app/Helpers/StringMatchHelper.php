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
        $normalizedString1 = self::normalizeString($string1);
        $normalizedString2 = self::normalizeString($string2);
        $parts1 = explode(' ', $normalizedString1);
        $parts2 = explode(' ', $normalizedString2);
        foreach ($parts2 as $part) {
            if (!in_array($part, $parts1)) {
                return false;
            }
        }
        return true;
    }

    /*
     * Match address 
     */
    public static function matchAddresses($string1, $string2) {
        $normalizedString1 = self::normalizeString($string1);
        $normalizedString2 = self::normalizeString($string2);
        $parts1 = explode(' ', $normalizedString1);
        $parts2 = explode(' ', $normalizedString2);
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

    /*
    * Check Matching word in service title and problem
    */
    public static function hasMatchingWord($serviceTitle, $problemTitle, $category, $subCategory) {
        $serviceWords = explode(' ', strtolower($serviceTitle));
        if (self::hasCommonWords($serviceWords, $problemTitle)) {
            return true;
        }
        if (self::hasCommonWords($serviceWords, $category)) {
            return true;
        }
        if (self::hasCommonWords($serviceWords, $subCategory)) {
            return true;
        }
        return false;
    }

    /*
     * Match the common words 
     */
    public static function hasCommonWords($words1, $words2) {
        return !empty(array_intersect($words1, explode(' ', strtolower($words2))));
    }
}
