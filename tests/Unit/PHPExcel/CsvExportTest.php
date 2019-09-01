<?php

namespace Tests\Unit\PHPExcel;

use Tests\TestCase;
use Crazymeeks\PHPExcel\Xls;

/**
 * @covers Crazymeeks\PHPExcel\Xls
 */
class CsvExportTest extends TestCase
{
    
    /**
     * @test
     * @group unit_positive
     */
    public function it_should_export_data_to_csv()
    {

        $xls = new Xls();
        $csv = new CsvExport();
        
        // If developers wants to download file directly on the browser replace
        // export() with download(). i.e $xls->download($excel5);
        $xls->export($csv);
    
        $exported_file = __DIR__ . '/' . $csv->getFilename() . '.csv';
        $file_exist = file_exists($exported_file);
        $this->assertTrue($file_exist);

        @unlink($exported_file);
    }
}

/**
 * Class written by developer that implements \Crazymeeks\PHPExcel\Contracts\ExcelInterface
 * this conforms to Open/Close of SOLID principles
 */
class CsvExport implements \Crazymeeks\PHPExcel\Contracts\ExcelInterface
{


    /**
     * @inheritDoc
     */
    public function dataToExport()
    {

        return [
            [
                '1', 'Doe', 'John'
            ]
        ];

    }


    /**
     * @inheritDoc
     */
    public function getHeader()
    {
        return [
            'id',
            'lastname',
            'firstname'
        ];
    }
    
    /**
     * @inheritDoc
     */
    public function getType()
    {
        return 'csv';
    }

    /**
     * @inheritDoc
     */
    public function getFilename()
    {
        return 'my-csv-filename';
    }

    /**
     * @inheritDoc
     */
    public function getPath()
    {
        return __DIR__;
    }

}