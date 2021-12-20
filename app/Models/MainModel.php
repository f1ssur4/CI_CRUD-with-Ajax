<?php

namespace App\Models;

use CodeIgniter\Model;

class MainModel extends Model
{

  public function AllProducts()
  {
    $builder = $this->tableJoin();
    $builder->orderBy('status');
    $query = $builder->get();

    return $this->getProducts($query);
  }

/*
 * Добавил функцию AllCategories сюда, т.к.
 * не хотел создавать отдельную модель ради одной функции.
 */
  public function AllCategories()
  {
    $db = \Config\Database::connect();

    $stmt = $db->query('SELECT * FROM category');
    return $stmt->getResult();
  }


  public function filterProducts($slug)
  {
    $builder = $this->tableJoin();
    $builder->where('category_title', $slug);
    $query = $builder->get();

    return $this->getProducts($query);
  }


  public function tableJoin()
  {
    $db = \Config\Database::connect();

    $builder = $db->table('product');

    $builder->select('product.id, product.title, product.price, product.status, product.date, category.category_title');
    $builder->join('category', 'category.id = product.category_id', 'left');
    return $builder;
  }


  public function getProducts($query)
  {
    return $query->getResult();
  }
}
