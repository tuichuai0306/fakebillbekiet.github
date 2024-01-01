<?php
require($_SERVER['DOCUMENT_ROOT'].'/files/functions.php');
session_start();
if(!isset($_SESSION['username'])){
    die();
}
if($_SESSION['username'] !== 'admin'){
    die();
}
echo getBegin($l['page-title'].' - '.$l['home-title'],$l['home-description'],$l['home-keyword'],$image);
include $_SERVER['DOCUMENT_ROOT'].'/files/sidebar.php';
$tienweb = file_get_contents($domain_api.'/api/get-price.php');
?>
<div class="container-xxl flex-grow-1 container-p-y">

  
 <div class="row justify-content-center">
     <div class="col-md-4">
         <?php
         if(isset($_POST['type'])){
    $username = $_POST['username'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    if($type == 'cong'){
        DB::query("UPDATE users SET sodu=sodu+$amount WHERE username = '$username'");
    }
    if($type == 'tru'){
        DB::query("UPDATE users SET sodu=sodu-$amount WHERE username = '$username'");
    }
    echo thongbao('success','Thành công!');
}
?>
<form action="" method="POST">
     <input class="form-control mb-2" placeholder="Username cần cộng" name="username" type="text"/>
    <input class="form-control mb-2" placeholder="Số tiền cần cộng" name="amount" type="number"/>
    <select name="type" class="form-control">
        <option value="cong">Cộng tiền</option>
        <option value="tru">Trừ tiền</option>
    </select>
    <button class="btn btn-primary mt-2">Thao tác</button>
</form>
     </div>
    <div class="col-md-4">
        <div class="alert alert-primary mb-3">
            Giá tiền bill gốc: <b><?=number_format($tienweb)?>vnđ</b><br/>
            Giá bill web: <b><?=number_format($tiengoc)?>đ</b><br/>
            Lãi/bill: <b style="color:green"><?=number_format($tiengoc-$tienweb)?>đ</b>
        </div>
        <div class="alert alert-info">
            <?php

$json = json_decode(file_get_contents('https://demo.fakebillck.com/api/api-get-users.php?key='.$key), true);

// Kiểm tra xem có lỗi khi giải mã JSON hay không
if ($json === null) {
    die('Error decoding JSON');
}

// Vì dữ liệu JSON là mảng, nên truy cập 'sodu' như sau:
echo 'Số dư nguồn: <b>'.$json[0]['sodu'].'</b> (vui lòng nạp thêm nếu quá ít)';
if(isset($_POST['key'])){
    DB::update('settings', [
    'keysr' => trim($_POST['key']),
    'title' => trim($_POST['title']),
    'description' => trim($_POST['description']),
    'price' => trim($_POST['price']),
    'stk' => trim($_POST['stk']),
    'name' => trim($_POST['name']),
    'bank' => trim($_POST['bank'])
], "id=%s", 1);
header('Refresh:0');
}

            ?>
           
        </div>
         <form action="" method="POST">
                <div class="mb-3">
                    <label>Serial key</label>
                    <input class="form-control" value="<?=$key?>" name="key"/>
                </div>
                 <div class="mb-3">
                    <label>Tiêu đề</label>
                    <input class="form-control" value="<?=$webinfo['title']?>" name="title"/>
                </div>
                 <div class="mb-3">
                    <label>Mô tả</label>
                    <textarea class="form-control"  name="description" rows="6"><?=$webinfo['description']?></textarea>
                </div>
                 <div class="mb-3">
                    <label>Giá bill web</label>
                    <input class="form-control" value="<?=$webinfo['price']?>" name="price"/>
                </div>
                  <div class="mb-3">
                    <label>STK nạp tiền</label>
                    <input class="form-control" value="<?=$webinfo['stk']?>" name="stk"/>
                </div>
                  <div class="mb-3">
                    <label>Tên STK nạp tiền</label>
                    <input class="form-control" value="<?=$webinfo['name']?>" name="name"/>
                </div>
                  <div class="mb-3">
                    <label>Ngân hàng nạp tiền</label>
                 

  <input class="form-control" value="<?=$webinfo['bank']?>" name="bank"/>

                </div>
                <button class="btn btn-primary">Lưu thông tin</button>
            </form>
    </div>

        

 </div>

 <?php

 if(isset($_SESSION['username'])){?>
 
 <?php } else { ?>

 <?php } ?>

    </div>
 
<?=getFooter($l['page-title'])?>

            