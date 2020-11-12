<?php

namespace Tests\Unit\PHPExcel;

use Tests\TestCase;
use PHPExcel\Xls;

/**
 * @covers PHPExcel\Xls
 */
class Excel5Test extends TestCase
{
    
    /**
     * @test
     * @group unit_positive
     */
    public function it_should_export_data_to_xls()
    {

        $xls = new Xls();

        $excel5 = new Excel5Export();

        // If developers wants to download file directly on the browser replace
        // export() with download(). i.e $xls->download($excel5);
        $xls->export($excel5);
    
        $exported_file = __DIR__ . '/' . $excel5->getFilename() . '.xls';
        $file_exist = file_exists($exported_file);
        $this->assertTrue($file_exist);

        @unlink($exported_file);
    }
    
}

/**
 * Class written by developer that implements \PHPExcel\Contracts\ExcelInterface
 * this conforms to Open/Close of SOLID principles
 */
class Excel5Export implements \PHPExcel\Contracts\ExcelInterface
{


    /**
     * Optional method: get the width that will be applied
     * to the column of the active sheet.
     *
     * @return array
     */
    public function getWith()
    {
        return [
            'A' => 20,
            'B' => 10
        ];
    }

    /**
     * Optional method: set active sheet index
     *
     * @return int
     */
    public function getActiveSheetIndex(): int
    {
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function dataToExport()
    {

        return [
            [
                '1001', 'Doe', 'John',
            ],
            [
                '1002', 'Doe', 'Jane'
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
        return 'xls';
    }

    /**
     * @inheritDoc
     */
    public function getFilename()
    {
        return 'my-xls-filename';
    }

    /**
     * @inheritDoc
     */
    public function getPath()
    {
        return __DIR__;
    }

}