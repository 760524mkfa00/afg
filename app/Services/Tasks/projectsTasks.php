<?php

namespace AFG\Services\Tasks;

use AFG\Services\Repositories\Afg\AfgRepository;


/**
 * Class projectsTask
 * @package AFG\Services\Tasks
 */
class projectsTasks
{

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
            $total[$item->id]['total'] = compact(0);
            $invoiceTotal = 0;
            foreach($item->tracking as $track)
            {
                $invoiceTotal += $this->totalInvoices($track);
            }
            $total[$item->id]['total'] = $invoiceTotal;
        }
        return $total;
    }

    protected function totalInvoices($data)
    {
        $total = 0;
        foreach($data->invoices as $invoice)
        {
            $total += $invoice->fees * (1 + ($invoice->taxRates->rate / 100));
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
       $total = [];
       foreach($this->balanceData->tracking as $track)
       {
           $total['fees'] = 0;
           $total['additional'] = 0;
           $total['total'] = 0;

           foreach($track->invoices as $invoice)
           {
               if($invoice->additional)
               {
                   $total['additional'] += $invoice->fees;
               } else {
                   $total['fees'] += $invoice->fees;
               }
               $total['total'] += $invoice->fees * (1 + ($invoice->taxRates->rate / 100));
           }

           $total[$track->id]['fees'] = $total['fees'];
           $total[$track->id]['additional'] = $total['additional'];
           $total[$track->id]['total'] = $total['total'];
       }

       $this->balanceTotal = $total;
   }

    protected function committed()
    {
        foreach($this->balanceTotal as $commit)
        {
            $this->balanceData['committed'] += $commit['total'];
        }
    }

    protected function surplus()
    {
        $this->balanceData['surplus'] = $this->balanceData->estimate - $this->balanceData->committed;
    }
}