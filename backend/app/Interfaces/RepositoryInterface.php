<?php

namespace App\Interfaces;

interface RepositoryInterface
{
    public function index(array $data);
    public function getById($id);
    public function store(array $data);
    public function update(array $data,$id);
    public function delete($id);
}
