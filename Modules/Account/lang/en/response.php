<?php

return [
    'index'   => [
        'success' => ':module list successfully received.' ,
        'fail'    => ':module list failed to receive.' ,
    ] ,
    'show'    => [
        'success' => ':module successfully received.' ,
        'fail'    => ':module failed to receive.' ,
    ] ,
    'store'   => [
        'success' => ':module successfully created.' ,
        'fail'    => ':module failed to create.' ,
    ] ,
    'update'  => [
        'success' => ':module successfully updated.' ,
        'fail'    => ':module failed to update.' ,
    ] ,
    'destroy' => [
        'success' => ':module successfully deleted.' ,
        'fail'    => ':module failed to delete.' ,
    ] ,
    'payment' => [
        'charge'  => [
            'success' => 'Payment successfully charged.' ,
            'fail'    => 'Payment failed to charge.' ,
        ] ,
        'withdraw'  => [
            'success' => 'Payment successfully withdrawn.' ,
            'fail'    => 'Payment failed to withdraw.' ,
        ] ,
        'transfer'  => [
            'success' => 'Payment successfully transferred.' ,
            'fail'    => 'Payment failed to transfer.' ,
        ] ,
    ]
];
