<?php
require __DIR__.'/files/functions.php';
if(!isset($_SESSION['username'])){
    header('Location: login');
}
echo getBegin('Thanh toán',$l['home-description'],$l['home-keyword'],$image);
include 'files/sidebar.php';?>
<div class="container-xxl flex-grow-1 container-p-y">
    
    <div class="card mb-4">

      <div class="card-body">
 
            <table class="table-auto w-full dark:text-slate-300 divide-y divide-slate-200 dark:divide-slate-700">
                                    <!-- Table header -->
                                   

                                    <tbody class="text-sm" x-data="{ open: false }">
                                                                                 <tr>
                                        
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                <div>Ngân hàng</div>
                                            </td>
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                <div class="font-medium text-slate-800 dark:text-slate-100"> <div class="flex items-center space-x-2 mr-2">
                                        <!-- Stars -->

                                        <!-- Rate -->
                                        <div class="inline-flex text-sm font-medium"><?=$webinfo['bank']?></div>
                                    </div></div>
                                            </td>
                                            
                                        </tr>
                                        <!-- Row -->
                                        <tr>
                                        
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                <div>Số tài khoản</div>
                                            </td>
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                <div class="font-medium text-slate-800 dark:text-slate-100"> <div class="flex items-center space-x-2 mr-2">
                                        <!-- Stars -->

                                        <!-- Rate -->
                                        <div class="inline-flex text-sm font-medium copy" data-clipboard-text="<?=$webinfo['stk']?>"><?=$webinfo['stk']?></div>
                                    </div></div>
                                            </td>
                                            
                                        </tr>
                                        <!--
                                        Example of content revealing when clicking the button on the right side:
                                        Note that you must set a "colspan" attribute on the <td> element,
                                        and it should match the number of columns in your table
                                        -->
                                         <tr>
                                        
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                <div>Chủ tài khoản</div>
                                            </td>
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                <div class="font-medium text-slate-800 dark:text-slate-100"> <div class="flex items-center space-x-2 mr-2">
                                        <!-- Stars -->

                                        <!-- Rate -->
                                        <div class="inline-flex text-sm font-medium"><?=$webinfo['name']?></div>
                                    </div></div>
                                            </td>
                                            
                                        </tr>
                                         <tr>
                                        
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                <div>Nội dung chuyển khoản</div>
                                            </td>
                                            <td class="px-2 first:pl-5 last:pr-5 py-3 whitespace-nowrap">
                                                <div class="font-medium text-slate-800 dark:text-slate-100"> <div class="flex items-center space-x-2 mr-2">
                                        <!-- Stars -->

                                        <!-- Rate -->
                                        <div class="alert alert-danger copy" data-clipboard-text="payment <?=$user_new['id']?>">payment <?=$user_new['username']?></div>
                                    </div></div>
                                            </td>
                                            
                                        </tr>
                                    </tbody>
                                </table>
     
      </div>
    </div>
    </div>
    <?=getFooter('Title')?>
<script>
          var clipboard = new ClipboardJS('.copy');

clipboard.on('success', function(e) {
    console.info('Action:', e.action);
    console.info('Text:', e.text);
    console.info('Trigger:', e.trigger);
    alert('Đã copy vào clipboard!');
    e.clearSelection();
});

clipboard.on('error', function(e) {
    console.error('Action:', e.action);
    console.error('Trigger:', e.trigger);
});
      </script>
</body>

</html>