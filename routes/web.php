<?php

use App\Http\Controllers\AnexoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HistoricoController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ServidorController;
use App\Http\Middleware\CheckIsLogged;
use App\Http\Middleware\CheckIsNotLogged;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('index');

//Se não logado
Route::middleware([CheckIsNotLogged::class])->group(function(){
    Route::post('login', [AuthController::class, 'login'])->name('login');
});

//Se logado
Route::middleware([CheckIsLogged::class])->group(function(){
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('servidor')->group(function(){
        Route::get('/', [ServidorController::class, 'index'])->name('servidor');
        Route::get('listar', [ServidorController::class, 'listar'])->name('servidor.listar');
        Route::get('detail/{id}', [ServidorController::class, 'detail'])->name('servidor.detail');
        Route::get('edit/{id}', [ServidorController::class, 'edit'])->name('servidor.edit');
        Route::get('atualiza', [ServidorController::class, 'atualiza'])->name('servidor.atualiza');
        Route::post('pesquisacpf', [ServidorController::class, 'pesquisaCpf'])->name('servidor.pesquisacpf');
        Route::post('salvacpf', [ServidorController::class, 'salvaCpf'])->name('servidor.salvacpf');
        Route::post('updatestatus', [ServidorController::class, 'updateStatus'])->name('servidor.updatestatus');
        Route::post('update', [ServidorController::class, 'update'])->name('servidor.update');
        Route::post('addcol', [ServidorController::class, 'formSaveCol'])->name('servidor.addcol');
        Route::get('timeline/{id}', [ServidorController::class, 'timeline'])->name('servidor.timeline');
        Route::get('pdf/{id}/{pdf}', [ServidorController::class, 'detail'])->name('servidor.pdf');
    });
    Route::prefix('historico')->group(function(){
        Route::get('detail/{id}', [HistoricoController::class, 'detail'])->name('historico.detail');
        Route::post('save', [HistoricoController::class, 'save'])->name('historico.save');
        Route::post('delete', [HistoricoController::class, 'delete'])->name('historico.delete');
        Route::post('saveinterino', [HistoricoController::class, 'saveInterino'])->name('historico.saveinterino');
        Route::post('deleteinterino', [HistoricoController::class, 'deleteInterino'])->name('historico.deleteinterino');
    });
    Route::prefix('anexo')->group(function(){
        Route::get('/{id}', [AnexoController::class, 'index'])->name('anexo');
        Route::get('listar', [AnexoController::class, 'listar'])->name('anexo.listar');
        Route::post('salvar', [AnexoController::class, 'salvar'])->name('anexo.salvar');
        Route::post('deletar', [AnexoController::class, 'deletar'])->name('anexo.deletar');
    });
});
