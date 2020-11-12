<?php declare(strict_types=1);

namespace PHPExcel\Sheet;

use PHPExcel\Contracts\ExcelInterface;

interface SpreadSheetInterface
{
 
    /**
     * Export data
     *
     * @param \PHPExcel\Contracts\ExcelInterface $excel
     * 
     * @return string The exported file(include absolute path)
     */
    public function export(ExcelInterface $excel);
}