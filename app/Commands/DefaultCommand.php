<?php

namespace App\Commands;

use App\Formatters;
use App\Repositories\MailRepository;
use LaravelZero\Framework\Commands\Command;

class DefaultCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'default';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'PHP Internals discussions.';

    /**
     * The list of mail formatters.
     *
     * @var array
     */
    protected $formatters = [
        Formatters\Trim::class,
        Formatters\RemoveSignatures::class,
        Formatters\ColorizeLinks::class,
        Formatters\ColorizeMentions::class,
        Formatters\AddPaddingLeft::class,
        Formatters\ColorizeSymbols::class,
    ];

    /**
     * Execute the console command.
     *
     * @param  \App\Repositories\MailRepository
     *
     * @return void
     */
    public function handle(MailRepository $mails)
    {
        $this->newLine();

        $mails->latest()->reverse()->map(function ($mail) {
            collect($this->formatters)->map(
                fn ($formatter) => resolve($formatter),
            )->each(function ($formatter) use (&$mail) {
                $mail = $formatter->__invoke($mail);
            });

            return $mail;
        })->each(function ($mail) {
            $this->output->writeln([
                "<fg=green>⇲</>  <fg=white;options=bold>{$mail['fromName']}</>"
                ."<fg=#6C7280> > </>{$mail['subject']}"
                ."<fg=#6C7280> > </>{$mail['createdAt']}",
                $mail['extract'],
                '',
            ]);
        });
    }
}
