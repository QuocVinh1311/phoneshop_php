
<main class="container">
<h1>Chi tiết đơn hàng</h1>
<div id="breadcrumb_background">
    <h1 id="title_breadcrumb" class="text-center">CHI TIẾT ĐƠN HÀNG</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a href="?action=home">Trang chủ</a></li>&nbsp;
            <li style="font-weight: 600;" class="breadcrumb-item"><a href="../controller/index.php?action=account_info">Thông tin của tôi</a></li>&nbsp;
            <li class="breadcrumb-item active" aria-current="page" style="color: #1097cf; font-weight: 600; font-size: 16px;">&nbsp;Chi tiết đơn hàng</li>
        </ol>
    </nav>
</div>
    <div class="table-responsive-xl">
        <table class="table caption-top">
            <caption>Đơn hàng: #<?php if(isset($_GET['id_of_order'])){echo $_GET['id_of_order'];}?></caption>
            <thead>
                <tr>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Thành tiền</th>
                </tr>
                </thead>
                <tbody>

                <?php if(isset($result_detail_order)){
                    foreach($result_detail_order as $value){
                ?>
                    

                <tr>
                    <th scope="row"><?php echo $value['name_p'];?></th>
                    <td><?php echo number_format($value['price'],0,",",".")."đ";?></td>
                    <td><?php echo $value['amount'];?></td>
                    <td><?php echo number_format($value['price']*$value['amount'],0,",",".")."đ";?></td>
                </tr>
                <?php
                ?>
                </tbody>
        </table>
    </div>
    <a href="../controller/index.php?action=account_info"><button id="btn_back_detail_order">Quay lại</button></a>       
</main>