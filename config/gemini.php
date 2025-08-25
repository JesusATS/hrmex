<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Gemini API Key
    |--------------------------------------------------------------------------
    |
    | This value is the API key for your Gemini application. You can obtain
    | this value from the Google AI Studio.
    |
    */
    'api_key' => env('GEMINI_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Gemini Model
    |--------------------------------------------------------------------------
    |
    | This value is the model that will be used to generate content. You can
    | find a list of available models in the Gemini documentation. We
    | recommend using a stable, recent model like 'gemini-1.5-flash-latest'.
    |
    */
    'model' => env('GEMINI_MODEL', 'gemini-1.5-flash-latest'),
];