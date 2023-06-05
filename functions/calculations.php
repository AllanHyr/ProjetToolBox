<?php

    function getPercent($percent = null, $of = null , $result =null){

        if($result === null){
            $result = $percent * $of / 100;

            return [
                'result' => $result,
            ];
        }
        if($percent === null){
            $percent = $of / $result * 100;

            return [
                'percent' => $percent,
            ];
        }
        if($of === null){
            $of = $result * 100 / $percent;

            return [
                'of' => $of,
            ];
        }
    }

    function ruleOfThird($a = 1, $b = 1, $c = 1): array
    {
        return [
            'd' => ($b * $c)  / $a,
        ];
    }

    function cesar($clear, $key, $reverse = false){
        $result = '';

        for ($i = 0; $i < mb_strlen($clear); $i++) {    // obtenir le code Unicode du caractère
            $char = mb_substr($clear, $i, 1);
            $unicode = mb_ord($char);
            
            if ($unicode >= 65 && $unicode <= 90) { // vérifier si le caractère est une lettre majuscule
                if($reverse)    {
                    $unicode = (($unicode + 65) - $key);
                    if($unicode < 0)    {
                        $unicode = $unicode + 26 + 65;
                    } else  {
                        $unicode = ($unicode  % 26) + 65;
                    }
                } else  {
                    $unicode = ((($unicode - 65) + $key) % 26) + 65;  
                }
            } else if ($unicode >= 97 && $unicode <= 122) { // vérifier si le caractère est une lettre minuscule
                if($reverse)    {
                    $unicode = (($unicode - 97) - $key);
                    if($unicode < 0)    {
                        $unicode = $unicode + 26 + 97;
                    } else  {
                        $unicode = ($unicode  % 26) + 97;
                    }
                } else  {
                    $unicode = ((($unicode - 97) + $key) % 26) + 97;
                }
            }else if($unicode >= 192 && $unicode <= 255) {  // vérifier si le caractère entre 192 et 255 ASCII
                if($reverse)    {
                    $unicode = ($unicode -  192 - $key);
                    if($unicode < 0)    {
                        $unicode = $unicode + 64 + 192;
                    } else  {
                        $unicode = ($unicode  % 64) + 192;
                    }
                } else  {
                    $unicode = (($unicode - 192 + $key) % 64) + 192;
                }
            } else{
                $unicode = 32;  //Sinon ajout un espace
            }
            $result .= mb_chr($unicode, 'UTF-8');   // change le code ASCII en caractère
        }

    
        if($reverse){
            return [
                'clear' => $result,
            ];
        } else {
            return [
                'result' => $result,
            ];
        }
    }

    function convertEuroDollars($inputDevise = null, $outputDevise = null, $inputValue = null){

        $url = 'https://open.er-api.com/v6/latest/' . $inputDevise;

        $data = file_get_contents($url);
        $data = json_decode($data, true);
        $rate = $data['rates'][$outputDevise];

            $result = $inputValue * $rate;
            return [
                'outputValue' => $result,
            ];
    }
