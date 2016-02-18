<?php

namespace AFG\Services\Tasks;

use AFG\Services\Repositories\Tracking\TrackingRepository;


/**
 * Class trackingTasks
 * @package AFG\Services\Tasks
 */
class trackingTasks
{

    protected $tracking;

    public function __construct(TrackingRepository $tracking)
    {
        $this->tracking = $tracking;
    }

    public function invoiceTotals($id)
    {
        $data = $this->tracking->trackingInvoice($id);

        foreach($data->invoices as $invoice)
        {
            $data['fees'] += $invoice->fees;
            $data['holdback'] += ($invoice->holdback > 0) ? $invoice->fees * 0.1 : 0;
            $data['total'] += (($invoice->fees - (($invoice->holdback > 0) ? $invoice->fees * 0.1 : 0)) * (1 + ($invoice->taxRates->rate / 100)));
            $data['owing'] += (($invoice->holdback > 0) ? $invoice->fees * 0.1 : 0) * (1 + ($invoice->taxRates->rate / 100));
        }
        $data['subtotal'] = $data['fees'] - $data['holdback'];

        return $data;
    }


}