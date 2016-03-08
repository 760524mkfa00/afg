<?php
/**
 * Created by PhpStorm.
 * User: kieran.fahy
 * Date: 3/3/2016
 * Time: 8:20 AM
 */
namespace AFG\Services\Tasks;

use AFG\Invoice;
use Maatwebsite\Excel\Excel;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ExcelImportTask
{

    protected $file;

    protected $excel;

    protected $invoice;

    public function __construct(Excel $excel, Invoice $invoice)
    {
        $this->excel = $excel;

        $this->invoice = $invoice;

    }

    public function upload(UploadedFile $file)
    {
        $this->file = $this->excel->load($file)->toArray();
    }

    protected function match()
    {
        return array_intersect($this->woidIDArray(), $this->invoiceIDArray());
    }

    protected function woidIDArray()
    {
        return array_column($this->file, 'woid');
    }

    protected function invoiceIDArray()
    {
        return array_column($this->invoice->all()->toArray(), 'invoice');
    }


    public function attach()
    {

        foreach($this->file as $row)
        {
            $collection[] = collect(['woid' => $row['woid'], 'description' => $row['description'], 'total_costs' => $row['total_costs'], 'match' => $this->woidMatch((int)$row['woid'])]);
        }

    return $collection;

    }

    protected function woidMatch($woid)
    {
        $match = $this->match();
        return in_array($woid, $match);
    }

}