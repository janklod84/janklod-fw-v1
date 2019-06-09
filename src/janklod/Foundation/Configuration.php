<?php 
namespace JK\Foundation;


/**
 * @package JK\Foundation\Configuration
*/ 
class Configuration
{


/**
* Base Configuration of application
*/
const SRC = [
'providers' => [
\JK\Http\Facades\ResponseProvider::class,
\JK\Routing\Facades\RouterProvider::class, 
\JK\Loader\Facades\LoaderProvider::class,
\JK\View\Facades\ViewProvider::class,
\JK\Database\Facades\DatabaseProvider::class,
\JK\Validation\Facades\ValidationProvider::class,
],
'alias' => [
 'Route'    => 'JK\\Routing\\Route\\Route',
 'Request'  => 'JK\\Http\\Request',
 'Auth'     => 'JK\\Security\\Authenticate\\Auth',
 'Asset'    => 'JK\\View\\Components\\Asset',
 'View'     => 'JK\\View\\View',
 'HTML'     => 'JK\\View\\Components\\HTML', 
 'Config'   => 'JK\\Config\\Config',
 'Url'      => 'JK\\Helper\\Url',
 'DI'       => 'JK\\DI\\Container',
 'DB'       => 'JK\\Database\\DB',
 'Q'        => 'JK\\ORM\\Q'
],
'commands' => [
     // Database
     // \JK\Database\Migrations\Commands\RollbackCommand::class,
     // \JK\Database\Migrations\Commands\MigrateCommand::class,
     /* ........... */
     // Routing
     // \JK\Routing\Commands\GenerateController::class,
     // Model
     // \JK\Database\Commands\GenerateModel::class,
     // Controller
     // \JK\Routing\Commands\GenerateController::class
     JK\Console\GenerateControllerCommand::class,
     JK\Console\TestCommand::class
],
'locator' => [
  'cache_dir' => '/temp/cache/',
  'migration_dir' => '/temp/database/migrations/',
  'log_file' => 'temp/log/error.txt'
]
];
			
}