<?php

return [
    'User' => [
        'name'         => 'User' ,
        'description'  => 'User Module' ,
        'status'       => true ,
        'services'     => [
            'provider' => 'Modules\\User\\UserServiceProvider' ,
            'lang'     => [
                'path' => 'Modules/User/lang' ,
                'name' => 'user' ,
            ] ,
        ] ,
        'dependencies' => [] ,
    ] ,
    'Bank' => [
        'name'         => 'Bank' ,
        'description'  => 'Bank Module' ,
        'status'       => true ,
        'services'     => [
            'provider' => 'Modules\\Bank\\BankServiceProvider' ,
            'lang'     => [
                'path' => 'Modules/Bank/lang' ,
                'name' => 'bank' ,
            ] ,
        ] ,
        'dependencies' => [
            'User' ,
        ] ,
    ] ,
];
