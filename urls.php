<?php

return [
    '/{provider}' => [
        'name' => 'auth',
        'callback' => '\Modules\Social\Controllers\SocialController:auth'
    ],
];