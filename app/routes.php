<?php

return [
    'index' => [
        'pattern' => '/',
        'action' => function ($req, $res, $args) {
            return $res->withJson(['status' => 'OK']);
        }
    ],

    'authenticate-user' => [
        'method' => 'POST',
        'pattern' => '/user/auth',
        'action' => \Gtw\Action\AuthenticateUser::class
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
        'action' => \Gtw\Action\RegisterUser::class
    ],
];