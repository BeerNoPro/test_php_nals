<?php

$router->get('', 'WorkController@index');
$router->post('add', 'WorkController@create');
$router->post('store', 'WorkController@store');
$router->delete('delete', 'WorkController@delete');
$router->get('edit', 'WorkController@edit');
$router->put('update', 'WorkController@update');
$router->post('check', 'WorkController@check');
$router->get('search', 'WorkController@search');
$router->get('search_date', 'WorkController@searchDate');
$router->get('date_working', 'WorkController@dateWorking');