<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<style type="text/css">
		<?= preg_replace('#[\r\n\t ]+#', ' ', file_get_contents(__DIR__ . DIRECTORY_SEPARATOR . '/css/style.css')) ?>
</style>
<h3 style="color: #5BC0DE" >Welcome to my web page</h3>
<div>
  <select id="sel_cat" class="categorie categorie_style">
  <?php  
  //print_r($menu);
  	foreach ($categorie as $list_cat) { ?>
  		<option value="<?php  echo $list_cat['category_id'] ;?>"><?php  echo $list_cat['category_name'] ;?></option>
	<?php    } ?>
</select>
<div class="sub_categorie categorie_style"></div>
<div class="sub_sub_categorie categorie_style"></div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type='text/javascript'>
  $(document).ready(function(){

   $('.categorie').change(function(){
    var id_cat = $(this).val(); 
    $.ajax({
     url:'<?=base_url()?>/categories/getchildcat/'+id_cat,
     method: 'GET',
     dataType: 'json',
        success: function(response){
            $(".sub_categorie" ).html(response );
            $(".sub_sub_categorie" ).html('');
        }
      });
    });
  });

  $(document).on('change', '.sub_categorie .categorie', function() { 
    var id_cat = $(this).val(); 
    $.ajax({
    url:'<?=base_url()?>/categories/getchildcat/'+id_cat,
    method: 'GET',
    dataType: 'json',
      success: function(response){
        if ($(this).parents('.sub_categorie').length != 0) {
            //$(".sub_sub_categorie" ).html(response );
        }else{
          console.log($(this));
          $(".sub_sub_categorie" ).html(response );
          console.log('te7chet');
        }
      }
  });
  });
</script>