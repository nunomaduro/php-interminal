<?php

namespace App\Formatters;

class ColorizeLinks
{
    /**
     * Runs the formatter.
     *
     * @param array $mail
     *
     * @return array
     */
    public function __invoke($mail)
    {
        $mail['extract'] = preg_replace(
            '|([\w\d]*)\s?(https?://([\d\w\.-]+\.[\w\.]{2,6})[^\s\]\[\<\>]*/?)|i',
            '<fg=#4f46e5>$0</>',
            $mail['extract']
        );

        $mail['extract'] = str_replace('https://www.', '', $mail['extract']);

        $mail['extract'] = str_replace('https://', '', $mail['extract']);

        return $mail;
    }
}
