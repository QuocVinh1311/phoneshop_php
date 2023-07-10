
<main class="container mt-3 product">
    <h1 style="text-align:center; margin-top:200px;">Phụ kiện</h1></br>
    <div id="list_accessory" class="row mt-5">
        <?php 
            foreach ($list_of_accessory as $value){?>
                <div class="col-md-3 col-6 list_item_product product_container">
                    <a href="?action=detail_accessory&id_of_product=<?php echo $value['id']?>" class="d-block">
                        <img src="<?php echo "../admin/upload/".$value['pic'];?>" alt="">
                    </a>
                    <a href="?action=detail_accessory&id_of_product=<?php echo $value['id']?>" class="d-block text-center mt-3"><?php echo $value['name'];?></a>
                    <p class="text-center"><?php echo number_format($value['price'],0,",",".")."đ";?></p>
                    <a href="?action=detail_accessory&id_of_product=<?php echo $value['id']?>" class="d-block product_submit">
                        <input type="button" value="Chi tiết sản phẩm"></input>
                    </a>
                </div>
        <?php }?>
    </div>
</main>