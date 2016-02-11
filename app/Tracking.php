<?php

namespace AFG;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{

    protected $table = 'tracking';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'afg_id', 'description', 'cvs'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function afgs()
    {
        return $this->belongsTo(Agf::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

}
