<?php

namespace AFG\Services\Tasks;

use AFG\Services\InvoiceTrait;
use AFG\Services\Repositories\Tracking\TrackingRepository;


/**
 * Class trackingTasks
 * @package AFG\Services\Tasks
 */
class trackingTasks
{
    use InvoiceTrait;

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
            $data['fees'] += $this->fees($invoice);
            $data['holdback'] += $this->holdback($invoice);
            $data['total'] += $this->total($invoice);
            $data['owing'] += $this->owing($invoice);
        }
        $data['subtotal'] = $data['fees'] - $data['holdback'];

        return $data;
    }

}