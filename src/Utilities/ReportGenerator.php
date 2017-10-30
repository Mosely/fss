<?php
namespace FSS\Utilities;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportGenerator
{

    private $savePointer;

    private $reportPath;

    private $reportType;

    private $reportTitle;

    private $dataCollection;

    private $headerRow = [];

    private $body = [];

    private $jwtToken;

    public function __construct($jwtToken, string $reportPath,
        string $reportTitle, string $reportType = 'CSV')
    {
        StringHelper::setDecimalSeparator('.');
        StringHelper::setThousandsSeparator(',');
        $this->jwtToken = $jwtToken;
        $this->reportPath = $reportPath;
        $this->reportTitle = $reportTitle;
        $this->reportType = $reportType;
        $this->initialize();
    }

    private function initialize()
    {
        $this->dataCollection = new Spreadsheet();
        $this->dataCollection->getProperties()
            ->setCreator($this->jwtToken->sub)
            ->setLastModifiedBy($this->jwtToken->sub)
            ->setTitle($this->reportTitle)
            ->setSubject($this->reportTitle)
            ->setDescription($this->reportTitle . ", generated for use by FSS.")
            ->setKeywords("fss")
            ->setCategory("FSS report file");
        switch ($this->reportType) {
            case 'CSV':
                $this->initCsv();
                break;
            case 'EXCEL':
                $this->initExcel();
                break;
        }
    }

    private function initCsv()
    {
        $this->savePointer = function () {
            $arrayData = [];
            $arrayData[] = $this->headerRow;
            for ($i = 0; $i < count($this->body); $i ++) {
                $arrayData[] = $this->body[$i];
            }
            $this->dataCollection->getActiveSheet()->fromArray($arrayData, NULL,
                'A1');
            $writer = new Csv($this->dataCollection);
            $writer->setDelimiter(',');
            $writer->setEnclosure('"');
            $writer->setLineEnding("\r\n");
            $writer->setSheetIndex(0);
            $writer->save($this->reportPath);
            $this->dataCollection->disconnectWorksheets();
            unset($this->dataCollection);
            header('Content-Type: application/csv');
            header(
                'Content-Disposition: attachment; filename=' . $this->reportTitle .
                     '.csv');
            header('Pragma: no-cache');
        };
    }

    private function initExcel()
    {
        $this->savePointer = function () {
            $arrayData = [];
            $arrayData[] = $this->headerRow;
            for ($i = 0; i < count($this->body); $i ++) {
                $arrayData[] = $this->body[$i];
            }
            $this->dataCollection->getActiveSheet()->fromArray($arrayData, NULL,
                'A1');
            $writer = new Xlsx($this->dataCollection);
            $writer->save($this->reportPath);
            $this->dataCollection->disconnectWorksheets();
            unset($this->dataCollection);
            header('Content-type: application/vnd.ms-excel');
            header(
                'Content-Disposition: attachment; filename=' . $this->reportTitle .
                     '.xls');
        };
    }

    public function setHeader(array $headerRow)
    {
        $this->headerRow = $headerRow;
    }

    public function addRow(array $row)
    {
        $this->body[] = $row;
    }

    public function save()
    {
        ($this->savePointer)();
    }
}
