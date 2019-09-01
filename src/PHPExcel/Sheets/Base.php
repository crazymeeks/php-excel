<?php declare(strict_types=1);

namespace Crazymeeks\PHPExcel\Sheet;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Crazymeeks\PHPExcel\Contracts\ExcelInterface;

abstract class Base
{

    const WRITE_MODE_APPEND = 'a';
    const WRITE_MODE_OVERWRITE = 'w';

    /**
     * @var \PhpOffice\PhpSpreadsheet\Spreadsheet
     */
    private $spreadsheet;

    /**
     * Absolute location of the file(/tmp/myfile.xls)
     * 
     * @var string
     */
    private $file;

    /**
     * The filename of the exported file
     * 
     * @var string
     */
    private $filename;

    public function __construct()
    {
        $this->spreadsheet = new Spreadsheet();
    }

    /**
     * Remove export file. Used specially when download() method is called
     *
     * @return void
     */
    protected function removedExportedFile()
    {
        if (\file_exists($this->getFile())) {
            @unlink($this->getFile());
        }
    }

    /**
     * Get data to be exported
     *
     * @param \Crazymeeks\PHPExcel\Contracts\ExcelInterface $excel
     * 
     * @return array
     */
    public function getData(ExcelInterface $excel)
    {
        $data = $excel->dataToExport();

        $this->setFileName($excel)->setFile($excel);

        if (!is_array($data)) {
            throw \Crazymeeks\PHPExcel\Exceptions\ExportDataFormatInvalidException::notArray(get_class($excel));
        }

        if (count($data) > 0) {
            
            if (!is_array($data[0])) {

                if (is_object($data[0])) {
                    ;
                } else {
                    throw \Crazymeeks\PHPExcel\Exceptions\ExportDataFormatInvalidException::notMultiArray(get_class($excel));
                }
            }
        }

        $spreadsheet_header = $excel->getHeader();

        if (count($spreadsheet_header) < 0) {
            throw new \Exception(get_class($excel) . " should not return an empty array.");
        }

        // Merge header
        $data = array_merge([$excel->getHeader()], $data);
        
        return $data;
    }

    /**
     * Set filename with extension
     *
     * @param \Crazymeeks\PHPExcel\Contracts\ExcelInterface $excel
     * 
     * @return $this
     */
    private function setFileName(ExcelInterface $excel): Base
    {
        $this->filename = \str_replace('.' . $excel->getType(), '', $excel->getFilename()) . "." . \str_replace('.', '', $excel->getType());

        return $this;
    }

    /**
     * @param \Crazymeeks\PHPExcel\Contracts\ExcelInterface $excel
     *
     * @return $this
     */
    private function setFile(ExcelInterface $excel): Base
    {
        $this->file = $this->getPath($excel) . $this->getFileName();

        return $this;
    }

    /**
     * Get absolute location of the file
     *
     * @return string
     */
    protected function getFile(): string
    {
        return $this->file;
    }

    /**
     * @inheritDoc
     */
    public function export(ExcelInterface $excel)
    {

        $data = $this->getData($excel);
        $this->setExcelHeader($data, $excel)->write($data, $excel);
        return $this->getFile();

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
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');
        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0
        readfile($file);

        $this->removedExportedFile();
        
        exit;
    }

    /**
     * Extract and set excel header from data
     *
     * @param array &$data
     * @param \Crazymeeks\PHPExcel\Contracts\ExcelInterface $excel
     * 
     * @return array
     */
    private function setExcelHeader(array &$data, ExcelInterface $excel)
    {
        $headers = array_shift($data);

        $spreadsheet = $this->spreadsheet->setActiveSheetIndex($this->getActiveSheetIndex($excel));
        foreach($headers as $key => $header){
            $column = $this->sheetColumns()[$key] . (1);
            $spreadsheet->setCellValue($column, $header);
            unset($key, $header, $column);
        }

        unset($spreadsheet, $headers);

        return $this;

    }

    /**
     * 
     * @param array $data
     * @param \Crazymeeks\PHPExcel\Contracts\ExcelInterface $excel
     *
     * @return void
     */
    private function write(array $data, ExcelInterface $excel): void
    {
        
        $spreadsheet = $this->spreadsheet->setActiveSheetIndex($this->getActiveSheetIndex($excel));
        $column_index = 2; // start writing actual data to row 2 of the cell
        
        foreach($data as $array_data){
            foreach($array_data as $key => $actual_data){
                $column = $this->sheetColumns()[$key] . ($column_index);
                $spreadsheet->setCellValue($column, $actual_data);
                unset($actual_data);
            }
            $column_index++;
            unset($array_data);
        }

        $writer = IOFactory::createWriter($this->spreadsheet, ucfirst($excel->getType()));
        $writer->save($this->getFile());

    }

    /**
     * @param @param \Crazymeeks\PHPExcel\Contracts\ExcelInterface $excel
     * 
     * @return int
     */
    private function getActiveSheetIndex(ExcelInterface $excel): int
    {
        $active_index = (\method_exists($excel, 'getActiveSheetIndex') && $excel->getActiveSheetIndex()) ? $excel->getActiveSheetIndex() : 0;

        return $active_index;
    }

    private function sheetColumns()
    {
        return [
            0 => 'A',
            1 => 'B',
            2 => 'C',
            3 => 'D',
            4 => 'E',
            5 => 'F',
            6 => 'G',
            7 => 'H',
            8 => 'I',
            9 => 'J',
            10 => 'K',
            11 => 'L',
            12 => 'M',
            13 => 'N',
            14 => 'O',
            15 => 'P',
            16 => 'Q',
            17 => 'R',
            18 => 'S',
            19 => 'T',
            20 => 'U',
            21 => 'V',
            22 => 'W',
            23 => 'X',
            24 => 'Y',
            25 => 'Z',
        ];
    }

    /**
     * Get absolute path where the file will be saved after being exported
     *
     * @param \Crazymeeks\PHPExcel\Contracts\ExcelInterface $excel
     * 
     * @return string
     */
    public function getPath(ExcelInterface $excel): string
    {
        return rtrim($excel->getPath(), '/') . '/';
    }

    /**
     * Get filename of exported file
     *
     * @return string
     */
    public function getFileName(): string
    {
        return $this->filename;
    }

    /**
     * Header content type for download
     * This method must be override by subclasses
     * 
     * @return string
     */
    protected function contentType()
    {
        throw new \Exception(sprintf("The class %s does not implement contentType() method.", \get_class($this)));
    }
}