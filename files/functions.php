<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.gc_maxlifetime', 2628000);

    // each client should remember their session id for EXACTLY 1 hour
    session_set_cookie_params(2628000);
    
    session_start();
}
 ob_start();
require $_SERVER['DOCUMENT_ROOT'].'/vendor/autoload.php';
use Melbahja\Seo\MetaTags;

DB::$user = 'webcon';
DB::$password = 'webcon';
DB::$dbName = 'webcon';
DB::$encoding = 'utf8'; 
$webinfo = DB::queryFirstRow("SELECT * FROM settings");
$accessCountFile = $_SERVER['DOCUMENT_ROOT'].'/access_count.txt';

// Kiểm tra xem tệp tồn tại
if (file_exists($accessCountFile)) {
    // Đọc số lượt truy cập hiện tại từ tệp
    $accessCount = (int)file_get_contents($accessCountFile);

    // Tăng giá trị số lượt truy cập lên 1
    $accessCount++;

    // Ghi lại giá trị mới vào tệp
    file_put_contents($accessCountFile, $accessCount);


} else {
    // Nếu tệp không tồn tại, tạo tệp và ghi giá trị ban đầu là 1
    file_put_contents($accessCountFile, 1);

}
function url123() {
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];

    $base_url = $protocol . $host;
    return $base_url;
}
 
function xss_clean($data)
{
// Fix &entity\n;
$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

// Remove any attribute starting with "on" or xmlns
$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

// Remove javascript: and vbscript: protocols
$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

// Remove namespaced elements (we do not need them)
$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

do
{
    // Remove really unwanted tags
    $old_data = $data;
    $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
}
while ($old_data !== $data);

// we are done...
return $data;
}
$domain = url123();
$image = 'https://sieutool.com/uploads/651af1a623881.jpg';
$fbadmin = 'https://facebook.com/vhuunhan';


$user_new = DB::queryFirstRow("SELECT * FROM users WHERE username=%s", $_SESSION['username']);

$avatargoc = 'https://media.istockphoto.com/id/1327592449/vector/default-avatar-photo-placeholder-icon-grey-profile-picture-business-man.jpg?s=612x612&w=0&k=20&c=yqoos7g9jmufJhfkbQsk-mdhKEsih6Di4WZ66t_ib7I=';
if(!empty($user_new['avatar'])){
    $myavt = $domain.'/'.$user_new['avatar'].'?'.rand();
} else {
    $myavt = $avatargoc;
}
$key = $webinfo['keysr'];
$domain_api = 'https://demo.fakebillck.com';
$tiengoc = $webinfo['price'];
$tiengoc1 = 15000;
$tiengoc2 = 10000;
$tiengoc3 = 7500;
function formatTimeAgo($time) {
    // Chuyển thời gian cụ thể thành timestamp
    $timestamp = strtotime($time);

    // Thời gian hiện tại
    $currentTimestamp = time();

    // Tính khoảng thời gian giữa hai thời điểm
    $diff = $currentTimestamp - $timestamp;

    if ($diff < 60) {
        return $diff . " giây trước";
    } elseif ($diff < 3600) {
        $minutes = floor($diff / 60);
        return $minutes . " phút trước";
    } elseif ($diff < 86400) {
        $hours = floor($diff / 3600);
        return $hours . " giờ trước";
    } elseif ($diff < 604800) {
        $days = floor($diff / 86400);
        return $days . " ngày trước";
    } else {
        // Nếu đã qua một tuần, trả về thời gian dưới dạng ngày/tháng/năm
        return date("d/m/Y", $timestamp);
    }
}


function getUrl(){
    return (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}
function getBegin($title,$description,$keyword,$image){
    $metatags = new MetaTags();
    $metatags
        ->title($title)
        ->description($description)
        ->meta('author', 'Vo Huu Nhan')
        ->image($image)
         ->canonical(url123())
        ->url(getUrl());
    $html = '<!DOCTYPE html>
<html
  lang="vi"
  class="light-style layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="'.$domain.'/assets/"
  data-template="horizontal-menu-template-starter">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
'; $html .= $metatags;
    $html .= '
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <meta name="viewport" 
      content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
      		<link rel="icon" href="6080679.png" />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
      rel="stylesheet" />

    <link rel="stylesheet" href="'.$domain.'/assets/vendor/fonts/materialdesignicons.css" />
    <!-- <link rel="stylesheet" href="'.$domain.'/assets/vendor/fonts/flag-icons.css" /> -->

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="'.$domain.'/assets/vendor/libs/node-waves/node-waves.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="'.$domain.'/assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="'.$domain.'/assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="'.$domain.'/assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="'.$domain.'/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="'.$domain.'/assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="'.$domain.'/assets/vendor/js/template-customizer.js"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="'.$domain.'/assets/js/config.js?'.rand().'"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.11/dist/clipboard.min.js"></script>
<link rel="stylesheet" href="'.$domain.'/assets/vendor/libs/toastr/toastr.css" />


    </head>';
    
    return $html;
}

function getFooter($title){
    $html = '
    <script>


 </script>
       <!-- Footer -->
            <footer class="content-footer footer bg-footer-theme">
              <div class="container-xxl">
                <div
                  class="footer-container d-flex align-items-center justify-content-between py-3 flex-md-row flex-column">
                
                  <div class="d-none d-lg-inline-block">
                  
                  </div>
                </div>
              </div>
            </footer>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
          </div>
          <!--/ Content wrapper -->
        </div>

        <!--/ Layout container -->
      </div>
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>

    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

    <!--/ Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="'.$domain.'/assets/vendor/libs/jquery/jquery.js"></script>
    <script src="'.$domain.'/assets/vendor/libs/popper/popper.js"></script>
    <script src="'.$domain.'/assets/vendor/js/bootstrap.js"></script>
    <script src="'.$domain.'/assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="'.$domain.'/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="'.$domain.'/assets/vendor/libs/hammer/hammer.js"></script>

    <script src="'.$domain.'/assets/vendor/js/menu.js"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="'.$domain.'/assets/js/main.js"></script>

    <!-- Page JS -->
    <script>
    function showToastrNotification(status, message, title) {
    var toastrType = status === "success" ? "success" : "error"; 
    toastr[toastrType](message, title);
    
}</script>
<link rel="stylesheet" href="'.$domain.'/assets/vendor/libs/animate-css/animate.css" />
<link rel="stylesheet" href="'.$domain.'/assets/vendor/libs/sweetalert2/sweetalert2.css" />
<script src="'.$domain.'/assets/vendor/libs/sweetalert2/sweetalert2.js" />

  <script src="'.$domain.'/assets/vendor/libs/toastr/toastr.js"></script>
 
  </body>
</html>
';
    return $html;
}

$l = array(
    'home-noti' => 'Phiên bản mới đã bổ sung thêm tính năng đăng nhập, giúp bạn có thể lưu lại quá trình làm việc và lịch sử chạy tool.<br/>SieuTool cam kết không sử dụng thông tin cá nhân của khách hàng vào mục đích bất chính.',
    'home-title' => 'Fake Bill Chuyển Khoản',
    'home-description' => 'sieutool',
    'home-keyword' => 'sieutool',
    'page-title' => $webinfo['title'],
    'text-home' => 'Trang chủ',
    'text-login' => 'Đăng nhập',
    'text-reg' => 'Đăng ký',
    'admin-name' => 'Vo Huu Nhan',
    'quote' => 'Người yêu cũ của bạn chắc gì đã tốt hơn <b>SieuTool</b>?'
    );

function thongbao($status,$content){
    if($status == 'error'){
        $status = 'danger';
    }
   return '<div class="mt-3 alert alert-'.$status.'" role="alert">
  '.$content.'
</div>';
}

function fakebillck($bank,$stk_nhan,$name_nhan,$bank_gui,$stk_gui,$name_gui,$time,$noidung,$magd,$sotiengd,$hinhthucck,$banknhan,$logobanknhan){
    $bank = strtolower($bank);
      if($bank == 'agribank'){
        // Đường dẫn đến ảnh gốc
        $filePath = $_SERVER['DOCUMENT_ROOT'].'/billck/'.$bank.'.jpg';
$fontPath = $_SERVER['DOCUMENT_ROOT'].'/billck/FONT';

// Tạo một hình ảnh mới từ ảnh gốc
$image = imagecreatefromjpeg($filePath);

function canlephai($image,$fontsize,$y,$textColor,$font,$text){

    
    // Thiết lập kích thước font chữ
    $fontSize = $fontsize;
    

    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $x = imagesx($image) - 80 - $textWidth;
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);

}
function canletrai($image,$fontsize,$y,$textColor,$font,$text,$x_tcb){

    
    // Thiết lập kích thước font chữ
    $fontSize = $fontsize;
    

    imagettftext($image, $fontSize, 0, $x_tcb, $y, $textColor, $font, $text);

}
function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text) {
    $fontSize = $fontsize;
    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $imageWidth = imagesx($image);
    $x = ($imageWidth - $textWidth) / 2; // Căn giữa theo chiều ngang
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
}



canletrai($image, 41, 900, imagecolorallocate($image, 74, 74, 74), $fontPath.'/Inter/Inter-Regular.ttf', $stk_nhan,90);
canletrai($image, 41, 1110, imagecolorallocate($image, 225, 114, 28), $fontPath.'/Inter/Inter-Medium.ttf', strtoupper($name_nhan),90);
canletrai($image, 41, 1320, imagecolorallocate($image, 74, 74, 74), $fontPath.'/Inter/Inter-Regular.ttf', $magd,90);
canletrai($image, 41, 1520, imagecolorallocate($image, 74, 74, 74), $fontPath.'/Inter/Inter-Regular.ttf', $banknhan,90);
canletrai($image, 41, 1940, imagecolorallocate($image, 74, 74, 74), $fontPath.'/Inter/Inter-Regular.ttf', $time,90);
canletrai($image, 41, 2150, imagecolorallocate($image, 74, 74, 74), $fontPath.'/Inter/Inter-Regular.ttf', $noidung,90);
canletrai($image, 55, 672, imagecolorallocate($image, 255, 255, 255), $fontPath.'/Inter/Inter-Bold.ttf', number_format($sotiengd, 0, ',', ',').' VND',105);
imagettftext($image, 40, 0, 130, 110, imagecolorallocate($image, 0, 0, 0), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', date("g:i"));
// Tạo buffer để lưu trữ ảnh
ob_start();

// Đầu ra hình ảnh dưới dạng JPEG
imagejpeg($image);

// Lấy dữ liệu từ buffer
$imageData = ob_get_clean();

// Chuyển đổi dữ liệu ảnh thành mã base64
$base64 = base64_encode($imageData);

// Đưa ra mã HTML để hiển thị ảnh
$html = '<img src="data:image/jpeg;base64,' . $base64 . '"  alt="Image" />';

// Giải phóng bộ nhớ và hủy hình ảnh
imagedestroy($image);

return $html;
    }
     if($bank == 'acb'){
        // Đường dẫn đến ảnh gốc
        $filePath = $_SERVER['DOCUMENT_ROOT'].'/billck/'.$bank.'.png';
$fontPath = $_SERVER['DOCUMENT_ROOT'].'/billck/FONT';

// Tạo một hình ảnh mới từ ảnh gốc
$image = imagecreatefrompng($filePath);

function canlephai($image,$fontsize,$y,$textColor,$font,$text){

    
    // Thiết lập kích thước font chữ
    $fontSize = $fontsize;
    

    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $x = imagesx($image) - 100 - $textWidth;
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);

}
function canletrai($image,$fontsize,$y,$textColor,$font,$text){

    
    // Thiết lập kích thước font chữ
    $fontSize = $fontsize;
    

    imagettftext($image, $fontSize, 0, 140, $y, $textColor, $font, $text);

}
function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text) {
    $fontSize = $fontsize;
    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $imageWidth = imagesx($image);
    $x = ($imageWidth - $textWidth) / 2; // Căn giữa theo chiều ngang
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
} 

$dateString = $time;

// Sử dụng explode()
$dateArray = explode(' - ', $dateString);
$datePart = $dateArray[0]; // Lấy phần tử đầu tiên

// Sử dụng substr()
$datePart = substr($dateString, 0, strpos($dateString, ' - '));
function convert_number_to_words($number)
{
    if (strpos($number, '.')) {//có phần lẻ thập phân
        list($integer, $fraction) = explode(".", (string)$number);
    } else { //không có phần lẻ
        $integer = $number;
        $fraction = NULL;
    }

    $output = "";

    if ($integer[0] == "-") {
        $output = "âm ";
        $integer = ltrim($integer, "-");
    } else if ($integer[0] == "+") {
        $output = "dương ";
        $integer = ltrim($integer, "+");
    }

    if ($integer[0] == "0") {
        $output .= "không";
    } else {
        $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
        $group = rtrim(chunk_split($integer, 3, " "), " ");
        $groups = explode(" ", $group);

        $groups2 = array();
        foreach ($groups as $g) {
            $groups2[] = convertThreeDigit($g[0], $g[1], $g[2]);
        }

        for ($z = 0; $z < count($groups2); $z++) {
            if ($groups2[$z] != "") {
                $output .= $groups2[$z] . convertGroup(11 - $z) . (
                    $z < 11
                    && !array_search('', array_slice($groups2, $z + 1, -1))
                    && $groups2[11] != ''
                    && $groups[11][0] == '0'
                        ? " "
                        : ", "
                    );
            }
        }

        $output = rtrim($output, ", ");
    }

    if ($fraction > 0) {
        $output .= " phẩy";
        for ($i = 0; $i < strlen($fraction); $i++) {
            $output .= " " . convertDigit($fraction[$i]);
        }
    }

    return $output;
}

function convertGroup($index)
{
    switch ($index) {
        case 11:
            return " decillion";
        case 10:
            return " nonillion";
        case 9:
            return " octillion";
        case 8:
            return " septillion";
        case 7:
            return " sextillion";
        case 6:
            return " quintrillion";
        case 5:
            return " nghìn triệu triệu";
        case 4:
            return " nghìn tỷ";
        case 3:
            return " tỷ";
        case 2:
            return " triệu";
        case 1:
            return " nghìn";
        case 0:
            return "";
    }
}

function convertThreeDigit($digit1, $digit2, $digit3)
{
    $buffer = "";

    if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0") {
        return "";
    }

    if ($digit1 != "0") {
        $buffer .= convertDigit($digit1) . " trăm";
        if ($digit2 != "0" || $digit3 != "0") {
            $buffer .= " ";
        }
    }

    if ($digit2 != "0") {
        $buffer .= convertTwoDigit($digit2, $digit3);
    } else if ($digit3 != "0") {
        $buffer .= convertDigit($digit3);
    }

    return $buffer;
}

function convertTwoDigit($digit1, $digit2)
{
    if ($digit2 == "0") {
        switch ($digit1) {
            case "1":
                return "mười";
            case "2":
                return "hai mươi";
            case "3":
                return "ba mươi";
            case "4":
                return "bốn mươi";
            case "5":
                return "năm mươi";
            case "6":
                return "sáu mươi";
            case "7":
                return "bảy mươi";
            case "8":
                return "tám mươi";
            case "9":
                return "chín mươi";
        }
    } else if ($digit1 == "1") {
        switch ($digit2) {
            case "1":
                return "mười một";
            case "2":
                return "mười hai";
            case "3":
                return "mười ba";
            case "4":
                return "mười bốn";
            case "5":
                return "mười lăm";
            case "6":
                return "mười sáu";
            case "7":
                return "mười bảy";
            case "8":
                return "mười tám";
            case "9":
                return "mười chín";
        }
    } else {
        $temp = convertDigit($digit2);
        if ($temp == 'năm') $temp = 'lăm';
        if ($temp == 'một') $temp = 'mốt';
        switch ($digit1) {
            case "2":
                return "hai mươi $temp";
            case "3":
                return "ba mươi $temp";
            case "4":
                return "bốn mươi $temp";
            case "5":
                return "năm mươi $temp";
            case "6":
                return "sáu mươi $temp";
            case "7":
                return "bảy mươi $temp";
            case "8":
                return "tám mươi $temp";
            case "9":
                return "chín mươi $temp";
        }
    }
}

function convertDigit($digit)
{
    switch ($digit) {
        case "0":
            return "không";
        case "1":
            return "một";
        case "2":
            return "hai";
        case "3":
            return "ba";
        case "4":
            return "bốn";
        case "5":
            return "năm";
        case "6":
            return "sáu";
        case "7":
            return "bảy";
        case "8":
            return "tám";
        case "9":
            return "chín";
    }
}

canlephai($image, 38, 2410, imagecolorallocate($image, 9, 42, 137), $fontPath.'/Helvetica-Font/Helvetica.ttf', $noidung);
canlephai($image, 37, 1745, imagecolorallocate($image, 0, 1, 2), $fontPath.'/Helvetica-Font/Helvetica.ttf', $stk_nhan);
canlephai($image, 37, 1565, imagecolorallocate($image, 0, 1, 2), $fontPath.'/Helvetica-Font/Helvetica.ttf', $banknhan);
canlephai($image, 37, 1455, imagecolorallocate($image, 0, 1, 2), $fontPath.'/Helvetica-Font/Helvetica.ttf', $name_nhan);
canletrai($image, 37, 1140, imagecolorallocate($image, 0, 37, 127), $fontPath.'/Helvetica-Font/Helvetica.ttf', $name_gui);
canletrai($image, 37, 1200, imagecolorallocate($image, 0, 37, 127), $fontPath.'/Helvetica-Font/Helvetica-Bold.ttf', $stk_gui);
canletrai($image, 35, 630, imagecolorallocate($image, 72, 72, 72), $fontPath.'/Helvetica-Font/Helvetica.ttf', 'Ngày lập lệnh');
canletrai($image, 35, 750, imagecolorallocate($image, 72, 72, 72), $fontPath.'/Helvetica-Font/Helvetica.ttf', 'Ngày hiệu lực');
canlephai($image, 35, 630, imagecolorallocate($image, 72, 72, 72), $fontPath.'/Helvetica-Font/Helvetica.ttf', $time);
canlephai($image, 35, 750, imagecolorallocate($image, 72, 72, 72), $fontPath.'/Helvetica-Font/Helvetica.ttf', $datePart);
canchinhgiua($image, 45, 280, imagecolorallocate($image, 13, 107, 194), $fontPath.'/Helvetica-Font/UTM HelveBold.ttf', number_format($sotiengd, 0, '.', '.') . ' VND');
canchinhgiua($image, 30, 350, imagecolorallocate($image, 72, 72, 72), $fontPath.'/Helvetica-Font/Helvetica.ttf', ucfirst(convert_number_to_words($sotiengd)).' đồng');
// Tạo buffer để lưu trữ ảnh
ob_start();

// Đầu ra hình ảnh dưới dạng JPEG
imagejpeg($image);

// Lấy dữ liệu từ buffer
$imageData = ob_get_clean();

// Chuyển đổi dữ liệu ảnh thành mã base64
$base64 = base64_encode($imageData);

// Đưa ra mã HTML để hiển thị ảnh
$html = '<img src="data:image/jpeg;base64,' . $base64 . '"  alt="Image" />';

// Giải phóng bộ nhớ và hủy hình ảnh
imagedestroy($image);

return $html;
    }
    
       if($bank == 'momo'){
          function alignRight($image, $text, $font, $size, $color, $y,$nhan=90)
        {
            $bbox = imagettfbbox($size, 0, $font, $text);
            $text_width = $bbox[2] - $bbox[0];
            $x = imagesx($image) - $text_width - $nhan; // Điều chỉnh giá trị 10 tùy theo lề phải mong muốn
            imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
        }
        function alignCenter($image, $text, $font, $size, $color, $y)
{
    $bbox = imagettfbbox($size, 0, $font, $text);
    $text_width = $bbox[2] - $bbox[0];
    $x = (imagesx($image) - $text_width) / 2;
    imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
}

    $source_img = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'].'/billck/'.$bank.'.jpg');
         $width = imagesx($source_img);
        $height = imagesy($source_img);
        $dest_img = imagecreatetruecolor($width, $height);

        // Copy ảnh gốc vào ảnh mới
        imagecopy($dest_img, $source_img, 0, 0, 0, 0, $width, $height);

        // Thiết lập font

        // Hàm căn lề phải


        // Vẽ chữ lên ảnh mới với căn lề phải
        imagettftext($dest_img, 31, 0, 288, 262, imagecolorallocate($dest_img, 114, 114, 114), $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/Inter/Inter-Regular.ttf', mb_strtoupper('chuyển tiền đến '.$name_nhan, 'UTF-8'));
        imagettftext($dest_img, 49, 0, 330, 350, imagecolorallocate($dest_img, 49, 50, 52), $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/Inter/Inter-Bold.ttf', number_format($sotiengd, 0, ',', '.').'đ');
        alignRight($dest_img, $time, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/Inter/Inter-SemiBold.ttf', 36, imagecolorallocate($dest_img, 49, 50 ,52), 570);
        alignRight($dest_img, str_pad(random_int(0, 99999999999), 11, '0', STR_PAD_LEFT), $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/Inter/Inter-SemiBold.ttf', 36, imagecolorallocate($dest_img, 49, 50 ,52), 713,145);
         alignRight($dest_img, mb_convert_case($name_nhan, MB_CASE_TITLE, "UTF-8"), $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/Inter/Inter-SemiBold.ttf', 36, imagecolorallocate($dest_img, 49, 50 ,52), 1205);
         alignRight($dest_img, mb_convert_case($stk_nhan, MB_CASE_TITLE, "UTF-8"), $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/Inter/Inter-SemiBold.ttf', 36, imagecolorallocate($dest_img, 49, 50 ,52), 1405);
        // Chuyển đổi ảnh mới sang định dạng base64
        ob_start();
        imagejpeg($dest_img, null, 100);
        $contents = ob_get_contents();
        ob_end_clean();
        $base64 = base64_encode($contents);

        // Trả về thẻ img chứa ảnh base64
        return '<img  src="data:image/jpeg;base64,' . $base64 . '"/>';
    }
    if($bank == 'vietinbank'){
          function alignRight($image, $text, $font, $size, $color, $y,$nhan=50)
        {
            $bbox = imagettfbbox($size, 0, $font, $text);
            $text_width = $bbox[2] - $bbox[0];
            $x = imagesx($image) - $text_width - $nhan; // Điều chỉnh giá trị 10 tùy theo lề phải mong muốn
            imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
        }
        function alignCenter($image, $text, $font, $size, $color, $y)
{
    $bbox = imagettfbbox($size, 0, $font, $text);
    $text_width = $bbox[2] - $bbox[0];
    $x = (imagesx($image) - $text_width) / 2;
    imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
}

    $source_img = imagecreatefromjpeg($_SERVER['DOCUMENT_ROOT'].'/billck/'.$bank.'.jpg');
         $width = imagesx($source_img);
        $height = imagesy($source_img);
        $dest_img = imagecreatetruecolor($width, $height);

        // Copy ảnh gốc vào ảnh mới
        imagecopy($dest_img, $source_img, 0, 0, 0, 0, $width, $height);

        // Thiết lập font

        // Hàm căn lề phải
function convertCurrencyToWords($amount)
{
         if($amount <=0)
        {
            return $textnumber="Tiền phải là số nguyên dương lớn hơn số 0";
        }
        $Text=array("không", "một", "hai", "ba", "bốn", "năm", "sáu", "bảy", "tám", "chín");
        $TextLuythua =array("","nghìn", "triệu", "tỷ", "ngàn tỷ", "triệu tỷ", "tỷ tỷ");
        $textnumber = "";
        $length = strlen($amount);
       
        for ($i = 0; $i < $length; $i++)
        $unread[$i] = 0;
       
        for ($i = 0; $i < $length; $i++)
        {              
            $so = substr($amount, $length - $i -1 , 1);               
           
            if ( ($so == 0) && ($i % 3 == 0) && ($unread[$i] == 0)){
                for ($j = $i+1 ; $j < $length ; $j ++)
                {
                    $so1 = substr($amount,$length - $j -1, 1);
                    if ($so1 != 0)
                        break;
                }                      
                      
                if (intval(($j - $i )/3) > 0){
                    for ($k = $i ; $k <intval(($j-$i)/3)*3 + $i; $k++)
                        $unread[$k] =1;
                }
            }
        }
       
        for ($i = 0; $i < $length; $i++)
        {       
            $so = substr($amount,$length - $i -1, 1);      
            if ($unread[$i] ==1)
            continue;
           
            if ( ($i% 3 == 0) && ($i > 0))
            $textnumber = $TextLuythua[$i/3] ." ". $textnumber;    
           
            if ($i % 3 == 2 )
            $textnumber = 'trăm ' . $textnumber;
           
            if ($i % 3 == 1)
            $textnumber = 'mươi ' . $textnumber;
           
           
            $textnumber = $Text[$so] ." ". $textnumber;
        }
       
        //Phai de cac ham replace theo dung thu tu nhu the nay
        $textnumber = str_replace("không mươi", "lẻ", $textnumber);
        $textnumber = str_replace("lẻ không", "", $textnumber);
        $textnumber = str_replace("mươi không", "mươi", $textnumber);
        $textnumber = str_replace("một mươi", "mười", $textnumber);
        $textnumber = str_replace("mươi năm", "mươi lăm", $textnumber);
        $textnumber = str_replace("mươi một", "mươi mốt", $textnumber);
        $textnumber = str_replace("mười năm", "mười lăm", $textnumber);
       
        return ucfirst($textnumber."đồng");
}

        // Vẽ chữ lên ảnh mới với căn lề phải
        alignRight($dest_img, $time, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy SemiBold.otf', 24, imagecolorallocate($dest_img, 133, 146, 151), 300);
        alignRight($dest_img, $magd, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy SemiBold.otf', 24, imagecolorallocate($dest_img, 133, 146, 151), 350);
        alignRight($dest_img, '*******' . $stk_di, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy Medium.otf', 30, imagecolorallocate($dest_img, 13, 42, 70), 730);
        alignRight($dest_img, $name_gui, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy Medium.otf', 30, imagecolorallocate($dest_img, 13, 42, 70), 790);
        alignRight($dest_img, $stk_nhan, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy Bold.otf', 30, imagecolorallocate($dest_img, 13, 42, 70), 890);
        alignRight($dest_img, $name_nhan, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy Bold.otf', 30, imagecolorallocate($dest_img, 13, 42, 70), 945);
        alignRight($dest_img, $bank_nhan, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy Medium.otf', 30, imagecolorallocate($dest_img, 13, 42, 70), 1050);
        alignRight($dest_img, number_format($sotiengd).' VND', $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy XBold.otf', 30, imagecolorallocate($dest_img, 4, 88, 146), 1190);
        $text = str_replace("nghìn","\n nghìn",convertCurrencyToWords($sotiengd));
        $lines = explode("\n", $text);

foreach ($lines as $key => $line) {
    if ($line === reset($lines)) {
         alignRight($dest_img, $line, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy XBold.otf', 30, imagecolorallocate($dest_img, 4, 88, 146), 1250);
    } else {
       alignRight($dest_img, $line, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy XBold.otf', 30, imagecolorallocate($dest_img, 4, 88, 146), 1300);
    }
}
      
        alignRight($dest_img, 'Miễn phí', $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy Medium.otf', 30, imagecolorallocate($dest_img, 13, 42, 70), 1350);
        alignRight($dest_img, $noidung, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy Medium.otf', 30, imagecolorallocate($dest_img, 13, 42, 70), 1445);

        // Chuyển đổi ảnh mới sang định dạng base64
        ob_start();
        imagejpeg($dest_img, null, 100);
        $contents = ob_get_contents();
        ob_end_clean();
        $base64 = base64_encode($contents);

        // Trả về thẻ img chứa ảnh base64
        return '<img  src="data:image/jpeg;base64,' . $base64 . '"/>';
    }
  if($bank == 'tcb'){
        // Đường dẫn đến ảnh gốc
        $filePath = $_SERVER['DOCUMENT_ROOT'].'/billck/'.$bank.'.png';
$fontPath = $_SERVER['DOCUMENT_ROOT'].'/billck/FONT';

// Tạo một hình ảnh mới từ ảnh gốc
$image = imagecreatefrompng($filePath);
function canletrai($image,$fontsize,$y,$textColor,$font,$text,$x_tcb){

    
    // Thiết lập kích thước font chữ
    $fontSize = $fontsize;
    

    imagettftext($image, $fontSize, 0, $x_tcb, $y, $textColor, $font, $text);

}
function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text) {
    $fontSize = $fontsize;
    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $imageWidth = imagesx($image);
    $x = ($imageWidth - $textWidth) / 2; // Căn giữa theo chiều ngang
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
}



canletrai($image, 135, 2230, imagecolorallocate($image, 0, 0, 0), $fontPath.'/San Francisco/SanFranciscoDisplay-Semibold.otf', 'tới '.strtoupper($name_nhan),150);
canletrai($image, 137, 2435, imagecolorallocate($image, 0, 0, 0), $fontPath.'/San Francisco/SanFranciscoDisplay-Semibold.otf', number_format($sotiengd, 0, ',', ','),580);
canletrai($image, 87, 2920, imagecolorallocate($image, 0, 0, 0), $fontPath.'/San Francisco/SanFranciscoDisplay-Semibold.otf', $banknhan,155);
canletrai($image, 87, 3050, imagecolorallocate($image, 0, 0, 0), $fontPath.'/San Francisco/SanFranciscoDisplay-Semibold.otf', $stk_nhan,155);
canletrai($image, 87, 3470, imagecolorallocate($image, 0, 0, 0), $fontPath.'/San Francisco/SanFranciscoDisplay-Semibold.otf', $noidung,155);
canletrai($image, 87, 3900, imagecolorallocate($image, 0, 0, 0), $fontPath.'/San Francisco/SanFranciscoDisplay-Semibold.otf', $time,155);
canletrai($image, 87, 4320, imagecolorallocate($image, 0, 0, 0), $fontPath.'/San Francisco/SanFranciscoDisplay-Semibold.otf', $magd,155);
imagettftext($image, 75, 0, 160, 175, imagecolorallocate($image, 0, 0, 0), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', date("g:i"));
// Tạo buffer để lưu trữ ảnh
ob_start();

// Đầu ra hình ảnh dưới dạng JPEG
imagejpeg($image);

// Lấy dữ liệu từ buffer
$imageData = ob_get_clean();

// Chuyển đổi dữ liệu ảnh thành mã base64
$base64 = base64_encode($imageData);

// Đưa ra mã HTML để hiển thị ảnh
$html = '<img src="data:image/jpeg;base64,' . $base64 . '"  alt="Image" />';

// Giải phóng bộ nhớ và hủy hình ảnh
imagedestroy($image);

return $html;
    }
    
    if($bank == 'vietcombank'){
        // Đường dẫn đến ảnh gốc
        $filePath = $_SERVER['DOCUMENT_ROOT'].'/billck/'.$bank.'.png';
$fontPath = $_SERVER['DOCUMENT_ROOT'].'/billck/FONT';

// Tạo một hình ảnh mới từ ảnh gốc
$image = imagecreatefrompng($filePath);

function canlephai($image,$fontsize,$y,$textColor,$font,$text){

    
    // Thiết lập kích thước font chữ
    $fontSize = $fontsize;
    

    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $x = imagesx($image) - 50 - $textWidth;
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);

}
function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text) {
    $fontSize = $fontsize;
    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $imageWidth = imagesx($image);
    $x = ($imageWidth - $textWidth) / 2; // Căn giữa theo chiều ngang
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
}
canlephai($image, 37, 1545, imagecolorallocate($image, 255, 255, 255), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', $noidung);
canlephai($image, 37, 1380, imagecolorallocate($image, 255, 255, 255), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', $magd);
canlephai($image, 37, 1220, imagecolorallocate($image, 255, 255, 255), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', $stk_nhan);
canlephai($image, 37, 1050, imagecolorallocate($image, 255, 255, 255), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', $name_nhan);
canchinhgiua($image, 50, 790, imagecolorallocate($image, 115, 191, 3), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', number_format($sotiengd, 0, ',', ',') . ' VND');
canchinhgiua($image, 25, 850, imagecolorallocate($image, 124, 135, 143), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', $time);
imagettftext($image, 35, 0, 90, 77, imagecolorallocate($image, 255, 255, 255), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', date("g:i"));
// Tạo buffer để lưu trữ ảnh
ob_start();

// Đầu ra hình ảnh dưới dạng JPEG
imagejpeg($image);

// Lấy dữ liệu từ buffer
$imageData = ob_get_clean();

// Chuyển đổi dữ liệu ảnh thành mã base64
$base64 = base64_encode($imageData);

// Đưa ra mã HTML để hiển thị ảnh
$html = '<img src="data:image/jpeg;base64,' . $base64 . '"  alt="Image" />';

// Giải phóng bộ nhớ và hủy hình ảnh
imagedestroy($image);

return $html;
    }
    if($bank == 'mbbank'){
        // Đường dẫn đến ảnh gốc
        $filePath = $_SERVER['DOCUMENT_ROOT'].'/billck/'.$bank.'.png';
$fontPath = $_SERVER['DOCUMENT_ROOT'].'/billck/FONT';

// Tạo một hình ảnh mới từ ảnh gốc
$image = imagecreatefrompng($filePath);

function canlephai($image,$fontsize,$y,$textColor,$font,$text){

    
    // Thiết lập kích thước font chữ
    $fontSize = $fontsize;
    

    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $x = imagesx($image) - 80 - $textWidth;
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);

}
function canletrai($image,$fontsize,$y,$textColor,$font,$text){

    
    // Thiết lập kích thước font chữ
    $fontSize = $fontsize;
    

    imagettftext($image, $fontSize, 0, 220, $y, $textColor, $font, $text);

}
function canchinhgiua($image, $fontsize, $y, $textColor, $font, $text) {
    $fontSize = $fontsize;
    $textBoundingBox = imagettfbbox($fontSize, 0, $font, $text);
    $textWidth = $textBoundingBox[2] - $textBoundingBox[0];
    $imageWidth = imagesx($image);
    $x = ($imageWidth - $textWidth) / 2; // Căn giữa theo chiều ngang
    imagettftext($image, $fontSize, 0, $x, $y, $textColor, $font, $text);
} 


canlephai($image, 37, 1700, imagecolorallocate($image, 0, 0, 0), $fontPath.'/AvertaStd/AvertaStd-Regular.otf', $magd);
canlephai($image, 37, 1605, imagecolorallocate($image, 0, 0, 0), $fontPath.'/AvertaStd/AvertaStd-Regular.otf', $hinhthucck);
canlephai($image, 37, 1515, imagecolorallocate($image, 0, 0, 0), $fontPath.'/AvertaStd/AvertaStd-Regular.otf', $time);
canlephai($image, 37, 1378, imagecolorallocate($image, 0, 0, 0), $fontPath.'/AvertaStd/AvertaStd-Regular.otf', $noidung);
canlephai($image, 37, 1220, imagecolorallocate($image, 0, 0, 0), $fontPath.'/AvertaStd/AvertaStd-Regular.otf', $name_gui);
canlephai($image, 37, 1280, imagecolorallocate($image, 0, 0, 0), $fontPath.'/AvertaStd/AvertaStd-Bold.otf', $stk_gui);
canchinhgiua($image, 75, 455, imagecolorallocate($image, 255, 255, 255), $fontPath.'/AvertaStd/AvertaStd-Bold.otf', number_format($sotiengd, 0, ',', ',') . ' VND');
canletrai($image, 37, 910, imagecolorallocate($image, 0, 0, 0), $fontPath.'/AvertaStd/AvertaStd-Bold.otf', $name_nhan);
canletrai($image, 37, 970, imagecolorallocate($image, 0, 0, 0), $fontPath.'/AvertaStd/AvertaStd-Regular.otf', $stk_nhan);
canletrai($image, 37, 1030, imagecolorallocate($image, 0, 0, 0), $fontPath.'/AvertaStd/AvertaStd-Regular.otf', $banknhan);
imagettftext($image, 32, 0, 80, 81, imagecolorallocate($image, 255, 255, 255), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', date("g:i"));
$childImage = imagecreatefromstring(file_get_contents($logobanknhan));

// Lấy kích thước của ảnh con
$childWidth = imagesx($childImage);
$childHeight = imagesy($childImage);

// Kích thước mới của ảnh con
$newChildWidth = 100;
$newChildHeight = 100;

// Tạo ảnh con mới với kích thước mới
$resizedChildImage = imagescale($childImage, $newChildWidth, $newChildHeight);

// Chèn ảnh con đã co dãn vào hình ảnh chính
imagecopy($image, $resizedChildImage, 75, 880, 0, 0, $newChildWidth, $newChildHeight);

// Giải phóng bộ nhớ ảnh con đã co dãn
imagedestroy($resizedChildImage);
// Tạo buffer để lưu trữ ảnh
ob_start();

// Đầu ra hình ảnh dưới dạng JPEG
imagejpeg($image);

// Lấy dữ liệu từ buffer
$imageData = ob_get_clean();

// Chuyển đổi dữ liệu ảnh thành mã base64
$base64 = base64_encode($imageData);

// Đưa ra mã HTML để hiển thị ảnh
$html = '<img src="data:image/jpeg;base64,' . $base64 . '"  alt="Image" />';

// Giải phóng bộ nhớ và hủy hình ảnh
imagedestroy($image);

return $html;
    }
   
}
function fakeBD($bank,$type,$time,$sotien,$soducuoi,$noidung,$stk){
    $bank = strtolower($bank);
        if($bank == 'vietinbank'){
function alignLeft($image, $text, $font, $size, $color, $y, $nhan = 50)
{
    $bbox = imagettfbbox($size, 0, $font, $text);
    $text_width = $bbox[2] - $bbox[0];
    $x = $nhan; // Điều chỉnh giá trị 10 tùy theo lề trái mong muốn
    imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
}
        function alignCenter($image, $text, $font, $size, $color, $y)
{
    $bbox = imagettfbbox($size, 0, $font, $text);
    $text_width = $bbox[2] - $bbox[0];
    $x = (imagesx($image) - $text_width) / 2;
    imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
}

    $source_img = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/billck/b_'.$bank.'.png');
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/billck/FONT';
         $width = imagesx($source_img);
        $height = imagesy($source_img);
        $dest_img = imagecreatetruecolor($width, $height);

        // Copy ảnh gốc vào ảnh mới
        imagecopy($dest_img, $source_img, 0, 0, 0, 0, $width, $height);



        // Vẽ chữ lên ảnh mới với căn lề phải
        alignLeft($dest_img, $time, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy Medium.otf', 24, imagecolorallocate($dest_img, 6, 42, 70), 635, 140);
        alignLeft($dest_img, $time, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy Medium.otf', 29.5, imagecolorallocate($dest_img, 14, 49, 76), 745, 278);
        alignLeft($dest_img, $stk, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy Medium.otf', 29.5, imagecolorallocate($dest_img, 14, 49, 76), 790, 283);
        if($type == 'out'){
            $les = 'DI';
            alignLeft($dest_img, '-'.number_format($sotien).' VND', $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy Bold.otf', 29.5, imagecolorallocate($dest_img, 215, 18, 73), 834, 285);
        } else if($type == 'in'){
            $les = 'NHAN';
            alignLeft($dest_img, '+'.number_format($sotien).' VND', $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy Bold.otf', 29.5, imagecolorallocate($dest_img, 76, 185, 68), 834, 285);
        }
        alignLeft($dest_img, number_format($soducuoi).' VND', $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy Bold.otf', 29.5, imagecolorallocate($dest_img, 6, 42, 70), 875, 365);
        alignLeft($dest_img, 'CT '.$les.':'.rand(0000000000,999999999999).'; '.$noidung, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/SVN-Gilroy/SVN-Gilroy Medium.otf', 29.5, imagecolorallocate($dest_img, 14, 49, 76), 923, 275);
        imagettftext($dest_img, 41, 0, 130, 110, imagecolorallocate($dest_img, 0, 0, 0), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', date("g:i"));


        // Chuyển đổi ảnh mới sang định dạng base64
        ob_start();
        imagejpeg($dest_img, null, 100);
        $contents = ob_get_contents();
        ob_end_clean();
        $base64 = base64_encode($contents);

        // Trả về thẻ img chứa ảnh base64
        return '<img  src="data:image/jpeg;base64,' . $base64 . '"/>';
    }
    if($bank == 'acb'){
function alignLeft($image, $text, $font, $size, $color, $y, $nhan = 50)
{
    $bbox = imagettfbbox($size, 0, $font, $text);
    $text_width = $bbox[2] - $bbox[0];
    $x = $nhan; // Điều chỉnh giá trị 10 tùy theo lề trái mong muốn
    imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
}
        function alignCenter($image, $text, $font, $size, $color, $y)
{
    $bbox = imagettfbbox($size, 0, $font, $text);
    $text_width = $bbox[2] - $bbox[0];
    $x = (imagesx($image) - $text_width) / 2;
    imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
}

    $source_img = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/billck/b_'.$bank.'.png');
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/billck/FONT';
         $width = imagesx($source_img);
        $height = imagesy($source_img);
        $dest_img = imagecreatetruecolor($width, $height);

        // Copy ảnh gốc vào ảnh mới
        imagecopy($dest_img, $source_img, 0, 0, 0, 0, $width, $height);


        if($type == 'in'){
            $mes = '+';
        } 
        if($type == 'out'){
            $mes = '-';
        }
        // Vẽ chữ lên ảnh mới với căn lề phải
        alignLeft($dest_img, $time, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/Inter/Inter-Light.ttf', 35, imagecolorallocate($dest_img, 51, 51 ,51), 615, 110);
        alignLeft($dest_img, 'ACB: TK '.$stk.' (VND) '.$mes.' '.number_format($sotien).' VND luc ', $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/Inter/Inter-Light.ttf', 35, imagecolorallocate($dest_img, 51, 51 ,51), 795, 110);
        alignLeft($dest_img, $time.'. So du '.number_format($soducuoi), $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/Inter/Inter-Light.ttf', 35, imagecolorallocate($dest_img, 51, 51 ,51), 865, 110);
        alignLeft($dest_img, 'GD: '.rand(00000000,99999).' - '.$noidung, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/Inter/Inter-Light.ttf', 35, imagecolorallocate($dest_img, 51, 51 ,51), 930, 110);
        imagettftext($dest_img, 41, 0, 130, 110, imagecolorallocate($dest_img, 0, 0, 0), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', date("g:i"));


        // Chuyển đổi ảnh mới sang định dạng base64
        ob_start();
        imagejpeg($dest_img, null, 100);
        $contents = ob_get_contents();
        ob_end_clean();
        $base64 = base64_encode($contents);

        // Trả về thẻ img chứa ảnh base64
        return '<img  src="data:image/jpeg;base64,' . $base64 . '"/>';
    }
     if($bank == 'agribank'){
         
function alignLeft($image, $text, $font, $size, $color, $y, $nhan = 50)
{
    $bbox = imagettfbbox($size, 0, $font, $text);
    $text_width = $bbox[2] - $bbox[0];
    $x = $nhan; // Điều chỉnh giá trị 10 tùy theo lề trái mong muốn
    imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
}
        function alignCenter($image, $text, $font, $size, $color, $y)
{
    $bbox = imagettfbbox($size, 0, $font, $text);
    $text_width = $bbox[2] - $bbox[0];
    $x = (imagesx($image) - $text_width) / 2;
    imagettftext($image, $size, 0, $x, $y, $color, $font, $text);
}

    $source_img = imagecreatefrompng($_SERVER['DOCUMENT_ROOT'].'/billck/b_'.$bank.'.png');
    $fontPath = $_SERVER['DOCUMENT_ROOT'].'/billck/FONT';
         $width = imagesx($source_img);
        $height = imagesy($source_img);
        $dest_img = imagecreatetruecolor($width, $height);

        // Copy ảnh gốc vào ảnh mới
        imagecopy($dest_img, $source_img, 0, 0, 0, 0, $width, $height);


        
        // Vẽ chữ lên ảnh mới với căn lề phải
        alignLeft($dest_img, $time, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/Inter/Inter-Medium.ttf', 25, imagecolorallocate($dest_img, 51, 51 ,51), 750, 460);
        alignLeft($dest_img, $stk, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/Inter/Inter-SemiBold.ttf', 35, imagecolorallocate($dest_img, 51, 51 ,51), 1022, 340);
        alignLeft($dest_img, $time, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/Inter/Inter-Regular.ttf', 27, imagecolorallocate($dest_img, 51, 51 ,51), 890, 115);
        if($type == 'in'){
            alignLeft($dest_img, '+'.number_format($sotien).' VND', $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/Inter/Inter-SemiBold.ttf', 35, imagecolorallocate($dest_img, 102, 168, 97), 1100, 360);
        } 
        if($type == 'out'){
            alignLeft($dest_img, '-'.number_format($sotien).' VND', $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/Inter/Inter-SemiBold.ttf', 35, imagecolorallocate($dest_img, 210, 120, 53), 1100, 360);
        }
        imagettftext($dest_img, 41, 0, 130, 110, imagecolorallocate($dest_img, 0, 0, 0), $fontPath.'/San Francisco/SanFranciscoText-Semibold.otf', date("g:i"));
        alignLeft($dest_img, number_format($soducuoi).' VND', $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/Inter/Inter-SemiBold.ttf', 35, imagecolorallocate($dest_img, 51, 51 ,51), 1179, 360);
        alignLeft($dest_img, $noidung, $_SERVER['DOCUMENT_ROOT'].'/billck/FONT/Inter/Inter-SemiBold.ttf', 35, imagecolorallocate($dest_img, 51, 51 ,51), 1259, 330);


        // Chuyển đổi ảnh mới sang định dạng base64
        ob_start();
        imagejpeg($dest_img, null, 100);
        $contents = ob_get_contents();
        ob_end_clean();
        $base64 = base64_encode($contents);

        // Trả về thẻ img chứa ảnh base64
        return '<img  src="data:image/jpeg;base64,' . $base64 . '"/>';
    }
}

function generateRandomString($length = 15) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    return $randomString;
}
if($user_new['serial_key'] == '' || $user_new['serial_key'] == NULL){
    DB::update('users', ['serial_key' => generateRandomString()], "username=%s", $_SESSION['username']);
}
?>

