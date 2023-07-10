<?php
    //Hàm check xem email có tồn tại chưa
    function check_email_exist($email,$conn){
        $sql="select * from users where email = ?";
        $stmt = $conn -> prepare($sql);
        $stmt -> execute([$email]);
        return $stmt->rowCount();
    }

    //Hàm kiểm tra quá trình đăng ký tài khoản
    function register_account(){
        include(__DIR__ . '.\db_connect.php');
        $register_ok='';
        if(isset($_POST['btn_register'])){
            if(isset($_POST['fullname_register']) && isset($_POST['email_register']) && isset($_POST['phone_number_register']) && isset($_POST['password_register']) && isset($_POST['password_repeat_register'])){
                $fullname_account=$_POST['fullname_register'];
                $email_account=$_POST['email_register'];
                $number_phone_account=$_POST['phone_number_register'];
                $password_account=$_POST['password_register'];

                $password_account_hash=password_hash($password_account, PASSWORD_DEFAULT);

                if(check_email_exist($email_account, $conn)>0){
                    $register_ok='email_already_exists';
                }else{
                    $sql = "insert into users(full_name, email , phone_number, pass_word) values(?, ? , ?, ?)";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute([$fullname_account, $email_account, $number_phone_account, $password_account_hash]);
                    $register_ok='ok';
                }
            }else{
                $register_ok='no';
            }
        }
        return $register_ok;
    }

    //Hàm đăng nhập
    function login_account(){
        include(__DIR__ . '.\db_connect.php');
        $login_ok='';
        if(isset($_POST['btn_login'])){
            if(isset($_POST['email_login']) && isset($_POST['password_login']) && ($_POST['email_login']!="admin@gmail.com")){
                $email_login=$_POST['email_login'];
                $password_login=$_POST['password_login'];

                //truy vấn để lấy password khớp với email
                $sql = "select * from users where email = ?";
                $stmt = $conn -> prepare($sql);
                $stmt->execute([$email_login]);
                //result lấy dòng đầu tiên
                $result=$stmt -> fetch();
                
                if($stmt->rowCount()>0){
                    $password_hash_from_db=$result['pass_word']; 

                    if(password_verify($password_login, $password_hash_from_db)){
                        $fullname_login=$result['full_name'];
                        $login_ok='ok';
                        if(isset($_POST['check_remember_login']) && ($_POST['check_remember_login'])){
                            setcookie("remember_username_login", $fullname_login, time() + 3600);
                            setcookie("remember_email_login", $result['email'], time() + 3600);
                            setcookie("remember_phone_number_login", $result['phone_number'], time() + 3600);
                            setcookie("remember_password_login", $password_login, time() + 3600);
                        }else{
                            $_SESSION['remember_username_login']=$fullname_login;
                            $_SESSION['remember_email_login']=$result['email'];
                            $_SESSION['remember_phone_number_login']=$result['phone_number'];
                            $_SESSION['remember_password_login']=$password_login;
                        }
                    }else{
                        $login_ok='no';
                    }
                }else{
                    $login_ok='no';
                }
            }else{
                $login_ok='no';
            }
        }       
        return $login_ok;
    }

    //Hàm lấy thông tin tất các các loại sản phẩm
    function get_all_kind(){
        include(__DIR__ . '.\db_connect.php');
        $sql="select * from kind";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $result_of_all_kind=$stmt->fetchAll();
        return $result_of_all_kind;
    }

    //Hàm lấy thông tin các sản phẩm theo loại    
    function list_of_products(){
        include(__DIR__ . '.\db_connect.php');
        if(isset($_GET['id_of_kind'])){
            $id_k=$_GET['id_of_kind'];
            if($id_k=='all'){
                $sql="select * from product";
                $stmt=$conn->prepare($sql);
                $stmt->execute();
            }else{
                $sql="select * from product where id_k=?";
                $stmt=$conn->prepare($sql);
                $stmt->execute([$id_k]);
            }
        }
        $sql="select * from product";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $list_of_product=$stmt->fetchAll();
        return $list_of_product;
    }
    function list_of_accessory(){
        include(__DIR__ . '.\db_connect.php');
        if(isset($_GET['id_of_kind'])){
            $id_k=$_GET['id_of_kind'];
            if($id_k=='all'){
                $sql="select * from accessory";
                $stmt=$conn->prepare($sql);
                $stmt->execute();
            }else{
                $sql="select * from accessory where id_k=?";
                $stmt=$conn->prepare($sql);
                $stmt->execute([$id_k]);
            }
        }
        $sql="select * from accessory";
        $stmt=$conn->prepare($sql);
        $stmt->execute();
        $list_of_accessory=$stmt->fetchAll();
        return $list_of_accessory;
    }
    
    

    function product_details(){
        include(__DIR__ . '.\db_connect.php');
        if(isset($_GET['id_of_product'])){
            $id_of_product=$_GET['id_of_product'];
            $sql="select * from product where id_p=?";
            $stmt=$conn->prepare($sql);
            $stmt->execute([$id_of_product]);

            $detail_of_product=$stmt->fetch();
            return $detail_of_product;
        }
    }

    function accessory_details(){
        include(__DIR__ . '.\db_connect.php');
        if(isset($_GET['id_of_product'])){
            $id_of_product=$_GET['id_of_product'];
            $sql="select * from accessory where id=?";
            $stmt=$conn->prepare($sql);
            $stmt->execute([$id_of_product]);

            $detail_of_accessory=$stmt->fetch();
            return $detail_of_accessory;
        }
    }
    
    
    function add_product_into_cart(){
        include(__DIR__ . '.\db_connect.php');
        if(isset($_POST['btn_add_into_cart'])){
            if(isset($_POST['quantity'])){
                $the_number_of_products=$_POST['quantity'];
                $id_of_product=$_POST['id_of_product'];

                if(isset($_SESSION['cart'][$id_of_product])){
                    $_SESSION['cart'][$id_of_product]['quantity']+=$the_number_of_products;
                }else{
                    $sql="select * from product where id_p=?";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute([$id_of_product]);
                    $result_add_into_cart=$stmt->fetch();

                    //Lưu vào session
                    $_SESSION['cart'][$id_of_product]['quantity']=$the_number_of_products;
                    $_SESSION['cart'][$id_of_product]['pic']=$result_add_into_cart['pic'];
                    $_SESSION['cart'][$id_of_product]['name_p']=$result_add_into_cart['name_p'];
                    $_SESSION['cart'][$id_of_product]['price']=$result_add_into_cart['price'];
                    header("Location:../controller/index.php?action=cart");
                }
            }
        }
    }

    function change_quantity($type, $quantity){
        if($type=='decrease')
            $quantity--;
        if($type=='increase')
            $quantity++;  
        return $quantity;    
    }

   

    function create_order(){
        include(__DIR__ . '.\db_connect.php');
        if(isset($_POST['btn_agree_order_cart']) && isset($_SESSION['cart'])){
            if(isset($_POST['fullname_customer_cart']) && isset($_POST['email_customer_cart']) && isset($_POST['phone_number_customer_cart']) && isset($_POST['address_customer_cart']) && isset($_POST['payments_of_customer_cart']) && isset($_POST['total_cart_value'])){
                $sql="insert into orders (full_name,address,phone_number,email,total,payment) values (?,?,?,?,?,?)"; 
                $stmt=$conn->prepare($sql);
                $stmt->execute([$_POST['fullname_customer_cart'],$_POST['address_customer_cart'],$_POST['phone_number_customer_cart'],$_POST['email_customer_cart'],$_POST['total_cart_value']+30000,$_POST['payments_of_customer_cart']]);                 
            }
            return $conn->lastInsertID();
            $conn= null;
        }
        else{
            return "no product in cart";
        }
    }
    
    function search_product(){
        include(__DIR__ . '.\db_connect.php'); 
        if(isset($_GET['search_input_header'])){
            $search_key=$_GET['search_input_header'];
            $sql="select * from product where name_p LIKE '%$search_key%'"; //not a php statement so no string concatenation needed
            $stmt=$conn->prepare($sql);
            $stmt->execute();

            $result_search_key=$stmt->fetchAll();
            return $result_search_key;
        }
    }

    function search_accessory(){
        include(__DIR__ . '.\db_connect.php'); 
        if(isset($_GET['search_input_header'])){
            $search_key=$_GET['search_input_header'];
            $sql="select * from accessory where name LIKE '%$search_key%'"; //not a php statement so no string concatenation needed
            $stmt=$conn->prepare($sql);
            $stmt->execute();

            $result_search_key=$stmt->fetchAll();
            return $result_search_key;
        }
    }


    function get_account_info($email){
        include(__DIR__ . '.\db_connect.php');
        $sql="select * from users where email=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$email]);

        $result_account_info=$stmt->fetch();
        return $result_account_info; 
    }

    function get_all_orders($email){
        include(__DIR__ . '.\db_connect.php');
        $sql="select * from orders where email=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$email]);

        $result_all_orders=$stmt->fetchAll();
        return $result_all_orders;
        $conn=null;
    }

    function cancel_orders($id_of_order_cancel){
        include(__DIR__ . '.\db_connect.php'); 
        $sql="update orders set status =? where id=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute(['Đã hủy',$id_of_order_cancel]);
        $conn=null;
    }

    function get_detail_order($id_of_order){
        include(__DIR__ . '.\db_connect.php'); 
        $sql="select * from order_detail where id_orders=?";
        $stmt=$conn->prepare($sql);
        $stmt->execute([$id_of_order]);

        $result_detail_order=$stmt->fetchAll();
        return $result_detail_order;
        $conn=null;
    }

    function change_account_info(){
        include(__DIR__ . '.\db_connect.php'); 
        if(isset($_POST['btn_change_account_info'])){
            if(isset($_SESSION['remember_email_login'])){
                if(isset($_POST['full_name_change_account_info']) && isset($_POST['phone_number_change_account_info'])){
                    $sql="update users set full_name=?, phone_number=? where email=?";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute([$_POST['full_name_change_account_info'], $_POST['phone_number_change_account_info'], $_SESSION['remember_email_login']]);

                    $_SESSION['remember_username_login']=$_POST['full_name_change_account_info'];
                    $_SESSION['remember_phone_number_login']=$_POST['phone_number_change_account_info'];

                    echo '<script language="javascript">';
                    echo 'alert("Cập nhật thông tin người dùng thành công");'; 
                    echo '</script>';
                }
            }
        }
        
        $conn=null;
    }

    function change_password(){
        $change_password_status='';
        if(isset($_POST['btn_change_password'])){
            if(isset($_SESSION['remember_email_login']) && isset($_POST['current_password_change_password']) && isset($_POST['new_password_change_password']) && isset($_POST['repeat_password_change_password']) && ($_POST['current_password_change_password']==$_SESSION['remember_password_login'])){
                include(__DIR__ . '.\file_pdo_connect.php');
                $sql="update account set pass_word=? where email=?";
                $stmt=$conn->prepare($sql);
                $stmt->execute([password_hash($_POST['new_password_change_password'], PASSWORD_DEFAULT), $_SESSION['remember_email_login']]);
                $change_password_status='ok';
                $conn=null;
            }else{
                $change_password_status='no';
            }
        }
        return $change_password_status;
    }
    
?>

