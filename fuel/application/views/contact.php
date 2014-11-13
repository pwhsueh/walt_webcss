<img src="<?php echo site_url() ?>templates/import/banner_1.png"> 
<br><br>
  <div id="orders" style="line-height:40px; margin-left:40px;">

<!-- <h4>聯絡我們</h4>
<p>如果您有任何聯絡事項，歡迎使用下列表單聯絡我們。</p> -->
<?php echo fuel_block('contact_title'); ?>
     <form id="contact_form" action="<?php echo $contact_url ?>" method="POST" style=" border-bottom:#999 1px solid; border-top:#999 1px solid;">  

  <table width="500" border="0" align="" cellpadding="0" cellspacing="0">
    
    <tr>
      <td>&nbsp;</td>
      <td align="right" valign="top">稱呼：</td>
      <td><input type="text" id="name" name="name" class="form-control" style="width:150px;" ></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right" valign="top">Email：</td>
      <td><input type="mail" id="email" name="email" class="form-control" style="width:150px;"style="width:150px;" ></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right" valign="top">聯絡電話：</td>
      <td><input type="number" id="phone" name="phone" class="form-control" style="width:150px;"style="width:150px;" ></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right" valign="top">聯絡內容：</td>
      <td><input type="textarea" id="content" name="content" class="form-control" style="height:200px;"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right" valign="top">驗證碼：</td>
      <td>
          <!-- <input type="text" class="form-control" style="width:50px;" > -->
          <?php 

              $num1 = rand(0, 9);
              $num2 = rand(0, 9);
              $num = $num1 + $num2;
           ?>
          <!-- <input type="text" name="verifycode" size="8" id="verifycode"/></input>          -->
            
          <input type="text" name="captchaImage" style="width:100px;"  size="6" value="<?php echo $num1 ?> + <?php echo $num2 ?>" disabled="disabled" />&nbsp;&nbsp;
          <input type="text" name="verificationcode" id="verificationcode"  placeholder="請輸入左邊的答案"/> 
      </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="right" valign="top"></td>
      <td>  <button type="submit" id="btn_contact" class="btn btn-primary">送出內容</button></td>
    </tr>
   </table>
 </form>
   <br>
   <center>

  </center>
  </div>
<script type="text/javascript" src="<?php echo site_url()?>templates/js/jquery.browser.js"></script>
<script type="text/javascript" src="<?php echo site_url()?>templates/js/jquery.validate.min.js"></script>
<script>

    $.validator.methods.equal = function(value, element, param) {
        return value == param;
    };

   
    $(document).ready(function($) {
  

    $("#contact_form").validate({
            rules: {
                name: "required",
                phone : "required",
                email: "required", 
                content: "required",  
                verificationcode: {
                    equal: <?php echo $num ?>   
                }
            },
            messages: {
                name: "必填",
                phone: "必填",
                email: "必填", 
                content: "必填",  
                verificationcode: " 錯誤"
            }
        });
        
       
      
    });
  </script>