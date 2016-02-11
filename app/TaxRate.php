<?php

namespace AFG;

use Illuminate\Database\Eloquent\Model;

class TaxRate extends Model
{

    protected $table = "taxrates";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rate'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
