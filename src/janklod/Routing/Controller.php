<?php 
namespace JK\Routing;

use \Config;
use JK\Routing\Debug\Printer;



/**
 * @package JK\Routing\Controller
*/
abstract class Controller 
{
     
/**
* @var \JK\DI\ContainerInterface $app
* @var \JK\Loader\Load $load
* @var \JK\Template\View $view
* @var \JK\Http\Request $request
* @var string $layout
* @var array $data
* @var string $autoview 
* [ set automatically view by using controller and action ]
*/
protected $app;
protected $load;
protected $view;
protected $request;
protected $layout = 'default';
protected $autoview = true;
protected $debug = true;


/**
* Constructor
* @param \JK\DI\ContainerInterface $app 
* @return void
*/
public function __construct($app)
{
     $this->app     = $app;
     $this->view    = $app->view;
     $this->request = $app->request;
     $this->load    = $app->load;
     $this->view->setLayout(
        $this->mapLayout()
     );
}

 
/**
* Set data
* @param array $data 
* @return void
*/
protected function set($data = [])
{
    $this->view->setData($data);
}



/**
* View render
* @param string $view 
* @param array $data 
* @return mixed
*/
protected function render($view, $data = [])
{
     $this->view->setView($view);
     $this->view->setData($data);
     $this->view->render();
}


/**
 * Get name current controller
 * @return string
*/
public function currentController()
{
    return $this->load->currentObject($this);
}


/**
* map layout
* @return mixed
*/
protected function mapLayout()
{
   if(!$this->layout)
   { return false; }
   else{ 
     if(Config::get('view.layout') !== '')
     {
          $this->layout = Config::get('view.layout');
     }
     return 'layouts/'. $this->layout;
  }
}


/**
* Must to add later next functionnality
* Do something before calling action
* @return void
*/
public function before() {}


/**
* Must to add later next functionnality
* Do something after calling action
* @return void
*/
public function after()
{
    if($this->debug)
    { $this->info(); }
}



/**
* Show currents view , layout, and controller
* @return void
*/ 
public function info()
{
     if($this->hasPath())
     {
         $printer = new Printer();
         $printer->data('controller', $this->currentController());
         $printer->data('view', $this->view->viewPath());
         $printer->data('layout', $this->view->layoutPath());
         $printer->output();
     }
}


/**
 * Determine if has isset path
 * @return bool
*/
private function hasPath()
{
    return $this->layout 
           && $this->view->viewPath(); 
}

}