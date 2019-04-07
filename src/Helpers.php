<?php

namespace SmallPHPGettext;

class Helpers
{
    private $category_lookups = ['LC_ALL', 'LC_COLLATE', 'LC_CTYPE', 'LC_MONETARY', 'LC_NUMERIC', 'LC_TIME', 'LC_MESSAGES'];

    function __construct()
    {
    }

    public function categoryLookup(int $category)
    {
        return $this->category_lookups[$category];
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