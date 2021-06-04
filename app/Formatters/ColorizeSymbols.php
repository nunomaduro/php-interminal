<?php

namespace App\Formatters;

class ColorizeSymbols
{
    /**
     * Runs the formatter.
     *
     * @param  array $mail
     * @return array
     */
    public function __invoke($mail)
    {
        foreach (['--'] as $symbol) {
            $mail['extract'] = str_replace(
                $symbol,
                "<fg=gray>$symbol</>",
                $mail['extract'],
            );
        }

        return $mail;
    }
}
