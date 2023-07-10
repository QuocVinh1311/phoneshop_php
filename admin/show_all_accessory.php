<?php 
    include 'handle_admin.php';
    $all_accessory=show_all_accessory();

    if(empty($_COOKIE['admin_login_successful'])){
        header("Location: login.php");
    }

    //Xóa sản phẩm
    if(isset($_GET['delete_accessory']) && isset($_GET['id_p'])){
        $id_of_product=$_GET['id_p'];
        delete_product($id_p);
        header("Location: ?notice_after_delete");
    }

    //Thông báo sau khi xóa
    if(isset($_GET['notice_after_delete'])){
        echo '<script language="javascript">';
        echo 'alert("Đã xóa sản phẩm thành công!");'; 
        echo '</script>';
    }
    
    //Thông báo sau khi cập nhật thành công
    if(isset($_GET['update_success'])){
        echo '<script language="javascript">';
        echo 'alert("Đã cập nhật sản phẩm thành công!");'; 
        echo '</script>';
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tất cả sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
</head>

<body>
    <!-- header dùng chung -->
    <header>
        <div class="container">
            <div class="row align-items-center" style="height: 50px;">
                <div class="col-sm-6">
                    <a id="btn_back_show_all_product" href="">Phoneshop</a>
                </div>
                <div class="col-sm-6">
                    <a id="btn_login" href="logout.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </header>
    <!-- header dùng chung -->

    <main class="container" style="margin-top: 50px; margin-bottom: 100px">
        <div class="row">
            <h3 class="text-center">Phone Shop</h3>
            <p class="text-center">Tất cả phụ kiện ở đây</p>
        </div>

        <div>
            <button id="btn_collapse_show_all_product" class="btn btn-danger" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="fas fa-th-list"></i>
            </button>
        </div>
        <div class="collapse mt-2" id="collapseExample">
            <div class="card card-body" style="width: 18rem;" id="card_body_show_all_product">
                <a href="show_all_product.php">Quản lý sản phẩm</a>
            </div>
        </div>

        <div class="row mt-3">
            <a href="add_accessory.php"><button class="btn bin-info" id="btn_add_new_product_show_all_product">Thêm sản phẩm mới</button></a> 
        </div>
        <div class="row mt-4" style="height: 500px; overflow-y: scroll;">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Loại sản phẩm</th>        
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody id="tbody_show_all_product">
                    <?php if(isset($all_accessory)){
                        $numerical_order=1;
                            foreach($all_accessory as $value){
                    ?>
                        <tr>
                            <td>
                                <?php if(isset($numerical_order)) echo $numerical_order;?>
                            </td>
                            <td>
                                <?php echo $value['name'];?>
                            </td>
                            
                            <td>
                                <?php echo number_format($value['price'],0,",",".");?>
                            </td>
                
                            <td>
                                <?php echo $value['name_k'];?>
                            </td>
                          
                            <td style="width: 600;">
                                <?php echo $value['des'];?> 
                            </td>
                            <td class="d-block">
                                <img src="upload/<?php echo $value['pic']?>" alt="">
                            </td>
                            <td style="width: 70px;">
                                <a href="edit_accessory.php?id_of_product=<?php echo $value[0];?>"><button class="btn" id="btn_edit_show_all_product">Sửa</button></a>
                                <a href="?delete_product&id_of_product=<?php echo $value[0];?>"><button class="btn" id="btn_del_show_all_product" name="btn_del_show_all_product">Xóa</button></a>
                            </td>
                        </tr>
                    <?php $numerical_order++;}}?>  
                </tbody>
            </table>
        </div>
    </main>
    <!-- footer dùng chung -->
    <footer>
        <p class="container text-center">Copyright © 2023, Phoneshop Powered by B1910022</p>  
    </footer>
    <!-- footer dùng chung -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
        crossorigin="anonymous"></script>
</body>

</html>