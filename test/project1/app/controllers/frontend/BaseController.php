<?php 
namespace app\controllers\frontend;

use JK\Routing\Controller;


/**
 * Base controller Front part of application
 * @package app\controllers\frontend\BaseController 
*/ 
class BaseController extends Controller 
{
     
   /**
     * Construct
     * @param \JK\Container\ContainerInterface $app 
     * @return void
   */
	 public function __construct($app)
	 {
	 	  parent::__construct($app);
	 	  
      /* $this->loadModel('User'); */
	 }
     

     
   /**
     * Load model
     * @var string $name [ Name of Model ]
     * @return object
   */
	 protected function loadModel($name)
	 {
	 	     $model = sprintf('\\app\\models\\Manager\\%sManager', $name);
	 	     $named = strtolower($name);
         $this->{$named} = new $model();
	 }
}