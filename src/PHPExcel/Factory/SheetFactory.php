<?php declare(strict_types=1);


namespace PHPExcel\Factory;

use ReflectionClass;
use \PHPExcel\Sheet\SpreadSheetInterface;

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
        $class = "PHPExcel\\Sheet\\" . ucfirst($spreadsheet_type);

        $reflection = new ReflectionClass($class);

        $instance = $reflection->newInstanceArgs([]);

        return $instance;
    }
}