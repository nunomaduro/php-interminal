<?php

namespace App\Formatters;

class RemoveSignatures
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
        $mail['extract'] = explode('SHA256 hash:', $mail['extract'])[0];

        return $mail;
    }
}
