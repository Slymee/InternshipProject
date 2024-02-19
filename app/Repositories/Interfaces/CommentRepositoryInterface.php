<?php

namespace App\Repositories\Interfaces;

Interface CommentRepositoryInterface{
    public function all();
    public  function store($data);

}
