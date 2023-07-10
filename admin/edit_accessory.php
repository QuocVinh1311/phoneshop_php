<?php 
    include 'handle_admin.php';

    if(empty($_COOKIE['admin_login_successful'])){
        header("Location: login.php");
    }

    //Lấy thông tin tất cả các category để hiển thị vào select
    $result_of_all_kind=get_all_kind();

    //Lấy thông tin hiện tại của sản phẩm
    if(isset($_GET['id_of_accessory'])){
        $id_of_accessory=$_GET['id_of_accessory']; //$id_of_product: id của sản phẩm hiện tại
        $data_of_the_accessory_to_be_edited=get_data_accessory_from_db($id_of_accessory);
    }

    //Tiến hành cập nhật sản phẩm
    if(isset($_POST['btn_add_accessory_edit'])){
        if(isset($_POST['name_accessory_edit']) && isset($_POST['des_accessory_edit']) && isset($_POST['price_accessory_edit']) && isset($_FILES['img_of_product']) && isset($_POST['kind_accessory_edit'])){
            $name_accessory_edit=$_POST['name_accessory_edit'];
            $des_accessory_edit=$_POST['des_accessory_edit'];
            $price_accessory_edit=$_POST['price_accessory_edit']; 
            $img_of_product=$_FILES['img_of_product'];
            $kind_accessory_edit=$_POST['kind_accessory_edit'];
            
            //Nếu không có thay đổi hình ảnh
            if(empty($img_of_product['name'])){
                update_data_accessory($name_accessory_edit,$des_accessory_edit,$price_accessory_edit,$img_of_product,$kind_accessory_edit);
                header("Location: show_all_accessory.php?update_success");
            }else{
                $check_status_upload_img_edit=check_img_upload($img_of_product);
                if($check_status_upload_img_edit=='success'){
                    unlink('upload/'.$data_of_the_product_to_be_edited['pic']);
                    update_data_accessory($name_accessory_edit,$des_accessory_edit,$price_accessory_edit,$img_of_product,$kind_accessory_edit);
                    include 'connect_pdo.php';
                    $sql_img="update accessory set pic=? where id=?";
                    $stmt_img=$conn->prepare($sql_img);
                    $stmt_img->execute([$img_of_edit_product['name'],$id_of_accessory]);
                    header("Location: show_all_accessory.php?update_success");
                }else{
                    echo '<script language="javascript">';
                    echo 'alert("'.$check_status_upload_img_edit.'");';  
                    echo '</script>';
                }
            }         
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm</title>
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
                    <a id="btn_back_show_all_product" href="show_all_product.php">Phone shop</a>
                </div>
                <div class="col-sm-6">
                    <a id="btn_login" href="logout.php">Đăng xuất</a>
                </div>
            </div>
        </div>
    </header>
    <!-- header dùng chung -->

    <main class="container" style="margin-top: 50px; margin-bottom: 100px;">
        <div class="row">
            <h3 class="text-center">Phone shop</h3>
            <p class="text-center">Chỉnh sửa thông tin sản phẩm tại đây</p>
        </div>

        <div class="row">
            <form action="?id_of_accessory=<?php if(isset($_GET['id_of_accessory'])){ echo $_GET['id_of_accessory'];}?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name_accessory_edit" class="form-label">Tên sản phẩm hiện tại</label>
                    <input type="text" name="name_accessory_edit" class="form-control" id="name_accessory_edit" value="<?php echo $data_of_the_accessory_to_be_edited['name'];?>" required>
                </div>
                <div class="mb-3">
                    <label for="price_accessory_edit" class="form-label">Giá bán hiện tại</label>
                    <input type="text" name="price_accessory_edit" class="form-control" id="price_accessory_edit" value="<?php echo $data_of_the_accessory_to_be_edited['price'];?>" required>
                </div>
                <div class="mb-3">
                    <label for="kind_accessory_edit" class="form-label">Loại sản phẩm</label>
                    <select class="form-select" id="kind_accessory_edit" name="kind_accessory_edit" required>
                        <?php 
                            if(isset($result_of_all_kind)){
                                foreach($result_of_all_kind as $value){
                        ?>          
                                    <option value="<?php echo $value['id_k'];?>"><?php echo $value['name_k'];?></option>
                                
                        <?php }}?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="des_accessory_edit" class="form-label">Mô tả sản phẩm</label>
                    <input type="text" class="form-control mb-3" value="<?php echo $data_of_the_product_to_be_edited['des'];?>" readonly>
                    <textarea class="form-control" id="des_accessory_edit" name="des_accessory_edit" rows="4" required></textarea>   
                </div>
               
                <div class="mb-3">
                    <p>Ảnh minh họa sản phẩm hiện tại:</p>
                    <img src="upload/<?php echo $data_of_the_accessory_to_be_edited['pic'];?>" width="200px" height="200px" class="img-thumbnail" alt="">
                </div>
                <div class="mb-3">
                    <label for="img_of_product" class="form-label">Chọn hình ảnh minh họa muốn đổi</label>
                    <input class="form-control" type="file" id="img_of_product" name="img_of_product" accept="image/png, image/jpeg">
                </div>
                <button type="submit" name="btn_edit_product_edit" class="btn btn-primary">Cập nhật sản phẩm</button>
            </form>
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