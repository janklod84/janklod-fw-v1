<?php 
namespace JK\Http;


use JK\Http\Contracts\KernelInterface;


/**
 * 
 * @package JK\Http\Kernel
*/ 
class Kernel implements KernelInterface
{


private $router;


/**
 * Construct
 * 
 * @param Router $router 
 * @return void
*/
public function __construct(Router $router)
{
      $this->router = $router;
}


/**
 * Handler
 * 
 * @param \JK\Http\RequestInterface   $request 
 * @return \JK\Http\ResponseInterface $response
*/
public function handle(RequestInterface $request, ResponseInterface $response)
{

}



/**
 * Synthese request and response
 * 
 * @param JK\Http\RequestInterface $request 
 * @param  mixed $output 
 * @return 
*/
public function terminate(RequestInterface $request, $output)
{

}


}