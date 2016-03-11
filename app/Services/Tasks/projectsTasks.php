<?php

namespace AFG\Services\Tasks;

use AFG\Services\InvoiceTrait;
use AFG\Services\Repositories\Afg\AfgRepository;


/**
 * Class projectsTask
 * @package AFG\Services\Tasks
 */
class projectsTasks
{

    use InvoiceTrait;

    protected $project;

    protected $balanceData;

    protected $balanceTotal;

    public function __construct(AfgRepository $project)
    {
        $this->project = $project;
    }

    public function sortData($request)
    {

        $sortBy = $request->input('sortBy');
        $direction = $request->input('direction');
        $str = $request->input('str');
        $year = $request->input('year');

        return $this->project->getProjects(compact('sortBy', 'direction', 'str', 'year'));
    }

    public function calculateTotals()
    {
        $data = $this->project->projectTracking();

        foreach($data as $item)
        {

            $invoiceTotal = 0;

            foreach($item->tracking as $track)
            {
                $invoiceTotal += $this->totalInvoices($track);
            }

            $total[$item->id]['total'] = $invoiceTotal;

        }
        return $total;
    }

    protected function totalInvoices($data, $total = null)
    {
        foreach($data->invoices as $invoice)
        {
            $total += $this->invoiceTotal($invoice);
        }
        return $total;
    }


    public function allData($id)
    {
        $this->balanceData = $this->project->projectAll($id);

        $this->balanceTotals();
        $this->committed();
        $this->surplus();

        $total['data'] = $this->getBalanceData();
        $total['total'] = $this->getBalanceTotal();

        return $total;
    }

    public function getBalanceData()
    {
        return $this->balanceData;
    }

    public function getBalanceTotal()
    {
        return $this->balanceTotal;
    }

   protected function balanceTotals()
   {
       foreach($this->balanceData->tracking as $track)
       {
           $total[$track->id]['fees'] = 0;
           $total[$track->id]['additional'] = 0;
           $total[$track->id]['total'] = 0;

           foreach($track->invoices as $invoice)
           {
               ($this->hasAdditional($invoice)) ? $total[$invoice->tracking_id]['additional'] += $this->fees($invoice) :
                        $total[$invoice->tracking_id]['fees'] += $this->fees($invoice);

               $total[$invoice->tracking_id]['total'] += $this->invoiceTotal($invoice);
           }
       }

       $this->balanceTotal = $total;
   }

    protected function hasAdditional($invoice)
    {
        return $invoice->additional;
    }

    protected function committed()
    {
        $this->balanceData['committed'] = array_sum(array_column($this->balanceTotal, 'total'));
    }

    protected function surplus()
    {
        $this->balanceData['surplus'] = $this->balanceData->estimate - $this->balanceData->committed;
    }

}