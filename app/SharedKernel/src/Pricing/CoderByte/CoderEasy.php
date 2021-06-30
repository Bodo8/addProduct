<?php
declare(strict_types = 1);


namespace SharedKernel\Pricing\CoderByte;


class CoderEasy
{

    // Zadanie zmiana stringa
    //Have the function LetterChanges(str) take the str parameter being passed and modify it using
    // the following algorithm. Replace every letter in the string with the letter following it in
    // the alphabet (ie. c becomes d, z becomes a).
    // Then capitalize every vowel in this new string (a, e, i, o, u) and finally return this modified string.

    function LetterChanges($string) {

        $smallLetter = strtolower($string);
        $tabWithLetters = str_split($smallLetter);
        $modifyLetters = [];
        foreach ($tabWithLetters as $letter) {      //change letter to number ascii
            array_push($modifyLetters, ord($letter));
        }

        $changeNumber = [];
        foreach ($modifyLetters as $number) {        //change number ascii +1
            if ($number > 31 && $number < 65) {
                array_push($changeNumber, $number);
            } else {
                if ($number === 122) {
                    array_push($changeNumber, $number - 25); //change 'z' to 'a'
                } else {
                    array_push($changeNumber, $number + 1);
                }
            }

        }

        $tabWithUpperVowel = [];
        foreach ($changeNumber as $lowerLettersNumber) {      //change lower vowel to Upper
            if ($lowerLettersNumber == 97 || $lowerLettersNumber == 101
                || $lowerLettersNumber == 105 || $lowerLettersNumber == 111
                || $lowerLettersNumber == 117) {
                array_push($tabWithUpperVowel, $lowerLettersNumber - 32);
            } else {
                array_push($tabWithUpperVowel, $lowerLettersNumber);
            }
        }

        $changeString = "";
        foreach ($tabWithUpperVowel as $item) {  //build new string from number ascii
            $changeString = $changeString . chr($item);
        }

        return $changeString;
    }

    function LetterChanges2($str) {
        $smallLetter = strtolower($str);
        $tabWithLetters = str_split($smallLetter);
        $alphabet = range("a","z");
        $vowel = array('a', 'e', 'i', 'o', 'u');
        foreach($tabWithLetters as $key => $value){
            if(in_array($value,$alphabet)){
                $tabWithLetters[$key] = $value =='z' ? 'a' : ++$value;
                if(in_array($tabWithLetters[$key],$vowel)){
                    $tabWithLetters[$key] = strtoupper($tabWithLetters[$key]);
                }
            } else {
                $tabWithLetters[$key] = $value;
            }
        }

        return join("",$tabWithLetters);
    }


//Have the function LongestWord(sen) take the sen parameter being passed and return
// the largest word in the string. If there are two or more words that are the same length,
// return the first word from the string with that length. Ignore punctuation and assume
// sen will not be empty.
    function LongestWord($sentence) {
    $tabWithWords = explode(" ", $sentence);
        $alphabet = range("a","z");
        $alphabetCapital = range("A", "Z");
        $allAlphabet = array_merge($alphabet, $alphabetCapital);
        $keyLargestWord = -1;
        $largestWord = 0;
        foreach($tabWithWords as $key => $word) {
            $letters = str_split($word);
            $counter = 0;
            $tabTestLetter = [];
            while (!in_array(false, $tabTestLetter) && $counter < count($letters)) {
                foreach ($letters as $letter) {
                    $isWord = (in_array($letter, $allAlphabet)) ? true : false;
                    array_push($tabTestLetter, $isWord);
                    $counter++;
                }
            }
                 $temp = strlen($word);

                if (!in_array(false, $tabTestLetter) && $temp > $largestWord) {
                    $largestWord = strlen($word);
                    $keyLargestWord = $key;
                }
            }

        $maxWord = ($keyLargestWord >= 0) ?  $tabWithWords[$keyLargestWord] : "";

        return $maxWord;
    }


    function FirstReverse($string) {

        $revers ="";
        $revers = strrev($string);



        return $revers;

    }
//A Narcissistic Number is a number which is the sum of its own digits, each raised to the power of the number of digits in a given base. In this Kata, we will restrict ourselves to decimal (base 10).
//
//For example, take 153 (3 digits):
//
//    1^3 + 5^3 + 3^3 = 1 + 125 + 27 = 153
//and 1634 (4 digits):
//
//    1^4 + 6^4 + 3^4 + 4^4 = 1 + 1296 + 81 + 256 = 1634
    function narcissistic(int $value): bool {
        $ints = str_split((string)$value);
        $power = count($ints);
        $result = 0;
        foreach ($ints as $int) {
            $result += pow($int, $power);
        }
        return $result == $value;
    }
}