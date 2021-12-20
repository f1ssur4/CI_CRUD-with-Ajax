<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<div class="contentet">
<table class="table" style="margin-top: 10px">
  <thead>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Title</th>
    <th scope="col">Price</th>
    <th scope="col">Category</th>
    <th scope="col">Status</th>
    <th scope="col">Date</th>
  </tr>
  </thead>
  <tbody>
  <tr>
    <td><b style="animation-direction: alternate">Create new product</b></td>
    <td><input type="text" style="width: 130px; height: 35px; border-radius: 4px; border-color: white; border-style: hidden" class="title" placeholder="title" name="title"></td>
    <td><input type="text" style="width: 240px; height: 35px; border-radius: 4px; border-color: white; border-style: hidden" class="price" placeholder="price" name="price"></td>
    <td><input type="text" style="width: 150px; height: 35px; border-radius: 4px; border-color: white; border-style: hidden" class="category_title" placeholder="category" name="category_title"></td>
    <td><input type="text" class="status" placeholder="status" name="status"></td>
    <td><?php echo date('Y:m:d')?></td>
    <td><button class="button323" style="color: aquamarine; background-color: #E06E3F; border-radius: 7px">Create</button></td>
  </tr>
  <?php $cl = 1?>
  <?php foreach ($products as $product) : ?>
  <tr class="content">
    <th scope="row"><?php echo $product->id?></th>
    <td><input class="title_t" value="<?php echo $product->title?>"></td>
    <td><input class="price_t" value="<?php echo $product->price?>"></td>
    <td><input class="category_id_t" value="<?php echo $product->category_title?>"></td>
    <td><div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
          <?php echo $product->status?>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
          <li><button class="button333" value="<?php if ($product->status == 'Есть в наличии'){
              echo 'Нет в наличии' . "-$product->id";
            }else{
              echo 'Есть в наличии' . "-$product->id";
            } ?>" type="submit" onclick="function()"><?php if ($product->status == 'Есть в наличии'){
            echo 'Нет в наличии';
              }else{
            echo 'Есть в наличии';
              } ?></button></li>
        </ul>
      </div></td>
    <td><input class="somes" value="<?php echo $product->date?>"></td>

    <td><button class="button334" value="<?php echo $product->id?>" type="submit" onclick="function()">delete</button></td>
  </tr>
  <?php $cl++?>
  <?php endforeach; ?>
  </tbody>
</table>
</div>


<script>
  $(document).ready(function(){
    $('.button333').click(function(){
        let statusVal = $(this).val();

        $.ajax({
          type: 'POST',
          url: '/admin/update',
          dataType: 'text',
          data: {status : statusVal},
          success: function(response){
            $('.contentet').html(response);
          }
        });
      }
    )});

</script>

<script>
  $(document).ready(function(){
    $('.button334').click(function(){
        let deleteVal = $(this).val();

        $.ajax({
          type: 'POST',
          url: '/admin/delete',
          dataType: 'text',
          data: {delete : deleteVal},
          success: function(response){
            $('.contentet').html(response);
          }
        });
      }
    )});

</script>

<script>
  $(document).ready(function (){
    $('.button323').click(function() {
      let titleVal = $('input.title').val();
      let priceVal = $('input.price').val();
      let categoryVal = $('input.category_title').val();
      let statusVal = $('input.status').val();

      $.ajax({
        type: 'POST',
        url: '/admin/create',
        data: {title: titleVal, price: priceVal, category_title: categoryVal, status: statusVal},
        success: function (response) {
          $('.contentet').html(response);
        }
      })
    });
  });
</script>
