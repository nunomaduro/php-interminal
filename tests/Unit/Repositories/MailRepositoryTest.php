<?php

use App\Repositories\MailRepository;
use Illuminate\Support\Collection;

test('latest', function () {
    $mails = resolve(MailRepository::class);

    expect($mails->latest())
        ->toBeInstanceOf(Collection::class)
        ->sequence(
            fn ($mail) => $mail->toEqual([
            'extract' => <<<EOF

This is a great idea!\r
\r
Might be worth mentioning that Psalm already supports a `@readonly`\r
docblock annotation (first suggested by Nuno Maduro), and it matches the\r
proposed behaviour (though Psalm doesn't currently prevent inheritance\r
issues):\r
\r
Example: https://psalm.dev/r/7ed5872738\r
\r
On Fri, 4 Jun 2021 at 11:19, Nikita Popov <nikita.ppv@gmail.com> wrote:\r
\r
> Hi internals,\r
>\r
> I'd like to open the discussion on readonly properties:\r
> https://wiki.php.net/rfc/readonly_properties_v2\r
>\r
> This proposal is similar to the\r
> https://wiki.php.net/rfc/write_once_properties RFC that has been declined\r
> previously. One significant difference is that the new RFC limits the scope\r
> of initializing assignments. I think a key mistake of the previous RFC was\r
> the confusing "write-once" framing, which is both technically correct and\r
> quite irrelevant.\r
>\r
> Please see the rationale section (\r
> https://wiki.php.net/rfc/readonly_properties_v2#rationale) for how this\r
> proposal relates to other RFCs and alternatives.\r
>\r
> Regards,\r
> Nikita\r
>
EOF . '   ',
            'subject' => ' [RFC] Readonly properties',
            'fromName' => 'Matthew Brown',
        ]));
});
