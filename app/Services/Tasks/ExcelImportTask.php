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
        $this->file = $file;
    }

    protected function match()
    {
        $sheet = $this->excel->load($this->file)->toArray();
        $invoice = $this->invoice->all()->toArray();

        foreach($sheet as $row)
        {
            $rows[] = (int)$row['woid'];
        }

        foreach($invoice as $inv)
        {
            $invoices[] = $inv['invoice'];
        }

        return array_intersect($rows, $invoices);
    }

    public function attach()
    {
        $match = $this->match();
        $sheet = $this->excel->load($this->file)->toArray();

        foreach($sheet as $row)
        {
            if (in_array((int)$row['woid'], $match))
            {
                $matched = true;
            }
            else
            {
                $matched = false;
            }
            $collection[] = collect(['woid' => $row['woid'], 'description' => $row['description'], 'total_costs' => $row['total_costs'], 'match' => $matched]);
        }

    return $collection;

    }

}