<?php

return [

    'operations' => [

        'book.view'   => [],
        'book.create' => [],
        'book.update' => [],
        'book.delete' => [],

        'author.view'   => [],
        'author.create' => [],
        'author.update' => [],
        'author.delete' => [],

        'subscription.create' => [],
        'report.view' => [],
    ],

    'roles' => [

        'guest' => [
            'type' => 2,
            'children' => [
                'book.view',
                'author.view',
                'subscription.create',
                'report.view',
            ],
        ],

        'user' => [
            'type' => 2,
            'children' => [
                'guest',

                'book.create',
                'book.update',
                'book.delete',

                'author.create',
                'author.update',
                'author.delete',
            ],
        ],
    ],
];