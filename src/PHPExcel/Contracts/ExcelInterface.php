<?php declare(strict_types=1);

namespace Crazymeeks\PHPExcel\Contracts;

interface ExcelInterface
{



    /**
     * Data that will be exported
     *
     * @return array
     */
    public function dataToExport();

    /**
     * Get file type
     *
     * @return string
     */
    public function getType();

    /**
     * Get the column header for the file
     *
     * @return array
     */
    public function getHeader();

    /**
     * Get filename of the spreadsheet.
     *
     * @return string
     */
    public function getFilename();

    /**
     * Location where the file should be save
     * after exported
     *
     * @return string
     */
    public function getPath();

}