<?php declare(strict_types=1);


namespace Crazymeeks\PHPExcel\Factory;

use ReflectionClass;
use Crazymeeks\PHPExcel\Sheets\SpreadSheetInterface;

class SheetFactory
{
 
    
    /**
     * Spreadsheet maker
     * 
     * @param string $spreadsheet_type
     *
     * @return Crazymeeks\Crazymeeks\PHPExcel\Sheets\SpreadSheetInterface
     */
    public function make(string $spreadsheet_type): SpreadSheetInterface
    {
        $class = "Crazymeeks\\PHPExcel\\Sheets\\" . ucfirst($spreadsheet_type);

        $reflection = new ReflectionClass($class);

        $instance = $reflection->newInstanceArgs([]);

        return $instance;
    }
}