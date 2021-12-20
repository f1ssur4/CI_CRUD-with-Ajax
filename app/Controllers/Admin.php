<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Admin extends BaseController
{

  public $model;

  public function __construct()
  {
    $this->model = model(AdminModel::class);
  }

  public function index()
  {
    $data = ['products' => $this->model->AllProducts(),
      'categories' => $this->model->AllCategories(),
      'title' => 'AdminPanel',
    ];
    echo view('layouts/header', $data);
    echo view('admin/index', $data);
    echo view('layouts/footer');
    die();
  }


  public function create()
  {
    $_POST['date'] = date('Y:m:d');
    $categories = $this->model->AllCategories();
    foreach ($categories as $category) {
      if ($_POST['category_title'] === $category->category_title){
        $_POST['category_title'] = $category->id;
        break;
      }
    }
    $datas = $_POST;
    $this->model->insertNewProduct($datas);
    $this->loaderIndex();
  }

  public function update()
  {
    $tmp = explode('-', $_POST['status']);
    $_POST['status'] = $tmp[0];
    $_POST['id'] = $tmp[1];
    $status = $_POST;
    $this->model->updateProduct($status);
    $this->loaderIndex();
  }

  public function delete()
  {
    $delete = $_POST['delete'];
    $this->model->deleteProduct($delete);
    $this->loaderIndex();

  }

  public function newCategory()
  {
    if (isset($_POST['category'])){
      $newCategory = $_POST['category'];
      $this->model->createCategory($newCategory);
      $this->loaderCategory();
    }
    $data = [
      'categories' => $this->model->AllCategories(),
      'title' => 'NewCategory',
    ];
    echo view('layouts/header', $data);
    echo view('admin/newcategory', $data);
    echo view('layouts/footer');
  }

  public function CategoryDelete()
  {
    $delete = $_POST['delete'];
    $this->model->deleteCategory($delete);
    $this->loaderCategory();
  }

  public function loaderIndex()
  {
    $data = ['products' => $this->model->AllProducts(),
      'categories' => $this->model->AllCategories(),
      'title' => 'AdminPanel',
    ];
    echo view('admin/index', $data);
    die();
  }

  public function loaderCategory()
  {
    $data = [
      'categories' => $this->model->AllCategories(),
      'title' => 'AdminPanel',
    ];
    echo view('admin/newcategory', $data);
    die();
  }
}
