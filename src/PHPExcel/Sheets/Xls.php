<?php declare(strict_types=1);

namespace PHPExcel\Sheet;

use PHPExcel\Sheet\Base;
use PHPExcel\Contracts\ExcelInterface;
use PHPExcel\Sheet\SpreadSheetInterface;

class Xls extends Base implements SpreadSheetInterface
{

    /**
     * @inheritDoc
     */
    protected function contentType()
    {
        return 'application/vnd.ms-excel';
    }

}