<?php
Kirby::plugin('timoreddig/super-paragraph', [
    'tags' => [
        'wikipedia' => [
            'html' => function($tag) {
                return '<a href="http://wikipedia.org">Wikipedia</a>';
            }
        ]
    ]
]);