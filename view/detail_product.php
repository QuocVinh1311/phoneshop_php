
<main class="container mt-5">
<h1 style="margin-top:200px; text-align:center; margin bottom:100px;">Chi tiết sản phẩm</h1>

    <div class="row">
        <div class="col-md-6 mb-3">
            <img id="img_detail_product" src="<?php echo "../admin/upload/".$detail_of_product['pic'];?>" alt="">
        </div>
        <div id="contain_detail_product" class="col-md-6 mb-3">
            <h2 id="name_of_detail_product"><?php echo $detail_of_product['name_p'];?></h2>
            <i class="far fa-clock"></i>
            <hr>
            <p id="price_of_detail_product" class="text-center"><span><?php echo number_format($detail_of_product['price'],0,",",".")."đ";?></span></p>
            <span>Màn hình:  <p><?php echo $detail_of_product['screen'];?> inch</p> </span>
            <span>Màu: <p><?php echo $detail_of_product['color'];?></p></span>
            <span>Ram:  <p><?php echo $detail_of_product['ram'];?> GB</p></span>
            <span>Rom: <p><?php echo $detail_of_product['rom'];?> GB</p> </span>
            <span>Hệ điều hành: <p><?php echo $detail_of_product['hdh'];?></p></span>
            <span>Pin:  <p><?php echo $detail_of_product['pin'];?> mAh</p></span>
           
           
            
            <?php if ($detail_of_product['quantity']>0) {?>
            <div class="product-quantity"><lable></lable>Tồn kho:  <p><?php echo $detail_of_product['quantity'];?></p></div>
            <form id="form_add_into_cart" method="post" class="row mt-5" action="?action=cart">
                <div class="col-3">
                    <label for="amount_product_detail_product" style="color: #1097cf; font-size: 16px; font-weight: 600;" >Số lượng</label>
                </div>    
                <div class="col-9">
                    <input type="number" id="amount_product_detail_product" class="col-7 mx-sm-3" min="1" name="quantity" value="1">
                </div>
                <input type="hidden" name="id_of_product" value="<?php echo $detail_of_product['id_p'];?>">
                <button type="submit" id="btn_add_into_cart" name="btn_add_into_cart" class="btn">Thêm vào giỏ hàng</button>
            </form>
            <?php }else{?>
                <p class="error">Hết hàng</p>
            <?php } ?>
            <hr>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
               Xem chi tiết cấu hình
            </button>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo $detail_of_product['name_p'];?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><?php echo $detail_of_product['des'];?></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-info" data-bs-dismiss="modal">Đóng</button>
                </div>
                </div>
            </div>
            </div>
            <hr>
            <div id="service_detail_product" class="row">
                <div class="col-md-6 mt-3">
                    <img src="https://bizweb.dktcdn.net/100/438/171/themes/836357/assets/icon_service_product_1.svg?1665539904835" alt="">
                    <span>Giao hàng toàn quốc</span>
                </div>
                <div class="col-md-6 mt-3">
                    <img src="https://bizweb.dktcdn.net/100/438/171/themes/836357/assets/icon_service_product_2.svg?1665539904835" alt="">
                    <span>Thanh toán nhiều hình thức</span>
                </div>
                <div class="col-md-6 mt-3">
                    <img src="https://bizweb.dktcdn.net/100/438/171/themes/836357/assets/icon_service_product_3.svg?1665539904835" alt="">
                    <span>Cam kết đổi trả hàng miễn phí</span>
                </div>
                <div class="col-md-6 mt-3">
                    <img src="https://bizweb.dktcdn.net/100/438/171/themes/836357/assets/icon_service_product_4.svg?1665539904835" alt="">
                    <span>Hàng chính hãng/Bảo hành 1 năm</span>
                </div>
            </div>
        </div>
    </div>
</main>