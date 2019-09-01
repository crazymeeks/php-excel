<?php declare(strict_types=1);

namespace Crazymeeks\PHPExcel\Sheet;

use Crazymeeks\PHPExcel\Sheet\Base;
use Crazymeeks\PHPExcel\Contracts\ExcelInterface;
use Crazymeeks\PHPExcel\Sheet\SpreadSheetInterface;

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
    public function download(ExcelInterface $excel)
    {

        $content_type = $this->contentType();
       
        $file = $this->export($excel);
        $filename = basename($file);

        header('HTTP/1.1 200 OK');
        header('Cache-Control: no-cache, must-revalidate');
        header("Pragma: no-cache");
        header("Expires: 0");
        header("Content-type: $content_type");
        header("Content-Disposition: attachment; filename=$filename");
        readfile($file);

        $this->removedExportedFile();
        
        exit;
    }

    /**
     * @inheritDoc
     */
    protected function contentType()
    {
        return 'text/csv';
    }

}