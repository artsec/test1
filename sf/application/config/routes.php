<?php defined('SYSPATH') or die('No direct script access.');

    Route::set('admin', 'admin(/<controller>(/<action>(/<id>)))')
         ->defaults(array(
             'directory'  => 'admin',
             'controller' => 'auth',
             'action'     => 'index',
         ));

    Route::set('default', '(<controller>(/<action>(/<id>)))')
         ->defaults(array(
             'controller' => 'default',
             'action'     => 'index',
         ));

    Route::set('files', '(<file>)', array('file' => '.+'))
         ->defaults(array(
             'controller' => 'error',
             'action'     => '404',
         ));