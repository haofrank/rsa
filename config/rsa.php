<?php

return [

    /*
    |--------------------------------------------------------------------------
    | The Keys Path
    |--------------------------------------------------------------------------
    |
    | Set public/private key storage path
    |
    */
    'key_path' => [
        'public' => env('PUBLIC_KEY_PATH', 'public.key'),
        'private' => env('PRIVATE_KEY_PATH',  'private.key'),
    ],


    'key_password' => env('KEY_PASSWORD','')

];
