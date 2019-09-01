<?php
require __DIR__ . '/vendor/autoload.php';
use Crazymeeks\PHPExcel\Xls;

class Excel5Export implements \Crazymeeks\PHPExcel\Contracts\ExcelInterface
{


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

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST">
        <input type="submit" name="Download" value="Download">
    </form>

    <?php
    if (isset($_POST['Download'])) {
        
        $xls = new Xls();
        $excel5 = new Excel5Export();
        $xls->download($excel5);

    }
    
    ?>
</body>
</html>