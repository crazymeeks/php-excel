<?php declare(strict_types=1);


namespace Crazymeeks\PHPExcel\Factory;

use ReflectionClass;
use \Crazymeeks\PHPExcel\Sheet\SpreadSheetInterface;

class SheetFactory
{
 
    
    /**
     * Spreadsheet maker
     * 
     * @param string $spreadsheet_type
     *
     * @return \Crazymeeks\PHPExcel\Sheet\SpreadSheetInterface
     */
    public function make(string $spreadsheet_type): SpreadSheetInterface
    {
        $class = "Crazymeeks\\PHPExcel\\Sheet\\" . ucfirst($spreadsheet_type);

        $reflection = new ReflectionClass($class);

        $instance = $reflection->newInstanceArgs([]);

        return $instance;
    }
}