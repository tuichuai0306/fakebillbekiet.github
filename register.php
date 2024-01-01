<?php
require_once __DIR__.'/files/functions.php';
if(isset($_SESSION['username'])){
    header('Location: /');
}
echo getBegin('Đăng nhập - '.$l['home-title'],$l['home-description'],$l['home-keyword'],$image);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ biểu mẫu
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kiểm tra xem tài khoản và mật khẩu có đúng định dạng hay không
    if (empty($username) || empty($password)) {
        $errorMessage = "Tài khoản và mật khẩu không được để trống.";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username) || strlen($username) < 4 || strlen($username) > 20) {
        $errorMessage = "Tên người dùng không hợp lệ. Hãy sử dụng chữ cái, số và dấu gạch dưới, có độ dài từ 4 đến 20 ký tự.";
    } elseif (strlen($password) < 8) {
        $errorMessage = "Mật khẩu quá ngắn. Mật khẩu phải có ít nhất 8 ký tự.";
    } else {
        // Kiểm tra xem tên người dùng đã tồn tại trong cơ sở dữ liệu chưa
        $userExists = DB::queryFirstField("SELECT id FROM users WHERE username = %s", $username);

        if ($userExists) {
            // Tên người dùng đã tồn tại, hiển thị thông báo lỗi
            $errorMessage = "Tên người dùng đã tồn tại.";
        } else {
            // Tên người dùng chưa tồn tại, thực hiện đăng ký
            DB::insert('users', [
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT), // Hash mật khẩu trước khi lưu vào cơ sở dữ liệu
                'VIP' => '0',
                'sodu' => '0',
                'avatar' => '',
                'tichxanh' =>'0',
                'billck' => '0',
                'date_bill' => '',
                'serial_key' => generateRandomString()
            ]);

            // Hiển thị thông báo thành công
            $successMessage = "Đăng ký thành công!";
        }
    }
}
?>
    <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css" />

</head>

    <div class="position-relative">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Login -->
          <div class="card p-2">
            <!-- Logo -->
            <div class="app-brand justify-content-center mt-5">
              <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <span style="color: #666cff">
                    <svg width="268" height="150" viewBox="0 0 38 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M30.0944 2.22569C29.0511 0.444187 26.7508 -0.172113 24.9566 0.849138C23.1623 1.87039 22.5536 4.14247 23.5969 5.92397L30.5368 17.7743C31.5801 19.5558 33.8804 20.1721 35.6746 19.1509C37.4689 18.1296 38.0776 15.8575 37.0343 14.076L30.0944 2.22569Z"
                        fill="currentColor" />
                      <path
                        d="M30.171 2.22569C29.1277 0.444187 26.8274 -0.172113 25.0332 0.849138C23.2389 1.87039 22.6302 4.14247 23.6735 5.92397L30.6134 17.7743C31.6567 19.5558 33.957 20.1721 35.7512 19.1509C37.5455 18.1296 38.1542 15.8575 37.1109 14.076L30.171 2.22569Z"
                        fill="url(#paint0_linear_2989_100980)"
                        fill-opacity="0.4" />
                      <path
                        d="M22.9676 2.22569C24.0109 0.444187 26.3112 -0.172113 28.1054 0.849138C29.8996 1.87039 30.5084 4.14247 29.4651 5.92397L22.5251 17.7743C21.4818 19.5558 19.1816 20.1721 17.3873 19.1509C15.5931 18.1296 14.9843 15.8575 16.0276 14.076L22.9676 2.22569Z"
                        fill="currentColor" />
                      <path
                        d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                        fill="currentColor" />
                      <path
                        d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                        fill="url(#paint1_linear_2989_100980)"
                        fill-opacity="0.4" />
                      <path
                        d="M7.82901 2.22569C8.87231 0.444187 11.1726 -0.172113 12.9668 0.849138C14.7611 1.87039 15.3698 4.14247 14.3265 5.92397L7.38656 17.7743C6.34325 19.5558 4.04298 20.1721 2.24875 19.1509C0.454514 18.1296 -0.154233 15.8575 0.88907 14.076L7.82901 2.22569Z"
                        fill="currentColor" />
                      <defs>
                        <linearGradient
                          id="paint0_linear_2989_100980"
                          x1="5.36642"
                          y1="0.849138"
                          x2="10.532"
                          y2="24.104"
                          gradientUnits="userSpaceOnUse">
                          <stop offset="0" stop-opacity="1" />
                          <stop offset="1" stop-opacity="0" />
                        </linearGradient>
                        <linearGradient
                          id="paint1_linear_2989_100980"
                          x1="5.19475"
                          y1="0.849139"
                          x2="10.3357"
                          y2="24.1155"
                          gradientUnits="userSpaceOnUse">
                          <stop offset="0" stop-opacity="1" />
                          <stop offset="1" stop-opacity="0" />
                        </linearGradient>
                      </defs>
                    </svg>
                  </span>
                </span>
                <span class="app-brand-text demo text-heading fw-bold">SieuTool</span>
              </a>
            </div>
            <!-- /Logo -->

            <div class="card-body mt-2">
              <h4 class="mb-2">Chào mừng đến với SieuTool 👋</h4>
              <p class="mb-4">Vui lòng đăng ký tài khoản để tiếp tục</p>
 <?php if (isset($errorMessage)): echo thongbao('error',$errorMessage)?>
 <?php elseif (isset($successMessage)): echo thongbao('success',$successMessage)?>
 <?php endif; ?>
              <form id="formAuthentication" class="mb-3" action="" method="POST">
                <div class="form-floating form-floating-outline mb-3">
                  <input
                    type="text"
                    class="form-control"
                    id="username"
                    name="username"
                    placeholder="Tên tài khoản"
                    autofocus />
                  <label for="username">Username</label>
                </div>
                <div class="mb-3">
                  <div class="form-password-toggle">
                    <div class="input-group input-group-merge">
                      <div class="form-floating form-floating-outline">
                        <input
                          type="password"
                          id="password"
                          class="form-control"
                          name="password"
                          placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                          aria-describedby="password" />
                        <label for="password">Mật khẩu</label>
                      </div>
                      <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
                    </div>
                  </div>
                </div>
                <div class="mb-3 d-flex justify-content-between">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Nhớ mật khẩu </label>
                  </div>
                
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Đăng ký tài khoản</button>
                </div>
              </form>

              <p class="text-center">
                <span>Đã có tài khoản?</span>
                <a href="login">
                  <span>đăng nhập</span>
                </a>
              </p>

       
            </div>
          </div>
          <!-- /Login -->
          <img
            alt="mask"
            src="../../assets/img/illustrations/auth-basic-login-mask-light.png"
            class="authentication-image d-none d-lg-block"
            data-app-light-img="illustrations/auth-basic-login-mask-light.png"
            data-app-dark-img="illustrations/auth-basic-login-mask-dark.png" />
        </div>
      </div>
    </div>
                        <!-- Form -->
                        
  <?php
echo getFooter($l['page-title']);
?>