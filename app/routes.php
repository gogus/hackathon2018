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
    ],

    'get-user-points' => [
        'pattern' => '/user/points/{userId}',
        'action' => \Gtw\Action\GetUserPoints::class
    ],

    'patch-user-points' => [
        'method' => 'POST',
        'pattern' => '/user/points/{userId}',
        'action' => \Gtw\Action\PatchUserPoints::class
    ],

    'register-user' => [
        'method' => 'POST',
        'pattern' => '/user',
        'action' => \Gtw\Action\RegisterUser::class,
    ],
];