<?php 
namespace JK\Http;


/**
 * @package JK\Http\RequestInterface 
*/ 
interface RequestInterface
{
	  
	
       /**
        * Return data from all type request
        * 
        * @param string $key 
        * @return mixed
       */
       public function input($key = null);


       /**
        * Return data from request $_FILES
        * @var string $key
        * @return array
       */
       public function file($key = null);



       /**
        * Return data from request $_COOKIE
        * @var string $key 
        * @return array
       */
       public function cookie($key = null);
     
       
       
       /**
        * Return data from request $_SESSION
        * @var string $key 
        * @return array
       */
       public function session($key = null);


       /**
        * Return server
        * @param string $key 
        * @return mixed
       */
       public function server($key = null);

}