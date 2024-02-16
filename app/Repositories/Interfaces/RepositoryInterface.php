<?php

namespace App\Repositories\Interfaces;

Interface RepositoryInterface{
    public function all();
    public function getById($id);
    public function delete($id);

}
