<?php

require_once __DIR__.'/files/functions.php';
echo getBegin($l['page-title'].' - '.$l['home-title'],$l['home-description'],$l['home-keyword'],$image);
include 'files/sidebar.php';
?>
<div class="container-xxl flex-grow-1 container-p-y">

  
 <div class="row justify-content-center">
   <div class="col-md-6">
       <?php if($_SESSION['username'] == 'admin'){ 
       echo thongbao('success','Truy cập bảng quản trị: <a href="admin">tại đây</a>');
       }?>
         <?=thongbao('primary',str_replace("\n",'<br/>',$webinfo['description']))?>
   </div>
         <?php
// Lấy dữ liệu từ URL
$url = $domain_api."/api/get-list-bank.php";
$response = file_get_contents($url);

// Kiểm tra xem có lỗi không
if ($response === FALSE) {
    die('Error occurred while fetching data');
}

// Chuyển đổi JSON thành mảng PHP
$data = json_decode($response, true);

// Kiểm tra xem có dữ liệu không
if ($data === NULL) {
    die('Error occurred while decoding JSON');
}

// Bắt đầu xây dựng HTML
$html = '';

foreach ($data as $bank) {
    $html .= '<div class="col-6 col-sm-4 col-md-3 col-xl-2 mb-3"><div class="card">
        <div class="card-body">
            <a href="fake-bill-' . $bank['file_name'] . '?type=ios" style="    color: #000;">
            <img src="https://api.sieutool.com/' . $bank['icon'] . '" width="50px" class="rounded d-block m-auto mb-2">
            <div class="text-center">
                <span>' . $bank['name'] . '</span>
                
            </div></a>
        </div>
    </div></div>';
   
}



// Hiển thị HTML
echo $html;
?>

        

 </div>
   <form action="" method="POST" id="buyvv">
       <input hidden name="billck" id="billck" value="buy"/>
   </form>    

 <script>
      

function MuaVV(songay){
    document.getElementById('billck').value = songay;
    $("#buyvv").submit();
}

</script>

 <?php

 if(isset($_SESSION['username'])){?>
 
 <?php } else { ?>

 <?php } ?>

    </div>
 
<?=getFooter($l['page-title'])?>

            