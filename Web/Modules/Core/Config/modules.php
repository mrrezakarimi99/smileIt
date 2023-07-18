<?php

return [
    'User'    => [
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
    'Bank'    => [
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
    'Account' => [
        'name'         => 'Account' ,
        'description'  => 'Account Module' ,
        'status'       => true ,
        'services'     => [
            'provider' => 'Modules\\Account\\AccountServiceProvider' ,
            'lang'     => [
                'path' => 'Modules/Account/lang' ,
                'name' => 'account' ,
            ] ,
        ] ,
        'dependencies' => [
            'User' ,
        ] ,
    ] ,
    'Transaction' => [
        'name'        => 'Transaction' ,
        'description' => 'Transaction Module' ,
        'status'      => true ,
        'services'    => [
            'provider' => 'Modules\\Transaction\\TransactionServiceProvider' ,
            'lang' => [
                'path' => 'Modules/Transaction/lang' ,
                'name' => 'transaction' ,
            ] ,
        ] ,
        'dependencies' => [
            'Account' ,
            'User' ,
            'Bank' ,
        ] ,
    ] ,
];
