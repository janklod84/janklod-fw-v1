<?php 
namespace JK\Routing\Commands;

use JK\Console\IO\InputInterface;
use JK\Console\IO\OutputInterface;
use JK\Console\Command;


use JK\Foundation\Console\Generator\GeneratorCommand;

/**
 * Class generate controller 
 *
 * @package JK\Routing\Commands\ComponentCommand
*/ 
abstract class ComponentCommand extends GeneratorCommand
{


/**
* Constructor
* 
* @param JK\Console\IO\InputInterface $input
* @param JK\Console\IO\OutputInterface $output
* @return void
*/
public function __construct(InputInterface $input=null, OutputInterface $output=null)
{
     parent::__construct($input, $output);
}


/**
 * Configuration command
 * 
 * @return void
*/
public function configure() {}



/**
* Rollback command
* 
* @return mixed
*/
public function undo(){}


}