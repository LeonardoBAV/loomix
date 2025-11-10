<?php

return [

    'browsershot' => [
        'binary' => '/home/sail/.cache/puppeteer/chrome/linux-137.0.7151.55/chrome-linux64/chrome',
        'nodeBinary' => '/usr/bin/node',
        'npmBinary' => '/usr/bin/npm',
        'options' => [
            'args' => [
                '--no-sandbox',
                '--disable-setuid-sandbox',
                '--disable-gpu',
            ],
        ],
    ],

    'timeout' => 60,
];
