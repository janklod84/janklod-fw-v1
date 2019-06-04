<?php 
namespace JK\Database\Migrations\Commands;


/**
 * @package JK\Database\Migrations\Commands\ResetCommand
*/ 
class ResetCommand extends CustomCommand
{


/**
 * @var $name [ Name command input ]
*/
protected $name = 'migration:reset';


/**
 * Execute command
 * @return mixed
*/
public function execute()
{
	   $this->console->execute($this->name, ['No arguments']);
}

/**
 * Execute command
 * @return mixed
*/
public function undo()
{
	   echo __METHOD__."\n";
}

}