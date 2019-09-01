<?php declare(strict_types=1);

namespace Crazymeeks\PHPExcel\Exceptions;


class ExportDataFormatInvalidException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }


    public static function notArray($class)
    {
        return new static(sprintf("%s's dataToExport() method expected return multi-dimensional  array.", $class));
    }

    public function notMultiArray($class)
    {
        return new static(sprintf("%s's dataToExport() method expected return multi-dimensional array or object.", $class));
    }
}