<?php 
namespace JK\Loader;


use \Exception;


/**
 * @package JK\Loader\Load
*/ 
class Load
{
      
/**
* @var \JK\Container\ContainerInterface $app
* @var  
*/
private $app;
private $controller;
private $models = [];
private $callback;



/**
* Constructor
* @param \JK\Container\ContainerInterface $app 
* @return void
*/
public function __construct($app)
{
    $this->app = $app;
}


/**
* Call action
* @param \JK\Container\ContainerInterface $app
* @return mixed
*/
public function callAction($callback, $matches=[])
{
    if(is_array($callback))
    {
         $controller = $this->getController(
            $callback['controller']
         );
         $action = strtolower(
            $callback['action']
         );

         $callback = [$controller , $action];
         $this->controller = $controller;
    }
    
    if(!is_callable($callback))
    {
        // redirect to NotFoundController 404
         notFound();
    }
    
    $this->call($this->controller, 'before');
    $output = call_user_func_array($callback, $matches);
    $this->call($this->controller, 'after');
    
    // response send headers to server
    $output = (string) $output;
    response()->setBody($output);
    response()->send();
}



/**
* Call before or after 
* how we want
* @param object $object
* @param string $method
* @return void
*/
public function call($object, $method='before')
{
    if(!is_null($object))
    {
        if(method_exists($object, $method))
        {
            call_user_func([$object, $method]);
        }
        return false;
    }
    return false;
}


/**
 * Get current object
 * @param object $obj 
 * @return type
*/
public function currentObject(object $obj)
{
    return get_class($obj);
}


/**
* Get controller
* @param string $name
* @return object
* @throws \Exception
*/
public function getController($name)
{
    $controller = $this->getModule('\\app\\controllers', $name);
    if(!class_exists($controller))
    {
         throw new Exception(
           sprintf('class <strong>%s</strong> does not exit!', $controller), 
           404
        );
    }

    return new $controller($this->app);
}

/**
 * Get module name
 * @param string $directory 
 * @param string $name 
 * @return string
*/
public function getModule($directory='', $name='')
{
   return sprintf('%s\\%s', $directory, $name);
}


/**
* Load module [To add more functionalites later]
* @param string $name
* @return string
* @throws \Exception
*/
public function module(string $name)
{
     return $this->getModule('\\modules', $name);
}



/**
* Call the given model
* 
* @param string $model 
* @return object
*/
public function model($model)
{
    $model = $this->getModelName($model); 
    if(!$this->hasModel($model))
    {
        $this->addModel($model);
    }
    return $this->getModel($model); 
}  


/**
* Determine if the given 
* class exists in the models container
* 
* @param string $model
* @return bool
*/
public function hasModel($model)
{
     return array_key_exists($model, $this->models);
}


/**
 * Create new object for the given controller and store it
 * in models container
 *
 * @param string $model
 * @return void
*/
private function addModel($model)
{
   $object = new $model($this->app);
   $this->models[$model] = $object;
}



/**
* Get the model  object
*
* @param string $model
* @return object
*/
private function getModel($model)
{
    return $this->models[$model];
}


/**
* Get the full class name for the given model
*
* @param  string $name
* @return string
*/
private function getModelName($name)
{
   $model = $this->getModule('\\app\\models', $name);
   if(!class_exists($model))
   {
       exit(sprintf(
        'Sorry class Model [ <b>%s</b> ] does not exist!', 
        $model)
       ); 
   }
   return $model;
}


}