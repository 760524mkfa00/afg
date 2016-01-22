<?php

namespace AFG;

use Illuminate\Database\Eloquent\Model;

class Afg extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_number', 'region_id', 'category_id', 'location_id', 'project_description', 'client_id', 'priority_number', 'priority_id', 'year', 'estimate'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function categories()
    {
        return $this->belongsTo('AFG\Category', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function clients()
    {
        return $this->belongsTo('AFG\Client', 'client_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function locations()
    {
        return $this->belongsTo('AFG\Location', 'location_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function priorities()
    {
        return $this->belongsTo('AFG\Priority', 'priority_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function regions()
    {
        return $this->belongsTo('AFG\Region', 'region_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function managers()
    {
        return $this->belongsTo('AFG\User', 'manager_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tracking()
    {
        return $this->hasMany(Tracking::class);
    }

    public static function groupYear()
    {

        $query = \DB::table('afgs')
            ->leftjoin('priorities', function($join)
            {
                $join->on('afgs.priority_id', '=', 'priorities.id');
            })
            ->select('priority', 'year', 'priority_id', \DB::raw('sum(estimate) as subTotal'))
            ->groupBy('year')
            ->groupBy('priority_id')
            ->orderBy('year', 'asc')
            ->orderBy('priority_id', 'asc')
        ->get();

        return $query;

    }

    public static function chart()
    {
        $query = \DB::table('afgs')
            ->leftjoin('priorities', function($join)
            {
                $join->on('afgs.priority_id', '=', 'priorities.id');
            })
            ->select('priority', 'year', \DB::raw('sum(estimate) as subTotal'))
            ->where('year', '=', '2016')
            ->groupBy('year')
            ->groupBy('priority_id')
            ->orderBy('year', 'asc')
            ->orderBy('priority_id', 'asc')
            ->get();

        return $query;
    }

    public static function categoriesChart($years, $priority)
    {


        $query = \DB::table('afgs')
            ->leftjoin('categories', function($join)
            {
                $join->on('afgs.category_id', '=', 'categories.id');
            })
            ->leftjoin('priorities', function($join)
            {
                $join->on('afgs.priority_id', '=', 'priorities.id');
            })
            ->select('category', 'priority', 'year', \DB::raw('sum(estimate) as subTotal'))
            ->whereIn('year', $years)
            ->whereIn('priority', $priority)
            ->groupBy('category_id')
            ->orderBy('category_id', 'asc')
            ->get();

        return $query;
    }
}
