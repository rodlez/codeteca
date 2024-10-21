<?php

declare(strict_types=1);

use Framework\Http;

/**
 * Show a given value with a nice format, give info to debug better
 */

function showNice(mixed $value, string $info = "")
{
    echo "*******************************************************************<br />";
    echo "<br />VALUE TYPE - " . gettype($value) . "<br />";
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    echo "*******************************************************************<br />";
    dd($info);
}

/**
 * Interval between today and other date string in format 'Y-m-d' e.g (2020-12-25)
 */

function datesInterval(string $date): DateInterval
{

    $today = date_create(date('Y-m-d'));
    $date = date_create($date);

    return date_diff($today, $date);
}

/**
 * trims text to a space then adds ellipses if desired
 * @param string $input text to trim
 * @param int $length in characters to trim to
 * @param bool $ellipses if ellipses (...) are to be added
 * @param bool $strip_html if html tags are to be stripped
 * @return string 
 */
function excerpt(string $input, int $length, bool $ellipses = true, bool $strip_html = true): string
{
    //TODO: check
    //strip tags, if desired
    if ($strip_html) $input = strip_tags($input);

    //no need to trim, already shorter than trim length
    if (strlen($input) <= $length) return $input;

    //find last space within length
    $last_space = strrpos(substr($input, 0, $length), ' ');
    dd($last_space);
    $trimmed_text = substr($input, 0, $last_space);

    //add ellipses (...)
    if ($ellipses) $trimmed_text .= '...';

    return $trimmed_text;
}

/**
 * Get the filename without extension
 */

function getFileName($filename): string
{
    return pathinfo($filename, PATHINFO_FILENAME);
}

/**
 * Get the filename with the length of characters from start
 */
function shortFilename($filename, $length): string
{
    return substr($filename, 0, $length);
}

/**
 * 
 */

 function displayText($textRaw)
 {
    var_dump($textRaw);
    dd(strip_tags($textRaw));

    $text = htmlspecialchars($textRaw);
    
    return preg_replace('/\n/', '<br>' . PHP_EOL, $text);
 }