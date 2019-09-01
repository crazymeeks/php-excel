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