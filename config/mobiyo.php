<?php

return [
    'api_key'     => env('MOBIYO_API_KEY'),     // affiché dans back-office
    'secret'      => env('MOBIYO_SECRET'),      // secret pour vérifier api_sig
    'autolog_ttl' => env('AUTOLOG_TTL', 30),    // minutes
    'product_access_grace' => env('PRODUCT_ACCESS_GRACE', 15), // minutes
    'bypass_signature' => env('MOBIYO_BYPASS_SIGNATURE', false), // <—
];


