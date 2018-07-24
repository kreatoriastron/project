<?php
/**
 * Created by PhpStorm.
 * User: RUBEN
 * Date: 2018-06-18
 * Time: 11:07
 */

namespace AppBundle\Service\SpreadSheet;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\XlS;
use PhpOffice\PhpSpreadsheet\IOFactory;

class SpreadSheetService
{
    const SEPERATOR = '/';
    const START_ROW = 10;
    private $file;
    private $dir;
    private $sheetData;
    private $resultData;

    public function __construct()
    {

    }

    public function setFile($file)
    {
        $this->file =  $file;
    }

    public function setDir($dir)
    {
        $this->dir =  'upload/' . $dir;
    }

    public function readXLS()
    {
        $path = $this->dir . SpreadSheetService::SEPERATOR . $this->file;
        $spreadsheet = IOFactory::load($path);
        $this->sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
        $rowsCount = count($this->sheetData);

        for($x=SpreadSheetService::START_ROW; $x<=$rowsCount; $x++)
        {
                $this->resultData[] = array(
                    'rspo' => $this->sheetData[$x]['B'],
                    'wojewodztwo' => $this->sheetData[$x]['C'],
                    'powiat' => $this->sheetData[$x]['D'],
                    'gmina' => $this->sheetData[$x]['E'],
                    'city' => $this->sheetData[$x]['F'],
                    'type' => $this->sheetData[$x]['H'],
                    'name' => $this->sheetData[$x]['J'],
                    'address' => $this->sheetData[$x]['L'] . ' ' . $this->sheetData[$x]['M'],
                    'zip-code' => $this->sheetData[$x]['N'],
                    'post' => $this->sheetData[$x]['O'],
                    'phone' => $this->sheetData[$x]['P'],
                    'www' => $this->sheetData[$x]['R'],
                    'publicznosc' => $this->sheetData[$x]['S'],
                    'student_count' => $this->sheetData[$x]['AI'],
                    'class_count' => $this->sheetData[$x]['AM'],
                );
        }

        return $this->resultData;
    }

}