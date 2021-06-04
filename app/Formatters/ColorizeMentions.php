<?php

namespace App\Formatters;

class ColorizeMentions
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
        $mail['extract'] = collect(explode("\r\n", $mail['extract']))->map(function ($line) {
            if (str_ends_with($line, ' wrote:')) {
                return "<fg=gray>▕</>  <fg=blue>$line</>";
            }

            if (str_starts_with($line, '>')) {
                $line = ltrim($line, '>');

                return "<fg=gray>▕ $line</>";
            }

            return $line;
        })->implode("\r\n");

        return $mail;
    }
}
