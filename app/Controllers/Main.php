<?php

namespace App\Controllers;

use App\Models\MainModel;

class Main extends BaseController
{
    public function index()
    {
      $model = model(MainModel::class);
      if (isset($_POST['filter'])){
        $slug = $_POST['filter'];

        $data = [ 'products' => $model->filterProducts($slug),
                  'title' => 'Tihon\'s shop',
                ];

          echo view('main/index', $data);
          die();
      }else{
          $data = [ 'products' => $model->AllProducts(),
                    'categories' => $model->AllCategories(),
                    'title' => 'Tihon\'s shop',
                  ];

        echo view('layouts/header', $data);
        echo view('main/index', $data);
        echo view('layouts/footer');
      }
    }

}
