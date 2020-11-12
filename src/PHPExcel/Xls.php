<?php declare(strict_types=1);

namespace PHPExcel;

use PHPExcel\Factory\SheetFactory;
use PHPExcel\Contracts\ExcelInterface;

class Xls
{

    /**
     * @var  PHPExcel\Factory\SheetFactory
     */
    protected $factory;

    /**
     * Constructor
     *
     * @param \PHPExcel\Factory\SheetFactory $factory
     */
    public function __construct(SheetFactory $factory = null)
    {
        $this->factory = $factory ?? new SheetFactory();
    }

    /**
     * Export data
     *
     * @param \PHPExcel\Contracts\ExcelInterface $excel
     * 
     * @return void
     */
    public function export(ExcelInterface $excel, $action = 'export')
    {
        
        $spreadsheet = $this->factory->make($excel->getType());

        $spreadsheet->{$action}($excel);
    }

    /**
     * Trigger a browser download
     *
     * @return void
     */
    public function download(ExcelInterface $excel)
    {
        $this->export($excel, 'download');
    }

}