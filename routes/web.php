<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;

// Esta es la única ruta que necesitas para la web.
// Le dice a Laravel: "Cuando alguien visite la URL raíz ('/'),
// muéstrale el contenido del archivo 'resources/views/panel.blade.php'".
Route::get('/', function () {
    return view('panel');
});


Route::get('/test-log', function () {
    Log::info('¡El log está funcionando correctamente!');
    return 'Entrada de log creada. Revisa el archivo storage/logs/laravel.log.';
});