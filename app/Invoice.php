<?php

namespace AFG;

use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tracking_id', 'scope', 'invoice', 'fees', 'holdback', 'disbursements', 'taxRate_id'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tracking()
    {
        return $this->belongsTo(Tracking::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function taxRates()
    {
        return $this->belongsTo(TaxRate::class);
    }


}
