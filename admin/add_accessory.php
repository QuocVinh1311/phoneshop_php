<?php 
    include 'handle_admin.php';
    include 'connect_pdo.php';

    if(empty($_COOKIE['admin_login_successful'])){
        header("Location: login.php");
    }

    //Lấy thông tin tất cả các category để hiển thị vào select
    $result_of_all_kind=get_all_kind();

    //Lấy data từ form và xử lý
    if(isset($_POST['btn_add_accessory_add'])){
        if(isset($_POST['name_accessory_add']) && isset($_POST['des_accessory_add']) && isset($_POST['price_accessory_add']) && isset($_FILES['img_of_product']) && isset($_POST['kind_accessory_add'])){
            $name_accessory_add=$_POST['name_accessory_add'];
            $des_accessory_add=$_POST['des_accessory_add'];
            $price_accessory_add=$_POST['price_accessory_add']; 
            $img_of_product=$_FILES['img_of_product'];
            $kind_accessory_add=$_POST['kind_accessory_add'];

            //Xử lý file ảnh
            $check_status_upload_img=check_img_upload($img_of_product);

            if($check_status_upload_img=='success'){
                $sql="insert into accessory ( name, des, price, pic, id_k) values (?,?,?,?,?)";
                $stmt=$conn->prepare($sql);
                $stmt->execute([$name_accessory_add,$des_accessory_add,$price_accessory_add,$img_of_product['name'],$kind_accessory_add]);
                echo '<script language="javascript">';
                echo 'alert("Thêm sản phẩm mới thành công !");'; 
                echo '</script>';
            }else{
                echo '<script language="javascript">';
                echo 'alert("'.$check_status_upload_img.'");';  
                echo '</script>';
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
    <title>Thêm sản phẩm</title>
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
                    <a id="btn_back_show_all_product" href="show_all_product.php">Phone Shop</a>
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
            <h3 class="text-center">Phone Shop</h3>
            <p class="text-center">Thêm phụ kiện mới tại đây</p>
        </div>
        <div class="row">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name_accessory_add" class="form-label">Tên sản phẩm</label>
                    <input type="text" name="name_accessory_add" class="form-control" id="name_accessory_add" required>
                </div>
                <div class="mb-3">
                    <label for="price_accessory_add" class="form-label">Giá bán</label>
                    <input type="text" name="price_accessory_add" class="form-control" id="price_accessory_add" required>
                </div>
                <div class="mb-3">
                    <label for="kind_accessory_add" class="form-label">Loại sản phẩm</label>
                    <select class="form-select" id="kind_accessory_add" name="kind_accessory_add" required>
    
                        <?php 
                            if(isset($result_of_all_kind)){
                                foreach($result_of_all_kind as $value){
                        ?>          
                                    <option value="<?php echo $value['id_k'];?>"><?php echo $value['name_k'];?></option>
                                
                        <?php }}?>
                        
                    </select>
                </div>
                <div class="mb-3">
                    <label for="des_accessory_add" class="form-label">Mô tả sản phẩm</label>
                    <input type="text" name="des_accessory_add" class="form-control" id="des_accessory_add" required>
                </div>
                <div class="mb-3">
                    <label for="img_of_product" class="form-label">Chọn hình ảnh minh họa</label>
                    <input class="form-control" type="file" id="img_of_product" name="img_of_product" accept="image/png, image/jpeg" required>
                </div>
                <button type="submit" name="btn_add_accessory_add" class="btn btn-primary">Thêm sản phẩm</button>
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