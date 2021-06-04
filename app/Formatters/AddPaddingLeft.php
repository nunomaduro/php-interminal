<?php

namespace App\Formatters;

class AddPaddingLeft
{
    /**
     * Runs the formatter.
     *
     * @param  array $mail
     * @return array
     */
    public function __invoke($mail)
    {
        $mail['extract'] = str_replace("\n", "\n   ", $mail['extract']);
        $mail['extract'] = "\n   " . $mail['extract'];

        return $mail;
    }
}
