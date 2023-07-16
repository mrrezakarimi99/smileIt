<?php

return [
    'User'      => [
        'name'         => 'User' ,
        'description'  => 'User Module' ,
        'status'       => false ,
        'services'     => [
            'provider' => 'Modules\\User\\UserServiceProvider' ,
            'lang'     => [
                'path' => 'Modules/User/lang' ,
                'name' => 'user' ,
            ] ,
        ] ,
        'dependencies' => [
            '' ,
        ] ,
    ] ,
];
