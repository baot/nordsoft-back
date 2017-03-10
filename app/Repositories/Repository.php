<?php namespace App\Repositories;

use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;

abstract class Repository implements RepositoryInterface {

  private $container;

  protected $model;

  public function __construct(Container $container) {
    $this->container = $container;
    $this->makeModel();
  }

  abstract function model();

  public function makeModel() {
    $model = $this->container->make($this->model());

    if (!$model instanceof Model) {
      throw new RepositoryException("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
    }

    return $this->model = $model->newQuery();
  }

  public function all($columns = array('*')) {
    return $this->model->get($columns);
  }

  public function create(array $data) {
    return $this->model->create($data);
  }

  public function findById($id, $columns = array('*')) {
    return $this->model->find($id, $columns);
  }

  public function findBy($attribute, $value, $columns = array('*')) {
    return $this->model->where($attribute, '=', $value)->first($columns);
  }

  public function update(array $data, $id, $attribute="id") {
    return $this->model->where($attribute, '=', $id)->update($data);
  }

  public function delete($id) {
    return $this->model->delete($id);
  }
}
