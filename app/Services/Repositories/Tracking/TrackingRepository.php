<?php

namespace AFG\Services\Repositories\Tracking;


interface TrackingRepository {

    public function getById($id);
    public function getAll();
    public function create($data);
    public function update($id, $data);
    public function remove($id);
    public function trackingInvoice($id);
}