<?php declare(strict_types=1);

namespace Crazymeeks\PHPExcel\Sheets;

use Crazymeeks\PHPExcel\Contracts\ExcelInterface;

interface SpreadSheetInterface
{
 
    /**
     * Export data
     *
     * @param \Crazymeeks\PHPExcel\Contracts\ExcelInterface $excel
     * 
     * @return string The exported file(include absolute path)
     */
    public function export(ExcelInterface $excel);
}