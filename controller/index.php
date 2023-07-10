<?php 
    ob_start();
    session_start();
    include '../models/handle_function.php';
    include '../view/header.php';
    define('PATH_TO_FILE_PDO','../models/db_connect.php');
    if(isset($_GET['action'])){
        switch ($_GET['action']){      
             
            case 'register'://done
                $status_register_account=register_account();
                if($status_register_account=='email_already_exists'){
                    echo '<script language="javascript">';
                    echo 'alert("Hãy đăng ký bằng email khác !");'; 
                    echo '</script>';
                }elseif($status_register_account=='no'){
                    echo '<script language="javascript">';
                    echo 'alert("Đăng kí thất bại !");'; 
                    echo '</script>';
                }elseif($status_register_account=='ok'){
                    echo '<script language="javascript">';
                    echo 'alert("Đăng kí tài khoản thành công ! Hãy tiến hành đăng nhập để mua hàng !");'; 
                    echo '</script>';
                }
                include '../view/register.php';
                break;
            case 'login'://done
                $status_login_account=login_account();
                if($status_login_account=='ok'){
                    echo '<script language="javascript">';
                    echo 'alert("Đăng nhập thành công !");'; 
                    echo '</script>';
                    header("Location: ?action=home");
                }elseif($status_login_account=='no'){
                    echo '<script language="javascript">';
                    echo 'alert("Đăng nhập thất bại, vui lòng thử lại !");'; 
                    echo '</script>';
                }
                include '../view/login.php';
                break;
            case 'logout'://done
                include '../view/logout.php';
                header("Location: ?action=home");
                break;
            case 'list_product'://done 
                    $list_of_product=list_of_products();
                    include PATH_TO_FILE_PDO;
                    if(isset($_GET['id_of_kind'])){
                        if($_GET['id_of_kind']=='all'){
                            $name_of_kind='TẤT CẢ SẢN PHẨM';//tên của loại sản phẩm
                        }else{
                            $sql="select * from kind where id_k=?";
                            $stmt=$conn->prepare($sql);
                            $stmt->execute([$_GET['id_of_kind']]);
                            $name_of_kind=$stmt->fetch()['name_k'];//tên của loại sản phẩm
                        }
                    }
                    include '../view/product.php';
                    break;
                case 'list_accessory'://done 
                    $list_of_accessory=list_of_accessory();
                    include PATH_TO_FILE_PDO;
                    if(isset($_GET['id_of_kind'])){
                        if($_GET['id_of_kind']=='all'){
                            $name_of_kind='TẤT CẢ SẢN PHẨM';//tên của loại sản phẩm
                        }else{
                            $sql="select * from kind where id_k=?";
                            $stmt=$conn->prepare($sql);
                            $stmt->execute([$_GET['id_of_kind']]);
                            $name_of_kind=$stmt->fetch()['name_k'];//tên của loại sản phẩm
                        }
                    }
                        include '../view/accessory.php';
                        break;
            case 'detail_product'://done
                $detail_of_product=product_details();
                include PATH_TO_FILE_PDO;
                if(isset($_GET['id_of_product'])){
                    $sql="select * from kind join product on kind.id_k=product.id_k where id_p=?";
                    $stmt=$conn->prepare($sql);
                    $stmt->execute([$_GET['id_of_product']]);
                    while($row = $stmt->fetch()) {
                        $name_of_kind=$row['name_k'];
                        $id_of_kind=$row[0];
                    }
                }
                include '../view/detail_product.php';
                break;
            case 'detail_accessory'://done
                    $detail_of_accessory=accessory_details();
                    include PATH_TO_FILE_PDO;
                    if(isset($_GET['id_of_product'])){
                        $sql="select * from kind join accessory on kind.id_k=accessory.id_k where id=?";
                        $stmt=$conn->prepare($sql);
                        $stmt->execute([$_GET['id_of_product']]);
                        while($row = $stmt->fetch()) {
                            $name_of_kind=$row['name'];
                            $id_of_kind=$row[0];
                        }
                    }
                    include '../view/detail_accessory.php';
                    break;
            case 'cart'://done
                add_product_into_cart();
                if(isset($_SESSION['cart'])){
                     $product_in_cart=$_SESSION['cart'];
                }
                include '../view/cart.php';
                break;
            case 'delete_product_from_cart'://done
                unset($_SESSION['cart'][$_GET['id_of_product_in_cart']]);
                header("Location:?action=cart");
                break;
            case 'change_quantity'://done
                if(isset($_GET['change_type']) && isset($_GET['id_of_product_in_cart']) && isset($_GET['quantity'])){
                    $quantity_after_change=change_quantity($_GET['change_type'], $_GET['quantity']);
                    if($quantity_after_change==0){
                        unset($_SESSION['cart'][$_GET['id_of_product_in_cart']]);
                    }else{
                        $_SESSION['cart'][$_GET['id_of_product_in_cart']]['quantity']=$quantity_after_change;
                    }
                    header("Location: ?action=cart");
                }
            case 'agree_order'://done
                $last_id_of_orders=create_order();
                if($last_id_of_orders=="no product in cart"){
                    echo '<script>alert("Vui lòng thêm sản phẩm vào giỏ hàng!")</script>'; //câu lệnh này không thực hiện được
                    header("Location: ?action=home");
                }else{
                    $product_in_orders=$_SESSION['cart'];
                    include PATH_TO_FILE_PDO;
                    if(isset($_POST['btn_agree_order_cart'])){
                        $sql="insert into order_detail(product_name, product_img, price, amount, thanhtien, id_orders) values (?,?,?,?,?,?)";
                        $stmt=$conn->prepare($sql);
                        foreach($product_in_orders as $id => $value){
                            $stmt->execute([$value['name_p'], $value['pic'], $value['price'], $value['quantity'], $value['price']*$value['quantity'],$last_id_of_orders]);
                        }
                    }
                    include '../view/order_success.php';
                }
                break;
            case 'delete_order'://done
                unset($_SESSION['cart']);
                header("Location: ?action=home");
                break;
            case 'search_product'://done
                $result_search_product=search_product();
                include '../view/search_product.php';
                break;
            case 'account_info':
                if(isset($_SESSION['remember_email_login'])){
                    $result_account_info=get_account_info($_SESSION['remember_email_login']);
                    $result_all_orders=get_all_orders($_SESSION['remember_email_login']);
                }

                if(isset($_GET['agree_cancel_order']) && isset($_GET['id_of_order_cancel'])){
                    cancel_orders($_GET['id_of_order_cancel']);
                    header("Location: ?action=account_info");
                }
                
                include '../view/account_info.php';
                break;
            case 'detail_order':
                if(isset($_GET['id_of_order'])){
                    //Hàm lấy thông tin chi tiết đơn hàng
                    $result_detail_order=get_detail_order($_GET['id_of_order']);
                }
                include '../view/detail_order.php';
                break;
            case 'change_account_info':
                change_account_info();
                include '../view/change_account_info.php';
                break;
            case 'change_password':
                $change_password_status=change_password();
                if($change_password_status=='ok'){
                    echo '<script>alert("Đổi mật khẩu thành công!")</script>'; 
                }elseif($change_password_status=='no'){
                    echo '<script>alert("Mật khẩu cũ không đúng!")</script>'; 
                }
                include '../view/change_password.php';
                break;    
            default:
                include '../view/home.php';    
                break;
        }
    }else{
        include '../view/home.php';
    }

    include '../view/footer.php'; 
    ob_end_flush();
?>