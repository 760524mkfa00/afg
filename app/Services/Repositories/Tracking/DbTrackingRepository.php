<?php

namespace AFG\Services\Repositories\Tracking;

use AFG\Tracking;
use AFG\Services\Repositories\DbRepository;


/**
 * Class DbTrackingRepository
 * @package AFG\Services\Repositories\Tracking
 */
class DbTrackingRepository extends DbRepository implements TrackingRepository {

    /**
     * @var Zone
     */
    protected $model;

    /**
     * @param Tracking $model
     */
    function __construct(Tracking $model)
    {
        $this->model = $model;
    }

    public function trackingInvoice($id)
    {
        return Tracking::with('invoices', 'invoices.taxRates')->find($id);
    }


}