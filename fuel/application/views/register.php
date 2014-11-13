
<!--banner-->
<div id="banner_title">
<img src="<?php echo site_url() ?>templates/import/banner_1.png">
</div>
  <div id="orders">
<div id="user">
<table width="620" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <th width="146" scope="col"><img src="<?php echo site_url() ?>templates/import/user_1.png"></th>
    <th colspan="2" scope="col"> 
      <?php echo fuel_block('register'); ?>
    </th>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td width="142" align="right">姓名：</td>
    <td width="326"><input type="text" class="form-control" id="member_name" name="member_name" ></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">電子郵件：</td>
    <td><input type="text" class="form-control" id="member_account" name="member_account" ></td>
  </tr>
   
  <tr>
    <td>&nbsp;</td>
    <td align="right">設定密碼：</td>
    <td><input type="password" class="form-control" id="member_password" name="member_password" ></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">確認密碼：</td>
    <td><input type="password" class="form-control" id="chk_pwd" name="chk_pwd" ></td>
  </tr>  
  <tr>
      <td>&nbsp;</td>
      <td align="right">地址：</td>
      <td>
        <select name="member_city" id="member_city">
       
        <?php
          if(isset($city_result))
          {
            foreach($city_result as $row)
            {
        ?>
          <option value="<?php echo $row->code_value1?>"><?php echo $row->code_name?></option>
        <?php  
            }
          }
        ?>
      
        </select>
        <input type="text" class="form-control" id="member_addr" name="member_addr" >
      </td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">手機：</td>
    <td><input type="text" class="form-control" id="member_mobile" name="member_mobile" onkeypress='validate(event)' ></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">統一編號：</td>
    <td><input type="text" class="form-control" id="vat_number" name="vat_number" ></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="right">發票抬頭：</td>
    <td><input type="text" class="form-control" id="invoice_title" name="invoice_title" ></td>
  </tr>
  <tr>
    <td colspan="3" align="center"> 
      <button id='btn_join' type="button" class="btn btn-primary">加入會員</button>
    </tr>
</table>
</div>
</div>
<script>
  $(document).ready(function($) {
     

    $("#btn_join").click(function(){

      var url = '<?php echo $register_url?>';
      var pwd = $("#member_password").val();
      var chk_pwd = $("#chk_pwd").val();
        

      if(pwd != chk_pwd)
      {
        alert("密碼不一致");
        return false;
      }
      else
      {
        var postData = {//"plan_id": $("#plan_id").val(),
                        "member_name": $("#member_name").val(),
                        "member_account": $("#member_account").val(),
                        "member_pwd": pwd,
                        "chk_pwd": chk_pwd,
                        "member_mobile": $("#member_mobile").val(),
                        "member_city": $("#member_city").val(),
                        "member_addr": $("#member_addr").val(),
                        "vat_number": $("#vat_number").val(),
                        "invoice_title": $("#invoice_title").val()
                      };
      }
      
        


      if($("#member_name").val() == "")
      {
        alert("請輸入名稱");

        return false;
      }
      else if($("#member_addr").val() == "")
      {
        alert("請輸入地址");

        return false;
      }
      else if($("#member_mobile").val() == "")
      {
        alert("請輸入電話");

        return false;
      }
      else if(ValidEmail($("#member_account").val()) == false)
      {
        alert("email 格式錯誤");

        return false;
      }

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
              alert('加入會員完成！！');
              location.href = '<?php echo site_url() ?>';
            }
            else
            {
              alert(data.msg);
            }
          }
        });
    });

  });

  function validate(evt) {
    var theEvent = evt || window.event;
    var key = theEvent.keyCode || theEvent.which;
    key = String.fromCharCode( key );
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }
  }

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
</script>
