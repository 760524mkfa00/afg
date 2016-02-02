<?php

namespace AFG;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'priority'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function afgs()
    {
        return $this->hasMany(Afg::class);
    }

    public function listPriorities()
    {
        return array('' => ' ') + Priority::lists('priority','id')->toArray();
    }
}
