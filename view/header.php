
<?php 
    if(isset($_COOKIE["remember_username_login"]) && isset($_COOKIE["remember_email_login"]) && isset($_COOKIE["remember_phone_number_login"]) && isset($_COOKIE["remember_password_login"])){
        $_SESSION['remember_username_login']=$_COOKIE["remember_username_login"];
        $_SESSION['remember_email_login']=$_COOKIE["remember_email_login"];
        $_SESSION['remember_phone_number_login']=$_COOKIE["remember_phone_number_login"];
        $_SESSION['remember_password_login']=$_COOKIE["remember_password_login"];
    }
    $result_of_all_kind=get_all_kind();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Phone Shop</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <link href="../view/css/style.css" rel="stylesheet" type="text/css">
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
  crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Playfair+Display:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" 
  integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
  crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" 
  integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" 
  crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<header id="header" class="fixed-top">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">
          <h1 class="logo"><a href="index.php">Phone Shop</a></h1>
            <form id="form_search_product_header" action="#" method="get" class="d-flex align-items-center justify-content-around">
                  <input type="hidden" name="action" value="search_product">
                  <input id="search_input_header" name="search_input_header" type="text" placeholder="Tìm sản phẩm ...">
                  <button class="btn" id="search_btn_header" type="submit"><i class="fas fa-search"></i></button>
              </form>
              <nav class="navbar mb-3 text-warning" id="pills-tab" role="tablist">
                <ul class="menu-bar">
                  <li class="nav-item">
                    <a class="nav-link" href="index.php" class="text-warning"  <?php if(isset($_GET['action']) && $_GET['action']=='agree_order'){ echo 'style="pointer-events: none;"';} if(isset($_GET['action']) && $_GET['action']=='home'){echo 'style="color: white;"';}?>>Trang chủ</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?action=list_product" class="text-warning"  <?php if(isset($_GET['action']) && $_GET['action']=='agree_order'){ echo 'style="pointer-events: none;"';} if(isset($_GET['action']) && $_GET['action']=='list_product'){echo 'style="color: white;"';}?>>Danh sách sản phẩm</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?action=list_accessory" class="text-warning"  <?php if(isset($_GET['action']) && $_GET['action']=='agree_order'){ echo 'style="pointer-events: none;"';} if(isset($_GET['action']) && $_GET['action']=='list_accessory'){echo 'style="color: white;"';}?>>Danh sách phụ kiện</a>
                  </li>
                  <li >
                    <a class="nav-link" href="index.php?action=cart" class="text-warning">Giỏ hàng</a>
                  </li>
                  <li class="nav-item">
                  <div id="icon_user_header" class="icon_header">
                      <i id="icon_user" class="fas fa-user"></i>
                            <ul id="login_register_header">
                                <?php if(isset($_SESSION['remember_username_login']) && isset($_SESSION['remember_email_login']) && isset($_SESSION['remember_phone_number_login'])){
                                    echo '<li><a id="login_header" href="../controller/index.php?action=account_info">'.$_SESSION['remember_username_login'].'</a></li>';
                                    echo '<li><a id="register_header" href="../controller/index.php?action=logout">Đăng xuất</a></li>';
                                }else{ ?>

                                <li><a id="login_header" href="../controller/index.php?action=login">Đăng nhập</a></li><!-- bổ sung href  -->
                                <li><a id="register_header" href="../controller/index.php?action=register">Đăng ký</a></li><!-- bổ sung href  -->
                                <?php }?>
                            </ul>
                        </div>
                  </li>
              </ul>
            </nav>
        </div>
  </header>