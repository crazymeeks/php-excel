<?php declare(strict_types=1);

namespace Crazymeeks\PHPExcel\Sheets;

use Crazymeeks\PHPExcel\Sheets\Base;
use Crazymeeks\PHPExcel\Contracts\ExcelInterface;
use Crazymeeks\PHPExcel\Sheets\SpreadSheetInterface;

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