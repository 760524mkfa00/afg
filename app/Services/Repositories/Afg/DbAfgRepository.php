<?php

namespace AFG\Services\Repositories\Afg;

use AFG\Afg;
use AFG\Services\Repositories\DbRepository;


/**
 * Class DbFieldtripRepository
 * @package AFG\Services\Repositories\Afg
 */
class DbAfgRepository extends DbRepository implements AfgRepository {

    /**
     * @var Zone
     */
    protected $model;

    /**
     * @param Afg $model
     */
    function __construct(Afg $model)
    {
        $this->model = $model;
    }


    public function getProjects()
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
            ->leftjoin('locations', function($join)
            {
                $join->on('afgs.location_id', '=', 'locations.id');
            })
            ->leftjoin('regions', function($join)
            {
                $join->on('afgs.region_id', '=', 'regions.id');
            })
            ->leftjoin('clients', function($join)
            {
                $join->on('afgs.client_id', '=', 'clients.id');
            })
            ->leftjoin('users', function($join)
            {
                $join->on('afgs.manager_id', '=', 'users.id');
            })
            ->select('category', 'priority', 'location', 'region', 'year', 'name', 'project_number', 'project_description', 'estimate', 'client', 'priority_number')
            ->paginate(20);

        return $query;

    }

}