<?php declare(strict_types=1);

namespace Crazymeeks\PHPExcel\Sheet;

use Crazymeeks\PHPExcel\Sheet\Base;
use Crazymeeks\PHPExcel\Contracts\ExcelInterface;
use Crazymeeks\PHPExcel\Sheet\SpreadSheetInterface;

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