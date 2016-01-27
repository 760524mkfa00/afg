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


    public function getProjects(array $params)
    {

        if(!$this->isSortable($params))
        {
            $params['sortBy'] = 'afgs.ID';
            $params['disrection'] = 'desc';
        }

        $q = $params['str'];
        $year = $params['year'];



        return \DB::table('afgs')
            ->leftjoin('categories', function ($join) {
                $join->on('afgs.category_id', '=', 'categories.id');
            })
            ->leftjoin('priorities', function ($join) {
                $join->on('afgs.priority_id', '=', 'priorities.id');
            })
            ->leftjoin('locations', function ($join) {
                $join->on('afgs.location_id', '=', 'locations.id');
            })
            ->leftjoin('regions', function ($join) {
                $join->on('afgs.region_id', '=', 'regions.id');
            })
            ->leftjoin('clients', function ($join) {
                $join->on('afgs.client_id', '=', 'clients.id');
            })
            ->leftjoin('users', function ($join) {
                $join->on('afgs.manager_id', '=', 'users.id');
            })
            ->select('afgs.ID','category', 'priority', 'location', 'region', 'year', 'name', 'project_number', 'project_description', 'estimate', 'client', 'priority_number')
            ->where(function($query) use ($q) {
                if (!empty($q)) {
                    $query->where('project_description', 'LIKE', "%$q%");
                }
            })
            ->where(function($query) use ($year) {
                if (!empty($year) && is_numeric($year)) {
                    $query->where('year', '=', $year);
                }
            })
            ->orderBy($params['sortBy'], $params['direction'])
            ->paginate(18);
    }

    protected function isSortable(array $params)
    {
        return $params['sortBy'] and $params['direction'];
    }
}