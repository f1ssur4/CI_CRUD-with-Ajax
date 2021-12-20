<?php

namespace App\Models;


use CodeIgniter\Model;

class AdminModel extends Model
{
  public function AllProducts()
  {
    $builder = $this->tableJoin();
    $builder->orderBy('status');
    $query = $builder->get();

    return $this->getProducts($query);
  }

  public function insertNewProduct($newProduct)
  {
    $db = \Config\Database::connect();
    $sql = "INSERT INTO product (title, price, category_id, status, date) VALUES (".$db->escape($newProduct['title']).", ".$db->escape($newProduct['price']).", ".$db->escape($newProduct['category_title']).", ".$db->escape($newProduct['status']).", ".$db->escape($newProduct['date']).")";
    $db->query($sql);
  }

  public function updateProduct($newStatus)
  {
    $db = \Config\Database::connect();
    $sql = "UPDATE product SET status=".$db->escape($newStatus['status'])." WHERE id=".$db->escape($newStatus['id']);
    $db->query($sql);
  }

  public function deleteProduct($delete)
  {
    $db = \Config\Database::connect();
    $sql = "DELETE FROM product WHERE id=".$db->escape($delete);
    $db->query($sql);
  }


  public function filterProducts($slug)
  {
    $builder = $this->tableJoin();
    $builder->where('category_title', $slug);
    $query = $builder->get();

    return $this->getProducts($query);
  }

  public function AllCategories()
  {
    $db = \Config\Database::connect();
    $stmt = $db->query('SELECT * FROM category');
    return $stmt->getResult();
  }

  public function createCategory($newCategory)
  {

    $db = \Config\Database::connect();
    $sql = "INSERT INTO category (category_title) VALUES (".$db->escape($newCategory).")";
    $db->query($sql);
  }

  public function deleteCategory($delete)
  {
    $db = \Config\Database::connect();
    $sql = "DELETE FROM category WHERE id=".$db->escape($delete);
    $db->query($sql);
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
