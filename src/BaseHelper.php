<?php

namespace Soldatov\Helpers;

abstract class BaseHelper
{
    /**
     * @param string $str
     * @param int $width
     * @param string $break
     * @param bool $cut
     * @return string
     */
    protected static function mb_wordwrap(string $str, int $width = 75, string $break = "\n", bool $cut = false): string
    {
        $lines = explode($break, $str);
        foreach ($lines as &$line) {
            $line = rtrim($line);
            if (mb_strlen($line) <= $width)
                continue;
            $words = explode(' ', $line);
            $line = '';
            $actual = '';
            foreach ($words as $word) {
                if (mb_strlen($actual . $word) <= $width)
                    $actual .= $word . ' ';
                else {
                    if ($actual != '')
                        $line .= rtrim($actual) . $break;
                    $actual = $word;
                    if ($cut) {
                        while (mb_strlen($actual) > $width) {
                            $line .= mb_substr($actual, 0, $width) . $break;
                            $actual = mb_substr($actual, $width);
                        }
                    }
                    $actual .= ' ';
                }
            }
            $line .= trim($actual);
        }
        return implode($break, $lines);
    }
}
