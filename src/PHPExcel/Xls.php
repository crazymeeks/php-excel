<?php declare(strict_types=1);

namespace Crazymeeks\PHPExcel;

use Crazymeeks\PHPExcel\Factory\SheetFactory;
use Crazymeeks\PHPExcel\Contracts\ExcelInterface;

class Xls
{

    /**
     * @var  PHPExcel\Factory\SheetFactory
     */
    protected $factory;

    /**
     * Constructor
     *
     * @param \Crazymeeks\PHPExcel\Factory\SheetFactory $factory
     */
    public function __construct(SheetFactory $factory = null)
    {
        $this->factory = $factory ?? new SheetFactory();
    }

    /**
     * Export data
     *
     * @param \Crazymeeks\PHPExcel\Contracts\ExcelInterface $excel
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