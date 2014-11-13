  <img src="<?php echo site_url() ?>templates/import/banner_1.png"> 
    <br><br>
      <div id="orders" style="line-height:40px;">
        <center>
         <?php echo fuel_block('report_title'); ?>
            <table width="500" border="0" align="center" cellpadding="0" cellspacing="0">
              
              <tr>
                <td>&nbsp;</td>
                <td align="right">匯款帳號後五碼：</td>
                <td><input type="text" id="account" class="form-control" ></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td align="right">匯款日期：</td>
                <td><input type="date" id="mailing_date" class="form-control" id="time" ></td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td align="right">訂單金額：</td>
                <td>新台幣 <?php echo $order_info->total_amount ?> 元</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
                <td align="right">匯款金額：</td>
                <td><input type="text" id="mailing_amount" class="form-control"  ></td>
              </tr>
              
              <tr>
                <td>&nbsp;</td>
                <td align="right">戶名（選填）：</td>
                <td><input type="text" id="account_nm" class="form-control"  ></td>
              </tr>
             </table>
             <br>

             <button type="button" id="btn_report" class="btn btn-primary">回報匯款</button>
        </center>
      </div>

<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<script>

   
    $(document).ready(function($) {

      $('#mailing_date').datepicker({ dateFormat: 'yy-mm-dd' });
 

      $("#btn_report").click(function(){ 
        var url = '<?php echo $report_url?>';
        var order_id = '<?php echo $order_info->order_id ?>';    
        var account = $("#account").val();          
        var account_nm = $("#account_nm").val();          
        var mailing_date = $("#mailing_date").val();          
        var mailing_amount = $("#mailing_amount").val();          
        var postData = {'account': account, 'account_nm': account_nm, 'mailing_date': mailing_date,'mailing_amount': mailing_amount, 'order_id': order_id};
        $("#error_msg").html("登入中...");
        $.ajax({
          url: url,
          type: 'POST',
          dataType: 'json',
          data: postData,
          success: function(data)
          {
            console.log(data);
            alert(data.msg);
            if(data.status == 1)
            { 
                location.href = '<?php echo site_url() ?>orders';               
            } 
          }
        });
      

      });
        
       
      
    });
  </script>