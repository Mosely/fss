<?php
namespace FSS\Utilities;

use Interop\Container\ContainerInterface;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Shared\StringHelper;
use PhpOffice\PhpSpreadsheet\Writer\Csv;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ReportGenerator {
    private $container;
    private $savePointer;
    private $reportPath;
    private $reportType;
    private $reportTitle;
    private $dataCollection;
    private $headerRow = [];
    private $body      = [];
    
    public function __construct(ContainerInterface $c, 
        string $reportPath, 
        string $reportTitle, 
        string $reportType = 'csv') {
        
        StringHelper::setDecimalSeparator('.');
        StringHelper::setThousandsSeparator(',');
        $this->container   = $c;
        $this->reportPath  = $reportPath;
        $this->reportTitle = $reportTitle;
        $this->reportType  = $reportType;
        $this->Initialize();
    }
    
    private function Initialize() {
        $this->dataCollection = new Spreadsheet();
        $this->dataCollection
            ->getProperties()
                ->setCreator($this->container["jwtToken"]->sub)
                ->setLastModifiedBy($this->container["jwtToken"]->sub)
                ->setTitle($this->reportTitle)
                ->setSubject($this->reportTitle)
                ->setDescription(
                    $this->reportTitle + ", generated for use by FSS."
                    )
                ->setKeywords("fss")
                ->setCategory("FSS report file");
        switch($this->reportType) {
            case 'csv':
                $this->InitCsv();
                break;
            case 'excel':
                $this->InitExcel();
                break;
        }
    }
    
    private function InitCsv() {
        $this->savePointer = function() {
            $arrayData = [];
            $arrayData[] = $this->header;
            for($i = 0; i < count($this->body); $i++) {
                $arrayData[] = $this->body[$i];
            }
            $this->dataCollection->getActiveSheet()
                ->fromArray($arrayData, NULL, 'A1');
            $writer = new Csv($this->dataCollection);
            $writer->setDelimiter(',');
            $writer->setEnclosure('"');
            $writer->setLineEnding("\r\n");
            $writer->setSheetIndex(0);
            $writer->save($this->reportPath);
            $this->dataCollection->disconnectWorksheets();
            unset($this->dataCollection);
        };
    }
    
    private function InitExcel() {
        $this->savePointer = function() {
            $arrayData = [];
            $arrayData[] = $this->header;
            for($i = 0; i < count($this->body); $i++) {
                $arrayData[] = $this->body[$i];
            }
            $this->dataCollection->getActiveSheet()
                ->fromArray($arrayData, NULL, 'A1');
            $writer = new Xlsx($this->dataCollection);
            $writer->save($this->reportPath);
            $this->dataCollection->disconnectWorksheets();
            unset($this->dataCollection);
        };
    }
    
    public function SetHeader(array $headerRow) {
        $this->headerRow = $headerRow;
    }
    
    public function AddRow(array $row) {
        $this->body[] = $row;
    }
    
    public function Save() {
        $this->savePointer();
    }
}
