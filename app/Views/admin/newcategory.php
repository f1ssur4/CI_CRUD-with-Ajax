<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>


<?php if (isset($categories)): ?>
<div class="content" style="margin-left: 18%; margin-top: 3%">

  <table class="table" style="margin-top: 10px">
    <tr>
      <th><b>Все категории</b></th>
    </tr>
    <tr>
      <th><input class="new_category" name="new_category"></th>
      <th><button class="otpravka">Create</button></th>
    </tr>
    <?php foreach ($categories as $category) : ?>
    <tr>
      <td scope="col"><?php echo $category->category_title?></td>
      <td><button class="button334" value="<?php echo $category->id?>" type="submit" onclick="function()">delete</button></td>
    </tr>
  <?php endforeach;?>
  </table>
</div>
<?php endif; ?>


  <script>
    $(document).ready(function (){
      $('.otpravka').click(function() {
        let categoryVal = $('input.new_category').val();

        $.ajax({
          type: 'POST',
          url: '/admin/newCategory',
          data: {category: categoryVal},
          success: function (response) {
            $('.content').html(response);
          }
        })
      });
    });
  </script>

<script>
  $(document).ready(function(){
    $('.button334').click(function(){
        let deleteVal = $(this).val();

        $.ajax({
          type: 'POST',
          url: '/admin/categoryDelete',
          dataType: 'text',
          data: {delete : deleteVal},
          success: function(response){
            $('.content').html(response);
          }
        });
      }
    )});

</script>
