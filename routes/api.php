<?php

use App\Http\Controllers\DevolucionController;

// Listar devoluciones
Route::get('/devoluciones', [DevolucionController::class, 'index']); 

// Mostrar una devolución
Route::get('/devoluciones/{id}', [DevolucionController::class, 'show']); 

// Crear una devolución
Route::post('/devoluciones', [DevolucionController::class, 'store']); 

// Actualizar una devolución
Route::put('/devoluciones/{id}', [DevolucionController::class, 'update']); 

// Eliminar una devolución
Route::delete('/devoluciones/{id}', [DevolucionController::class, 'destroy']); 

// Ruta para validar usuario
Route::post('/validar-usuario', [DevolucionController::class, 'validarUsuario']);
