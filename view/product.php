
<main class="container mt-3 product">
<h1 style="text-align:center; margin-top:200px;">Điện Thoại</h1></br>
    <div id="list_product" class="row mt-5">
        <?php 
            foreach ($list_of_product as $value){?>
                <div class="col-md-3 col-6 list_item_product product_container">
                    <a href="?action=detail_product&id_of_product=<?php echo $value['id_p']?>" class="d-block">
                        <img src="<?php echo "../admin/upload/".$value['pic'];?>" alt="">
                    </a>
                    <a href="?action=detail_product&id_of_product=<?php echo $value['id_p']?>" class="d-block text-center mt-3"><?php echo $value['name_p'];?></a>
                    <p class="text-center"><?php echo number_format($value['price'],0,",",".")."đ";?></p>
                    <a href="?action=detail_product&id_of_product=<?php echo $value['id_p']?>" class="d-block product_submit">
                        <input type="button" value="Chi tiết sản phẩm"></input>
                    </a>
                </div>
        <?php }?>
    </div>
</main>
