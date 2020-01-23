<?php
    return [
        [
            'route'  => 'parse_forum_od_ua',
            'class'  => 'App\Parser\Application\Command\ParseCommand',
            'method' => 'parse',
        ],
        [
            'route'  => 'consumer_save_parse_data',
            'class'  => 'App\Parser\Application\Command\ConsumerSaveParseDataCommand',
            'method' => 'consume',
        ]
    ];

