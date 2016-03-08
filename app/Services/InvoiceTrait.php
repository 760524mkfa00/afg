<?php

namespace AFG\Services;

trait InvoiceTrait {

    public function fees($invoice)
    {
        return $invoice->fees;
    }

    public function holdback($invoice)
    {
        return ($invoice->holdback > 0) ? $invoice->fees * 0.1 : 0;
    }

    public function total($invoice)
    {
        return (($invoice->fees - (($invoice->holdback > 0) ? $invoice->fees * 0.1 : 0)) * (1 + ($invoice->taxRates->rate / 100)));
    }

    public function owing($invoice)
    {
        return (($invoice->holdback > 0) ? $invoice->fees * 0.1 : 0) * (1 + ($invoice->taxRates->rate / 100));
    }

    public function invoiceTotal($invoice)
    {
        return $invoice->fees * (1 + ($invoice->taxRates->rate / 100));
    }

}
