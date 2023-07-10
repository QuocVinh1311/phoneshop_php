<?php 
    define("PATH_TO_CONNECT_DB","connect_pdo.php");

    //hàm lấy thông tin tất cả sản phẩm
    function show_all_product(){ 
        include PATH_TO_CONNECT_DB;
        $sql="select * from product p join kind k on p.id_k= k.id_k";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $result_of_all_product=$stmt->fetchAll();
        return $result_of_all_product;
    }

    function show_all_accessory(){ 
        include PATH_TO_CONNECT_DB;
        $sql="select * from accessory a join kind k on a.id_k= k.id_k";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $result_of_all_accessory=$stmt->fetchAll();
        return $result_of_all_accessory;
    }
    
    //hàm lấy id và tên của tất cả loại sản phẩm
    function get_all_kind(){
        include PATH_TO_CONNECT_DB;
        $sql="select * from kind";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $result_of_all_kind=$stmt->fetchAll();
        return $result_of_all_kind;
    }

    //hàm kiểm tra ảnh có thể upload không
    function check_img_upload($img_of_product){
        $target_dir = "upload/";
        $target_file = $target_dir . basename($img_of_product["name"]);
        $upload_ok='success';
        //$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($img_of_product["tmp_name"]);
        if($check !== false) {
            $upload_ok = 'success';
        } else {
            $upload_ok = "File không phải hình ảnh!";
        }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            $upload_ok = 'Xin lỗi, hình ảnh đã tồn tại, vui lòng chọn ảnh khác!';
        }

        if ($upload_ok == 'success') {
            move_uploaded_file($img_of_product["tmp_name"], $target_file); //Tên tập tin, Đường dẫn tập tin
            
          // if everything is ok, try to upload file
        }
        // else{
        //     $upload_ok="Sorry, there was an error uploading your file.";
        // }
        return $upload_ok;
    }

    //hàm xóa sản phẩm
    function delete_product($id_of_product){
        include PATH_TO_CONNECT_DB;
        $sql2="select * from product where id_p=?";
        $stmt2=$conn->prepare($sql2);
        $stmt2->execute([$id_of_product]);
        $result2=$stmt2->fetch();

        unlink('upload/'.$result2['img']);

        $sql="delete from product where id_p=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$id_of_product]); 
    }

    //hàm kiểm tra đăng nhập
    function login_admin(){
        include PATH_TO_CONNECT_DB;
        $login_status='';

        if(isset($_POST['btn_login'])){
            if(isset($_POST['user_login']) && isset($_POST['password_login'])){
                $email_admin_login=$_POST['user_login'];
                $password_admin_login=$_POST['password_login'];

                if($email_admin_login=="admin@gmail.com"){
                    $sql="select * from users where email=?";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute([$email_admin_login]);

                    $result=$stmt->fetch();

                    if($stmt->rowCount()>0){
                        $password_hash_from_db=$result['pass_word']; 
                        if(password_verify($password_admin_login, $password_hash_from_db)){
                            $login_status='ok';
                            setcookie("admin_login_successful", 'ok', time() + 3600);
                        }else{
                            $login_status='no';
                        }
                    }else{
                        $login_status='no';
                    }
                }else{
                    $login_status='no';
                }
            }else{
                $login_status='no';
            }
        }
        return $login_status;
    }

    //hàm lấy thông tin của 1 sản phẩm cụ thể
    function get_data_product_from_db($id_of_product){
        include PATH_TO_CONNECT_DB;
        $sql="select * from product where id_p=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$id_of_product]);
        $result=$stmt->fetch();
        return $result;
    }
    
    function get_data_accessory_from_db($id_of_accessory){
        include PATH_TO_CONNECT_DB;
        $sql="select * from accessory where id=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$id_of_accessory]);
        $result=$stmt->fetch();
        return $result;
    }

    //Hàm cập nhật thông tin sản phẩm
    function update_data_product($name_p, $price,$id_k,$des, $quantity , $ram, $rom, $pin, $color,  $screen, $hdh ,$id_of_product){
        include PATH_TO_CONNECT_DB;
        $sql="update product set name_p=?,price=?, id_k=?, des=?, quantity=?, ram=?, rom=?, pin=?, color=?,screen=?, hdh=? where id_p=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$name_p, $price,$id_k, $des, $quantity, $ram, $rom, $pin, $color,$screen, $hdh,$id_of_product]);
    }

    function update_data_accessory($name, $price,$id_k,$des,$id_of_product){
        include PATH_TO_CONNECT_DB;
        $sql="update product set name=?,price=?, id_k=?, des=?,  where id_p=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$name, $price,$id_k, $des,$id_of_product]);
    }
    //Hàm lấy tất cả thông tin đơn hàng
    function get_all_order(){
        include PATH_TO_CONNECT_DB;
        $sql="select * from orders";
        $stmt=$conn->prepare($sql);
        $stmt->execute();

        $result_of_all_orders=$stmt->fetchAll();
        return $result_of_all_orders;
    }

    //Hàm lấy thông tin chi tiết đơn hàng
    function get_detail_order($id_of_order){
        include PATH_TO_CONNECT_DB;
        $sql="select * from order_detail where id_orders=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$id_of_order]);

        $result_of_detail_order=$stmt->fetchAll();
        return $result_of_detail_order;
    }

    //Hàm cập nhật trạng thái đơn hàng
    function update_order_status($id_of_order, $status){
        include PATH_TO_CONNECT_DB;
        $sql="update orders set status=? where id=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$status, $id_of_order]);
        
    }

    //Hàm kiểm tra xem tên sản phẩm muốn thêm có trùng không
    function check_name_kind($name_kind_add_kind){
        $kind_name_exist='';
        include PATH_TO_CONNECT_DB;
        $sql="select * from kind where name_k=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$name_kind_add_kind]);
        return $stmt->rowCount();
    }

    //hàm cập nhật tên loại sản phẩm
    function update_kind_name($id_of_kind, $name_of_kind){
        include PATH_TO_CONNECT_DB;
        $sql="update kind set name_k=? where id_k=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$name_of_kind, $id_of_kind]);
    }

    //Hàm xóa sản phẩm (xóa cả thông tin và ảnh)
    function delete_product_of_a_kind($id_of_kind){
        include PATH_TO_CONNECT_DB;
        //Chọn ra id của các sản phẩm thuộc loại cần xóa
        $sql="select * from product where id_k=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$id_of_kind]);
        $result=$stmt->fetchAll();
        foreach($result as $value){
            delete_product($value['id_p']);
        }
    }
    
    //Hàm xóa loại sản phẩm
    function delete_kind($id_of_kind){
        include PATH_TO_CONNECT_DB;
        $sql="delete from kind where id_k=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$id_of_kind]);
    }
    
    function get_all_users(){
        include PATH_TO_CONNECT_DB;
        $sql="select * from users";
        $stmt=$conn->prepare($sql);
        $stmt->execute();

        $result_of_all_orders=$stmt->fetchAll();
        return $result_of_all_orders;
    }

?>
