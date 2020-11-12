<?php declare(strict_types=1);

namespace PHPExcel\Sheet;

use PHPExcel\Sheet\Base;
use PHPExcel\Contracts\ExcelInterface;
use PHPExcel\Sheet\SpreadSheetInterface;

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