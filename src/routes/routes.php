<?php

Route::group(['prefix' => 'api/siswa', 'middleware' => ['web']], function() {
    $controllers = (object) [
        'index'     => 'Bantenprov\Siswa\Http\Controllers\SiswaController@index',
        'create'    => 'Bantenprov\Siswa\Http\Controllers\SiswaController@create',
        'show'      => 'Bantenprov\Siswa\Http\Controllers\SiswaController@show',
        'store'     => 'Bantenprov\Siswa\Http\Controllers\SiswaController@store',
        'edit'      => 'Bantenprov\Siswa\Http\Controllers\SiswaController@edit',
        'update'    => 'Bantenprov\Siswa\Http\Controllers\SiswaController@update',
        'destroy'   => 'Bantenprov\Siswa\Http\Controllers\SiswaController@destroy',
    ];

    Route::get('/',             $controllers->index)->name('siswa.index');
    Route::get('/create',       $controllers->create)->name('siswa.create');
    Route::get('/{id}',         $controllers->show)->name('siswa.show');
    Route::post('/',            $controllers->store)->name('siswa.store');
    Route::get('/{id}/edit',    $controllers->edit)->name('siswa.edit');
    Route::put('/{id}',         $controllers->update)->name('siswa.update');
    Route::delete('/{id}',      $controllers->destroy)->name('siswa.destroy');
});
