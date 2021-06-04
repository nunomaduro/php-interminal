<?php

test('default', function () {
    $this->artisan('default')
         ->expectsOutput(
             <<<'EOF'
⇲  Matthew Brown >  [RFC] Readonly properties
EOF
         )->assertExitCode(0);
});
