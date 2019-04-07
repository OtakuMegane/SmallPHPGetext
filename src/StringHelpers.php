<?php

namespace SmallPHPGettext;

class StringHelpers
{

    function __construct()
    {
    }

    public function poToString(string $string)
    {
        $string =  preg_replace_callback('/(?<!\\\)(\\\[nrtvef])/u',
                function ($match)
                {
                    $conversions = ['\n' => "\n", '\r' => "\r", '\t' => "\t", '\v' => "\v", '\e' => "\e",
                        '\f' => "\f"];
                    return strtr($match[0], $conversions);
                }, $string);
        $conversions = ['\\\\' => '\\', '\\' => ''];
        return strtr($string, $conversions);
    }

    public function unquoteLine(string $string)
    {
        return preg_replace('/^"|"\s*?$/u', '', $string);
    }

    public function stringToPo(string $string)
    {
    		$conversions = ['\\' => '\\\\', "\n" => '\n', "\t" => '\t', "\"" => '\\"'];
    		return strtr($string, $conversions);
    }
}