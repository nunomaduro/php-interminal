<?php

namespace App\Formatters;

class Trim
{
    /**
     * Runs the formatter.
     *
     * @param  array $mail
     * @return array
     */
    public function __invoke($mail)
    {
        $mail['extract'] = trim($mail['extract']);

        return $mail;
    }
}
