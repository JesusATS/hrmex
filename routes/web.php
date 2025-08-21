<?php

use Illuminate\Support\Facades\Route;

// Esta es la única ruta que necesitas para la web.
// Le dice a Laravel: "Cuando alguien visite la URL raíz ('/'),
// muéstrale el contenido del archivo 'resources/views/panel.blade.php'".
Route::get('/', function () {
    return view('panel');
});