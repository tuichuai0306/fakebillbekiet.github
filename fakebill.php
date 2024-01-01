<?php
require_once __DIR__.'/files/functions.php';
if(!isset($_GET['name'])){
    header('Location: /');
}


echo getBegin('Fake bill '.$_GET['name'].' - fake bill chuyển tiền ngân hàng '.$_GET['name'].' đơn giản','Fake bil chuyển khoản '.$_GET['name'].'...','',$image);
$dateFormat = 'H:i d/m/Y';
function removeAccents($str) {
    $str = mb_strtolower($str, 'UTF-8');
        $accents = array(
        'à', 'á', 'ạ', 'ả', 'ã', 'â', 'ầ', 'ấ', 'ậ', 'ẩ', 'ẫ', 'ă', 'ằ', 'ắ', 'ặ', 'ẳ', 'ẵ',
        'è', 'é', 'ẹ', 'ẻ', 'ẽ', 'ê', 'ề', 'ế', 'ệ', 'ể', 'ễ',
        'ì', 'í', 'ị', 'ỉ', 'ĩ',
        'ò', 'ó', 'ọ', 'ỏ', 'õ', 'ô', 'ồ', 'ố', 'ộ', 'ổ', 'ỗ', 'ơ', 'ờ', 'ớ', 'ợ', 'ở', 'ỡ',
        'ù', 'ú', 'ụ', 'ủ', 'ũ', 'ư', 'ừ', 'ứ', 'ự', 'ử', 'ữ',
        'ỳ', 'ý', 'ỵ', 'ỷ', 'ỹ',
        'đ'
    );

    $nonAccents = array(
        'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a',
        'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e',
        'i', 'i', 'i', 'i', 'i',
        'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o',
        'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u',
        'y', 'y', 'y', 'y', 'y',
        'd'
    );

    $str = str_replace($accents, $nonAccents, $str);

    $str = mb_strtoupper($str, 'UTF-8');
    return $str;
}

// Lấy ngày tháng hiện tại
$currentDate = date($dateFormat);


?>
<style>
.w-full{
    width: 100%;
}

</style><link rel="stylesheet" href="assets/vendor/libs/@form-validation/umd/styles/index.css" />
        <?php include 'files/sidebar.php';?>
<div class="container-xxl flex-grow-1 container-p-y">
      
                          <div class="card">
                              <div class="card-body">
<div class="row justify-content-center">
 <div class="col-md-6">
     <div class="alert alert-primary mb-3">
         Hệ điều hành đã chọn: <b><?=trim(strip_tags($_GET['type']))?></b>
     </div>
     <div class="grid gap-5 md:grid-cols-3">
         <div class="">
                                            <label class="block text-sm mb-2 mt-2" for="default">Hệ điều hành</label>
                                           <select onchange="showPin();" id="theme" class="form-select w-full">
                                               <option value="ios">IOS/IPhone</option>
                                      <option value="android">Android</option>
                                       
                                </select>
                                <script>
                                    function showPin(){
                                        var hedieuhanh = document.getElementById('theme').value;
                                       var urlParams = new URLSearchParams(window.location.search);

        // Đặt giá trị tham số 'type' thành 'android'
        urlParams.set('type', hedieuhanh);

        // Lấy URL mới với tham số 'type' đã được thay đổi
        var newUrl = window.location.pathname + '?' + urlParams.toString();

        // Chuyển hướng đến URL mới
        window.location.href = newUrl;
                                      
                                    }
                                 
                                </script>
                                        </div>
                                        <div class="">
                                            <label class="block text-sm mb-2 mt-2" for="default">Số tài khoản người gửi</label>
                                            <input value="987654321" id="stkgui" class="form-control w-full" type="text" placeholder="Ví dụ: 987654321">
                                        </div>
                                         <div class="d-none" style="display:none">
                                            <label class="block text-sm mb-2 mt-2" for="default">Tên người gửi</label>
                                            <input value="Nguyễn Văn B" id="name_gui" class="form-control w-full" type="text" placeholder="Ví dụ: Nguyễn Văn B">
                                        </div>
                                        <!-- Start -->
                                        <div class="">
                                            <label class="block text-sm mb-2 mt-2" for="default">Số tài khoản người nhận</label>
                                            <input value="1212004" id="stk_nhan" class="form-control w-full" type="text" placeholder="Ví dụ: 123456789">
                                        </div>
                                         <div class="">
                                            <label class="block text-sm mb-2 mt-2" for="default">Tên người nhận</label>
                                            <input value="Nguyễn Văn A" id="name_nhan" class="form-control w-full" type="text" placeholder="Ví dụ: Nguyễn Văn A">
                                        </div>
                                         <div class="">
                                            <label class="block text-sm mb-2 mt-2" for="default">Số tiền chuyển</label>
                                            <input value="100000" id="amount" class="form-control w-full" type="number" placeholder="Ví dụ: 100000">
                                        </div>
                                         <div class="">
  <label class="block text-sm mb-2 mt-2" for="default">Ngân hàng nhận</label>
  <select onchange="" id="bank_nhan" class="form-select w-full">
    <option value="TMCP Ngoại Thương Việt Nam" int="VCB" ant="VietcomBank">VietcomBank</option>
    <option value="TMCP Công Thương Việt Nam" int="CTG" ant="VietinBank">VietinBank</option>
    <option value="TMCP Kỹ Thương Việt Nam" int="TCB" ant="Techcombank">Techcombank</option>
    <option value="TMCP Đầu Tư Và Phát Triển" int="BIDV" ant="BIDV">BIDV</option>
    <option value="Nông Nghiệp Và PT Nông Thôn" int="VARB" ant="AgriBank">AgriBank</option>
    <option value="TMCP Quốc Dân" int="NVB" ant="Navibank">Navibank</option>
    <option value="TMCP Sài Gòn Thương Tín" int="STB" ant="Sacombank">Sacombank</option>
    <option value="TMCP Á Châu" int="ACB" ant="ACB">ACB</option>
    <option value="TMCP Quân Đội" int="MB" ant="MBBank">MBBank</option>
    <option value="TMCP Tiên Phong" int="TPB" ant="TPBank">TPBank</option>
    <option value="TNHH MTV Shinhan Việt Nam" int="SVB" ant="Shinhan Bank">Shinhan Bank</option>
    <option value="TMCP Quốc Tế Việt Nam" int="VIB" ant="VIB Bank">VIB Bank</option>
    <option value="TMCP Việt Nam Thịnh Vượng" int="VPB" ant="VPBank">VPBank</option>
    <option value="TMCP Sài Gòn Hà Nội" int="SHB" ant="SHB">SHB</option>
    <option value="TMCP Xuất Nhập Khẩu Việt Nam" int="EIB" ant="Eximbank">Eximbank</option>
    <option value="TMCP Bảo Việt" int="BVB" ant="BaoVietBank">BaoVietBank</option>
    <option value="TMCP Bản Việt" int="VCCB" ant="VietcapitalBank">VietcapitalBank</option>
    <option value="TMCP Sài Gòn" int="SCB" ant="SCB">SCB</option>
    <option value="Liên Doanh Việt Nga" int="VRB" ant="VietNam - Russia Bank">VietNam - Russia Bank</option>
    <option value="TMCP An Bình" int="ABB" ant="ABBank">ABBank</option>
    <option value="TMCP Đại Chúng Việt Nam" int="PVCB" ant="PVCombank">PVCombank</option>
    <option value="TM TNHH MTV Đại Dương" int="OJB" ant="OceanBank">OceanBank</option>
    <option value="TMCP Nam Á" int="NAB" ant="NamA bank">NamA bank</option>
    <option value="TMCP Phát Triển TPHCM" int="HDB" ant="HDBank">HDBank</option>
    <option value="TMCP Việt Nam Thương Tín" int="VB" ant="VietBank">VietBank</option>
    <option value="Công ty Tài chính Cổ Phần Tín Việt" int="CFC" ant="VietCredit">VietCredit</option>
    <option value="TNHH MTV Public VN" int="PBVN" ant="Public bank">Public bank</option>
    <option value="TNHH MTV Hongleong VN" int="HLB" ant="Hongleong Bank">Hongleong Bank</option>
    <option value="TMCP Xăng Dầu Petrolimex" int="PGB" ant="PG Bank">PG Bank</option>
    <option value="Hợp Tác" int="COB" ant="Co.op Bank">Co.op Bank</option>
    <option value="TNHH MTV CIMB Việt Nam" int="CIMB" ant="CIMB">CIMB</option>
    <option value="TNHH Indovina" int="IVB" ant="Indovina">Indovina</option>
    <option value="TMCP Đông Á" int="DAB" ant="DongABank">DongABank</option>
    <option value="TM TNHH MTV Dầu Khí Toàn Cầu" int="GPB" ant="GPBank">GPBank</option>
    <option value="TMCP Bắc Á" int="NASB" ant="BacABank">BacABank</option>
    <option value="TMCP Việt Á" int="VAB" ant="VietABank">VietABank</option>
    <option value="TMCP Sài Gòn Công Thương" int="SGB" ant="SaigonBank">SaigonBank</option>
    <option value="TMCP Hàng Hải Việt Nam" int="MSB" ant="Maritime Bank">Maritime Bank</option>
    <option value="TMCP Bưu Điện Liên Việt" int="LPB" ant="LienVietPostBank">LienVietPostBank</option>
    <option value="TMCP Kiên Long" int="KLB" ant="KienLongBank">KienLongBank</option>
    <option value="Công Nghiệp Hàn Quốc - Hà Nội" int="IBKHN" ant="IBK - Ha Noi">IBK - Ha Noi</option>
    <option value="Wooribank" int="WOO" ant="Woori bank">Woori bank</option>
    <option value="TMCP Đông Nam Á" int="SEAB" ant="SeABank">SeABank</option>
    <option value="TNHH MTV United Overseas Bank" int="UOB" ant="UOB">UOB</option>
    <option value="TMCP Phương Đông" int="OCB" ant="OCB">OCB</option>
    <option value="TNHH MTV Mirae Asset (Viet Nam)" int="MAFC" ant="Mirae Asset">Mirae Asset</option>
    <option value="Keb Hana - TP HCM" int="KEBHANAHCM" ant="Keb Hana - Ho Chi Minh">Keb Hana - Ho Chi Minh</option>
    <option value="Keb Hana - Hà Nội" int="KEBHANAHN" ant="Keb Hana - Ha Noi">Keb Hana - Ha Noi</option>
    <option value="Standard Chartered" int="STANDARD" ant="Standard Chartered">Standard Chartered</option>
    <option value="So CAKE by VPBank" int="CAKE" ant="CAKE">CAKE</option>
    <option value="So Ubank by VPBank" int="Ubank" ant="Ubank">Ubank</option>
    <option value="Nonghyup - Hà Nội" int="NonghyupBankHN" ant="Nonghyup Bank - HN">Nonghyup Bank - HN</option>
    <option value="Kookmin - Hà Nội" int="KBHN" ant="Kookmin - HN">Kookmin - HN</option>
    <option value="Kookmin - TP. HCM" int="KBHCM" ant="Kookmin - HCM">Kookmin - HCM</option>
    <option value="DBS - TP. HCM" int="DBSHCM" ant="DBS - HCM">DBS - HCM</option>
    <option value="TM TNHH MTV Xây Dựng" int="CBBank" ant="CBBank">CBBank</option>
    <option value="Đại Chúng TNHH Kasikornbank" int="KBankHCM" ant="KBank - HCM">KBank - HCM</option>
    <option value="TNHH MTV HSBC Việt Nam" int="HSBC" ant="HSBC">HSBC</option>
    <option value="So Timo" int="Timo" ant="Timo">Timo</option>
  </select>
</div>                                  

                                           <div class="">
                                            <label class="block text-sm mb-2 mt-2" for="default">Thông báo biến động số dư</label>
                                           <select onchange="thaydoibdsd()" id="bdsd" class="form-select w-full">
                                               <option value="0">Không</option>
                                      <option value="1">Có</option>
                                       
                                </select>
                                  <div id="soducuoi" style="display:none">
                                            <label class="block text-sm mb-2 mt-2 mt-2" for="default">Vui lòng nhập số dư cuối</label>
                                            <input id="sdc" class="form-control w-full" type="number" value="100000" placeholder="Ví dụ: 935000">
                                            
                                        </div>
                                </div>
                                        
                                         <div class="">
                                            <label class="block text-sm mb-2 mt-2" for="default">Thời gian điện thoại</label>
                                            <input id="time_dt" class="form-control w-full" type="text" value="9:31" placeholder="Ví dụ: 9:31">
                                        </div>
                                         <div class="">
                                            <label class="block text-sm mb-2 mt-2" for="default">Thời gian trên bill</label>
                                            <input id="time_bill" class="form-control w-full" type="text" value="27 thg 12, 2023 lúc 9:31" placeholder="Ví dụ: 09:31:49, 27/12/2023">
                                        </div>
                                          <div class="">
                                            <label class="block text-sm mb-2 mt-2" for="default">Nội dung chuyển khoản</label>
                                            <input value="NGUYEN VAN B chuyen tien" id="noidung" class="form-control w-full" type="text" placeholder="Ví dụ: Nguyen Van A chuyen tien">
                                        </div>
                                            <div class="">
                                            <label class="block text-sm mb-2 mt-2" for="default">Mã giao dịch</label>
                                            <input id="magiaodich" class="form-control w-full" type="text" value="FT19675044812390">
                                        </div>
                                        <div>
                                          <div class="row">
                                                <p>
                                                    <label>Phần trăm pin</label>
                                                </p>
    <div class="col-lg-2 col-2 mb-2"><div class="form-check form-check-primary mt-3">
            <input checked="" name="pin" class="form-check-input" type="radio" value="1" id="pin1">
            <label class="form-check-label" for="pin1">  <img style="height: 20px!important; object-fit: contain; background-color: #bebebe;" src="<?=$domain_api?>/banks/<?=$_GET['name']?>/pin_<?=$_GET['type']?>/1.png" alt="radioImg"> </label>
          </div></div><div class="col-lg-2 col-2 mb-2"><div class="form-check form-check-primary mt-3">
            <input name="pin" class="form-check-input" type="radio" value="2" id="pin2" checked="">
            <label class="form-check-label" for="pin2">  <img style="height: 20px!important; object-fit: contain; background-color: #bebebe;" src="<?=$domain_api?>/banks/<?=$_GET['name']?>/pin_<?=$_GET['type']?>/2.png" alt="radioImg"> </label>
          </div></div><div class="col-lg-2 col-2 mb-2"><div class="form-check form-check-primary mt-3">
            <input name="pin" class="form-check-input" type="radio" value="3" id="pin3" checked="">
            <label class="form-check-label" for="pin3">  <img style="height: 20px!important; object-fit: contain; background-color: #bebebe;" src="<?=$domain_api?>/banks/<?=$_GET['name']?>/pin_<?=$_GET['type']?>/3.png" alt="radioImg"> </label>
          </div></div><div class="col-lg-2 col-2 mb-2"><div class="form-check form-check-primary mt-3">
            <input name="pin" class="form-check-input" type="radio" value="4" id="pin4" checked="">
            <label class="form-check-label" for="pin4">  <img style="height: 20px!important; object-fit: contain; background-color: #bebebe;" src="<?=$domain_api?>/banks/<?=$_GET['name']?>/pin_<?=$_GET['type']?>/4.png" alt="radioImg"> </label>
          </div></div><div class="col-lg-2 col-2 mb-2"><div class="form-check form-check-primary mt-3">
            <input name="pin" class="form-check-input" type="radio" value="5" id="pin5" checked="">
            <label class="form-check-label" for="pin5">  <img style="height: 20px!important; object-fit: contain; background-color: #bebebe;" src="<?=$domain_api?>/banks/<?=$_GET['name']?>/pin_<?=$_GET['type']?>/5.png" alt="radioImg"> </label>
          </div></div><div class="col-lg-2 col-2 mb-2"><div class="form-check form-check-primary mt-3">
            <input name="pin" class="form-check-input" type="radio" value="6" id="pin6" checked="">
            <label class="form-check-label" for="pin6">  <img style="height: 20px!important; object-fit: contain; background-color: #bebebe;" src="<?=$domain_api?>/banks/<?=$_GET['name']?>/pin_<?=$_GET['type']?>/6.png" alt="radioImg"> </label>
          </div></div><div class="col-lg-2 col-2 mb-2"><div class="form-check form-check-primary mt-3">
            <input name="pin" class="form-check-input" type="radio" value="7" id="pin7" checked="">
            <label class="form-check-label" for="pin7">  <img style="height: 20px!important; object-fit: contain; background-color: #bebebe;" src="<?=$domain_api?>/banks/<?=$_GET['name']?>/pin_<?=$_GET['type']?>/7.png" alt="radioImg"> </label>
          </div></div>
</div>

                                        </div>
                                      
                                    
                            
                                    </div>
 </div>
 <div class="col-md-4">
       <div class="mb-3">
                                             <button onclick="taoBill('primary')" class="mb-3 btn btn-primary">Tạo bill (<?=number_format($tiengoc)?>đ)</button>
                                          <button class="btn btn-success mb-3" onclick="taoBill('demo')">Xem demo</button>
                                    
                                    </div>
     <div class="alert alert-danger">Ảnh sau khi tạo xong sẽ hiển thị ở đây</div>
     <div id="anhdemo"></div>
 </div>
</div>

                              </div>
                             
                          </div>
                          
</div>
     <script>
             function chonBank() {
    var selectElement = document.getElementById("bank_nhan");
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var intValues = selectedOption.getAttribute("int");
    document.getElementById('code').value = intValues;
    
    
    var selectElement = document.getElementById("bank_nhan");
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var intValues = selectedOption.getAttribute("ant");
    document.getElementById('code1').value = intValues;
             }
        </script>
          <input id="code1" type="text" value="Vietinbank" name="code1" hidden/>
        <input id="code" type="text" value="ICB" name="code" hidden/>
                                <script>
                                  
    function thaydoibdsd(){
        var bdsd = document.getElementById('bdsd').value;
        if(bdsd === '0'){
            document.getElementById('soducuoi').style.display = 'none';
        }
        if(bdsd === '1'){
            document.getElementById('soducuoi').style.display = 'block';
        }
    }

    function taoBill(type) {
        chonBank();

     
        document.getElementById('anhdemo').innerHTML = 'Loading...';
        var selectedElement = document.getElementById('bank_nhan');
        // Get data from input fields or any other source
        var inputData = {
            key: "<?=$key?>",
            bank_goc: '<?=trim($_GET['name'])?>',
            theme: '<?=trim($_GET['type'])?>',
            time_dt: document.getElementById('time_dt').value,
            pin: document.querySelector('input[name="pin"]:checked').value,
            stk_nhan: document.getElementById('stk_nhan').value,
            name_nhan: document.getElementById('name_nhan').value,
            amount: document.getElementById('amount').value,
            bank_nhan: document.getElementById('bank_nhan').value,
            code: document.getElementById('code').value,
            code1: document.getElementById('code1').value,
            magiaodich: document.getElementById('magiaodich').value,
            noidung: document.getElementById('noidung').value,
            bdsd: document.getElementById('bdsd').value,
            sdc: document.getElementById('sdc').value,
            stkgui: document.getElementById('stkgui').value,
            name_gui: document.getElementById('name_gui').value,
            time_bill: document.getElementById('time_bill').value
        };

        // Create a new FormData object
        var formData = new FormData();

        // Append each key-value pair to the FormData object
        for (var key in inputData) {
            formData.append(key, inputData[key]);
        }

        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();

        // Configure it: POST-request for the URL /create.php
        xhr.open("POST", "api.php?type=" + type, true);

        // Define a callback function to handle the response
        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
 
                document.getElementById('anhdemo').innerHTML = xhr.responseText;
           
                
            }
        };

        // Send the request with the FormData object
        xhr.send(formData);
    }
   


function getRandomName() {
    // Generate a random string for the file name
    const randomString = Math.random();
    return `IMG_${randomString}.jpg`;
}

function taiAnh(){
    // Get the image source
    var imageSrc = document.querySelector('#anhdemo img').src;

    // Create a temporary anchor element
    var downloadLink = document.createElement('a');

    // Set the download link attributes
    downloadLink.href = imageSrc;
    downloadLink.download = getRandomName();

    // Append the link to the body
    document.body.appendChild(downloadLink);

    // Trigger a click on the link to start the download
    downloadLink.click();

    // Remove the temporary link from the DOM
    document.body.removeChild(downloadLink);
}
                                </script>
<?=getFooter('123')?>
