<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<?php if (isset($categories)): ?>
<div class="container" style="margin-left: 18%; margin-top: 3%">
    <?php foreach ($categories as $category) : ?>
  <input class="button322" value="<?php echo $category->category_title?>" type="submit" onclick="function()">
  <?php endforeach;?>
 </div>
<?php endif;?>
<div class="content" style="display: flex; flex-wrap: wrap; margin: 5%;">
    <?php foreach ($products as $product) : ?>
    <div class="card" style="display: flex; margin: 4px;">
      <div class="card-body">
        <h5 class="card-title"><?php echo $product->title?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?php echo $product->category_title?></h6>
        <h6 class="card-text"><?php echo $product->price?></h6>
        <h6 class="card-text"><?php echo $product->date?></h6>
        <h7 class="card-text"><?php echo $product->status?></h7>
        <a href="#" class="card-link">Купить</a>
      </div>
    </div>
  <?php endforeach; ?>
</div>

  <script>
    $(document).ready(function(){
    $('.button322').click(function(){
      let category = $(this).val();

      //post the field with ajax
        $.ajax({
          type: 'POST',
          url: '/',
          dataType: 'text',
          data: {filter : category},
          success: function(response){
            $('.content').html(response);
            }
        });
      }
    )});

</script>




