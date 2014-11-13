  
 

<img src="<?php echo site_url() ?>templates/import/banner_1.png"> 
    <br><br>
    <div id="cart">
      <br><br>
        <table width="700" class="table table-striped">
          <tr bgcolor="#696969" >
          <th scope="col">圖片</th>
            <th scope="col">商品名稱</th>
            <th scope="col">數量</th>
            <th scope="col">單價</th>
            <th scope="col">小計</th>
            <th scope="col">取消</th>
          </tr>
           

            <?php if (isset($pro_cart)): ?>
            <?php $total_price = 0; ?>
            <?php foreach ($pro_cart as $key => $value): ?>
            <tr>
              <?php 
                $num = $cart[$value->pro_id]["num"]; 
                $price = $value->plan_price;
                $total_price += $price * $num;
              ?>
              <td valign="center"><img style="width:128px" src='<?php echo $value->photo->ga_url ?>'></td>
              <td valign="center"><?php echo $value->pro_name ?></td>
              <td valign="center"><?php echo $num ?></td>
              <td valign="center"><?php echo $value->plan_price ?></td>
              <td valign="center"><?php echo $price*$num ?></td>
              <td valign="center"><img class="cancel_img" data-planid='<?php echo $value->plan_id; ?>' data-proid='<?php echo $value->pro_id; ?>' src="<?php echo site_url() ?>templates/import/cart_cancel.png"> 取消</td>
              
            </tr>
            <?php endforeach ?>
             <!--最下面的運費-->
          <!--   <tr>
              <td valign="center"><img src="<?php echo site_url() ?>templates/import/cart_icon_1.png"></td>
              <td valign="center">運費（滿2000免運）</td>
              <td valign="center">&nbsp;  </td>
                <td valign="center"></td>
              <td valign="center">150</td>
              <td valign="center">&nbsp; </td>
            </tr> -->
            <!--繼續借用表格的加總-->
        
            <tr>
              <td valign="center"><img src="<?php echo site_url() ?>templates/import/cart_money.png"></td>
              <td valign="center" style="font-size:16px;">消費金額</td>
              <td valign="center"><span style="color:red;font-size:16px;"><?php echo $total_price ?></span></td>
              <td colspan="3" align="right" valign="center" style="line-height:70px;">
               
                <button onclick='javascript:location.href="<?php echo site_url() ?>payment"' type="button" class="btn btn-default">初次購物</button> 
                <button onclick='javascript:location.href="<?php echo site_url() ?>login"' id="login_btn"  type="button" class="btn btn-primary">登入結賬去</button>
              </td> 
            </tr>
        <?php else: ?>
          <tr>
              <td colspan="5" valign="center">
                  購物車目前無商品
              </td>
          </tr>
        <?php endif ?>
         </td>
          </tr>
        </table>
      </div>

<script type="text/javascript">
    $(function(){
        $("#divShow").hide();
        
        $('body').click(function(evt) {
            if($(evt.target).parents("#divShow").length==0 && 
                evt.target.id != "login_btn" && evt.target.id != "divShow") {
                $('#divShow').hide();
            }
        });
    });
</script>
 
 

  <script>

    function ValidEmail(emailtoCheck)
    {
      // 規則: 1.只有一個 "@"
      //       2.網址中, 至少要有一個".", 且不能連續出現
      //       3.不能有空白
      var regExp = /^[^@^\s]+@[^\.@^\s]+(\.[^\.@^\s]+)+$/;
      if ( emailtoCheck.match(regExp) )
        return true;
      else
        return false;
    }

    $(document).ready(function($) {

      var sendForm = $('#sendForm');

      if('' != '<?php echo $member_id ?>'){
            
          $('#login_btn').click(function(event) {
               location.href = '<?php echo site_url() ?>payment';
          });
      }else{
          $('#login_btn').click(function(event) {
               $('#divShow').show();
          });
      }

      $('#login_img').on("click", function (e) {
            $('#loginForm').submit();
        
      });


      $('.cancel_img').on("click", function (e) {
        var pro_id = $(this).data('proid');
        var deleteConfirm = confirm("您確定將商品從購物車移除?");
        if (deleteConfirm) {
          var url = '<?php echo site_url()."removeFromCart/"; ?>' + pro_id;
          $.get(url, function(data) {
            /*optional stuff to do after success */
            alert('商品已從購物車移除！');
            location.reload();
          });
        }  
     });

      $(".plan_price").click(function(){
        var price = $(this).attr('price');
        $(".price").find("span").text(price);
      });

      $("#login_img").click(function(){ 
        var url = '<?php echo $login_url?>';
        var member_account = $('#member_account').val();
        var password = $('#password').val();
        var chkMail = ValidEmail(member_account);
        if(member_account == "" || password == "")
        {
          $("#error_msg").html("請輸入帳號密碼");
          return;
        }
        else if(chkMail === false)
        {
          $("#error_msg").html("email格式錯誤");
          return;
        }
        else
        {
          var postData = {'member_account': member_account, 'password': password};
          $("#error_msg").html("登入中...");
          $.ajax({
            url: url,
            type: 'POST',
            dataType: 'json',
            data: postData,
            success: function(data)
            {
              console.log(data);
              if(data.status == 1)
              {
                // sendForm.submit();
                location.href = '<?php echo site_url() ?>payment';
              }
              else
              {
                $("#error_msg").html("帳號密碼錯誤");
              }
            }
          });
        }

      });
        
        $('a.step1btn1').on('click',function(){
          if($(".plan_price:checked").size() == 0)
          {
            alert("請選擇方案");
            return false;
          }

          $.ajax({
            url: '/chkLogin',
            dataType: 'json',
            type: 'POST'
          })
          .done(function(data) {
            if(data.status == 1)
            {
              if(data.is_logined)
              {
                sendForm.submit();
              }
              else
              {
                $("a.step1btn2").click();
              }
            }
          })
          .fail(function() {
            console.log("error");
          });
          

          return true;

        });
      
    });
  </script>