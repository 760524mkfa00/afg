<?php

namespace AFG\Services\Repositories\Afg;


interface AfgRepository {

    public function getById($id);
    public function getAll();
    public function create($data);
    public function update($id, $data);
    public function remove($id);
    public function getProjects();
}