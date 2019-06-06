<?php 
namespace JK\Database\Facades;

use JK\Service\ServiceProvider;
use JK\Database\DB;



/**
 * @package JK\Database\Facades\DatabaseProvider
*/ 
class DatabaseProvider extends ServiceProvider
{
        
/**
 * Register service
 * @return void
*/
public function register()
{
    $this->app->singleton('db', function () {
         // return DB::instance();
    });
}


}