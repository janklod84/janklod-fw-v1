<?php 
namespace JK\FileSystem;


use \Exception;


/**
 * @package JK\File 
*/ 
class File 
{
      
       /**
        * separator for windows / lunix ..
        * @const string
       */
       const DS = DIRECTORY_SEPARATOR;



       /**
        * root file
        * @var string
       */
       private $root;
       
       
       

       /**
        * Constructor
        * Ex: $file = new File(__DIR__);
        * @param string $root [ it's the root directory of file ]
        * @return void
        * @throws FileException
       */
  	   public function __construct($root = null)
  	   {
    		   if(is_null($root))
    		   {
    			    throw new FileException("You must to set root directory for FileSystem", 404);
    		   }

    		   $this->root = trim($root, '/');
  	   }


       /**
        * Determine wether the given file path exists
        * 
        * Ex: (new File(__DIR__))->exists('routes/app.php');
        * It'll determine if file __DIR__.'/routes/app.php' exist
        * @param string $file
        * @return bool
       */
       public function exists($file): bool
       {
            return file_exists($this->to($file));
       }

       
       /**
        * Require The given file
        *
        * Ex: (new File(__DIR__))->call('routes/app.php')
        * It'll call file __DIR__.'/routes/app.php'
        * @param string $file
        * @return bool
       */
        public function call($file)
        {
            return require_once($this->to($file));
        }


        
       
       /**
         * Generate full path to the given path
         * 
         * Ex: (new File(__DIR__))->to('routes/app.php')
         * It'll return full path  __DIR__.'/routes/app.php'
         * @param string $path
         * @return string
       */
  	   public function to($path)
  	   {
             return $this->fullPath($path);
  	   }

       
       /**
        * Prepare path 
        * @param string $path 
        * @return string
       */
       private function fullPath($path)
       {
            return str_replace('/', self::DS, $this->root) . self::DS. str_replace(
                       ['/', '\\'], 
                       static::DS, 
                       trim($path, '/')
                   );
       }
}