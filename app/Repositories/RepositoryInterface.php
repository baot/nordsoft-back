<?php namespace App\Repositories;

interface RepositoryInterface {
  public function all($columns = array('*'));
  public function create(array $data);
  public function update(array $data, $id);
  public function delete($id);
  public function findById($id, $columns = array('*'));
  public function findBy($field, $value, $column = array('*'));
}
