#!/bin/bash

if [ $1 == 'OFF' ]; then
    sed -i "s/Route::post('register',\s\[RegisteredUserController::class,\s'store']);/\/\/Route::post('register', \[RegisteredUserController::class, 'store']);/g" src/routes/auth.php
    sed -i "s/Route::get('register',\s\[RegisteredUserController::class,\s'create'])/\/\/Route::get('register', \[RegisteredUserController::class, 'create'])/g" src/routes/auth.php
    sed -i "s/->name('register');/\/\/->name('register');/g" src/routes/auth.php
fi

if [ $1 == 'ON' ]; then
    sed -i "s/\/\/Route::post('register',\s\[RegisteredUserController::class,\s'store']);/Route::post('register', \[RegisteredUserController::class, 'store']);/g" src/routes/auth.php
    sed -i "s/\/\/Route::get('register',\s\[RegisteredUserController::class,\s'create'])/Route::get('register', \[RegisteredUserController::class, 'create'])/g" src/routes/auth.php
    sed -i "s/\/\/->name('register');/->name('register');/g" src/routes/auth.php
fi