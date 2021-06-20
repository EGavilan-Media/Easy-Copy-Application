<?php 
  headerAdmin($data);
  getModal('modalApp',$data);
?>
  <div class="text-center m-4">
    <button class="btn btn-primary" type="button" onclick="openModal();" ><i class="fas fa-plus-circle"></i> Add New Text</button>
  </div>
  <main>
    <div id="tablaCategoriaLoad"></div>    
  </main>
  <?php footerAdmin($data); ?>