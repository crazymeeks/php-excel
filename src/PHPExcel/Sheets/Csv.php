<?php declare(strict_types=1);

namespace Crazymeeks\PHPExcel\Sheets;

use Crazymeeks\PHPExcel\Sheets\Base;
use Crazymeeks\PHPExcel\Contracts\ExcelInterface;
use Crazymeeks\PHPExcel\Sheets\SpreadSheetInterface;

class Csv extends Base implements SpreadSheetInterface
{

    /**
     * @inheritDoc
     */
    public function export(ExcelInterface $excel)
    {

        $data = $this->getData($excel);
        $real_file = $this->getFile();
        $file = \fopen($real_file, self::WRITE_MODE_OVERWRITE);
        
        foreach($data as $fields){
            $fields = (array) $fields;
            \fputcsv($file, $fields);
            unset($fields);
        }

        \fclose($file);

        return $real_file;

    }

    /**
     * @inheritDoc
     */
    protected function contentType()
    {
        return 'text/csv';
    }

}