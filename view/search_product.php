
<main class="container" style="margin-top:200px;">
<h1 style="text-align:center;">Kết Quả Tìm Kiếm</h1></br>
    <h2>Tìm thấy <?php if(isset($result_search_product)){ 
                            echo count($result_search_product);
                        }
                        else{ echo "0";} ?> 
    kết quả với từ khóa "<?php if(isset($_GET['search_input_header'])){
                                    echo $_GET['search_input_header'];
                                }
                        ?>"</h2>
    <div class="row mt-5">
        <?php if(isset($result_search_product)){
            foreach($result_search_product as $value){?>

                <div class="col-md-3 col-6 list_item_search_product list_item_product">
                    <a href="?action=detail_product&id_of_product=<?php echo $value['id_p']?>" class="d-block"> 
                        <img src="<?php echo "../admin/upload/".$value['pic'];?>" alt="">
                    </a>
                    <a href="?action=detail_product&id_of_product=<?php echo $value['id_p']?>" class="d-block text-center mt-3"><?php echo $value['name_p'];?></a>
                    <p class="text-center"><?php echo number_format($value['price'],0,",",".")."đ";?></p>
                    <a href="?action=detail_product&id_of_product=<?php echo $value['id_p']?>" class="d-block product_submit">
                        <input type="button" value="Chi tiết sản phẩm"></input>
                    </a>
                </div>
        <?php }}?>    
    </div>
</main>
