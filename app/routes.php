<?php

return [
    'index' => [
        'pattern' => '/',
        'action' => function ($req, $res, $args) {
            return $res->withJson(['status' => 'OK']);
        }
    ],
    'get-user-by-username' => [
        'pattern' => '/user/{username}',
        'action' => \Gtw\Action\GetUserByUsername::class
    ],

    'get-user-address' => [
        'pattern' => '/user/address/{userId}',
        'action' => \Gtw\Action\GetUserAddress::class
    ]


];