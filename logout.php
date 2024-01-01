<?php
require_once __DIR__.'/files/functions.php';
// Khởi động phiên làm việc
session_start();

// Hủy toàn bộ phiên làm việc
session_destroy();

// Chuyển hướng đến trang gốc
?>
<script>

    setCookie("username", "", 30);
    window.location.href='/';
</script>
<?php
exit;
?>
