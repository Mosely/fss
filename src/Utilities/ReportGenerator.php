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
        string $reportType = 'CSV') {
        
        StringHelper::setDecimalSeparator('.');
        StringHelper::setThousandsSeparator(',');
        $this->container   = $c;
        $this->reportPath  = $reportPath;
        $this->reportTitle = $reportTitle;
        $this->reportType  = $reportType;
        $this->initialize();
    }
    
    private function initialize() {
        $this->dataCollection = new Spreadsheet();
        $this->dataCollection
            ->getProperties()
                ->setCreator($this->container["jwtToken"]->sub)
                ->setLastModifiedBy($this->container["jwtToken"]->sub)
                ->setTitle($this->reportTitle)
                ->setSubject($this->reportTitle)
                ->setDescription(
                    $this->reportTitle . ", generated for use by FSS."
                    )
                ->setKeywords("fss")
                ->setCategory("FSS report file");
        switch($this->reportType) {
            case 'CSV':
                $this->initCsv();
                break;
            case 'EXCEL':
                $this->initExcel();
                break;
        }
    }
    
    private function initCsv() {
        $this->savePointer = function() {
            $arrayData = [];
            $arrayData[] = $this->header;
            for($i = 0; $i < count($this->body); $i++) {
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
    
    private function initExcel() {
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
    
    public function setHeader(array $headerRow) {
        $this->headerRow = $headerRow;
    }
    
    public function addRow(array $row) {
        $this->body[] = $row;
    }
    
    public function save() {
        call_user_func(array($this, "savePointer"));
    }
}
