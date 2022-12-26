<?php

use Illuminate\Support\Facades\Route;

Route::get('/',            "AuthController@login")->name('login');
Route::get ("/login", 		"AuthController@login")->name('login');
Route::post('/login', 		"AuthController@entrar");
Route::get ('/logout', 		'AuthController@logout')->name('logout');


Route::group(['middleware' => ['auth']], function () {

    Route::get ('/', 							'HomeController@index')->name('home');
    Route::get ('/alterasenha',					'UserController@AlteraSenha');
	Route::post('/salvasenha',   				'UserController@SalvarSenha');
    
    
    
    
    //========================================================================================
	// 										ROLE
	//========================================================================================
    Route::get('role/perm/{id}',					'configs\permissionamento\RoleController@rolePerm');  
    
    
    //========================================================================================
	// 										GUARDA
	//========================================================================================
	Route::get('/agente/tabela/{situacao}',        		'AgenteController@tabela');	

    //========================================================================================
	// 										USER
	//========================================================================================
    Route::get('user/perm/{id}',					'UserController@perm');   
	Route::put('user/perm',							'UserController@permSave');   
    


	//========================================================================================
	// 									OCORRENCIAS
	//========================================================================================
    Route::get('ocorrencia/datatables', 				'OcorrenciaController@dados');
    Route::post('ocorrencia/image',                     'OcorrenciaController@storeImage')->name('ocorrencia.storeImage');
    Route::post('ocorrencia/enviaformulario',			'OcorrenciaController@envia');
    Route::delete('ocorrencia/deleteimg/{id}',          'OcorrenciaController@deleteimg');
    

    //========================================================================================
	// 										CONFIGS
	//========================================================================================
    Route::resource('role',                     'configs\permissionamento\RoleController');
    Route::resource('permission',               'configs\permissionamento\PermissionController');

    Route::get('atendimento',                   'configs\ocorrencia\OcorrenciaController@atendimento_index')->name('atendimento.index');
    Route::get('atendimento/create',            'configs\ocorrencia\OcorrenciaController@atendimento_create');
    Route::post('atendimento ',                 'configs\ocorrencia\OcorrenciaController@atendimento_store');

    Route::get('tipo',                          'configs\ocorrencia\OcorrenciaController@tipo_index')->name('tipo.index');
    Route::get('tipo/create',                   'configs\ocorrencia\OcorrenciaController@tipo_create');
    Route::post('tipo ',                        'configs\ocorrencia\OcorrenciaController@tipo_store');
                
    Route::get('clima',                         'configs\ocorrencia\OcorrenciaController@clima_index')->name('clima.index');
    Route::get('clima/create',                  'configs\ocorrencia\OcorrenciaController@clima_create');
    Route::post('clima ',                       'configs\ocorrencia\OcorrenciaController@clima_store');
                
    Route::get('transportado',                  'configs\ocorrencia\OcorrenciaController@transportado_index')->name('transportado.index');
    Route::get('transportado/create',           'configs\ocorrencia\OcorrenciaController@transportado_create');
    Route::post('transportado ',                'configs\ocorrencia\OcorrenciaController@transportado_store');
                
    Route::get('conducao',                      'configs\ocorrencia\OcorrenciaController@conducao_index')->name('conducao.index');
    Route::get('conducao/create',               'configs\ocorrencia\OcorrenciaController@conducao_create');
    Route::post('conducao ',                    'configs\ocorrencia\OcorrenciaController@conducao_store');
                
    Route::get('setor',                         'configs\ocorrencia\OcorrenciaController@setor_index')->name('setor.index');
    Route::get('setor/create',                  'configs\ocorrencia\OcorrenciaController@setor_create');
    Route::post('setor ',                       'configs\ocorrencia\OcorrenciaController@setor_store');
                
    Route::get('categoria',                     'configs\ocorrencia\OcorrenciaController@categoria_index')->name('categoria.index');
    Route::get('categoria/create',              'configs\ocorrencia\OcorrenciaController@categoria_create');
    Route::post('categoria ',                   'configs\ocorrencia\OcorrenciaController@categoria_store');
                


    
    //========================================================================================
	// 										RESOURCE
	//========================================================================================
    Route::resource('user',                     'UserController');
    Route::resource('agente',                   'AgenteController');
    Route::resource('cargo',                    'CargoController');
    Route::resource('ocorrencia',               'OcorrenciaController');
});