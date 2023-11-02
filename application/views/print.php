<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
       <title>RK - Receipt - <?=$order['year'];?>.<?=$order['month'];?>.<?=$order['day'];?>.<?=$order['no'];?>.<?=$order['ext'];?></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <style>
            .ext{
                position:fixed;
                top:209px;
                left:290px;
            }
            .date{
                position:fixed;
                top:209px;
                left:631px;
            }
            .name{
                position:fixed;
                top:238px;
                left:320px;
            }
            .p_name{
                position:fixed;
                top:270px;
                left:336px;
            }
            .e_date{
                position:fixed;
                top:305px;
                left:336px;
            }
            .parameters_name{
                position:fixed;
                top:350px;
                left:290px;
            }
            .format{
                position:fixed;
                top:350px;
                left:220px;
            }
        </style>
    </head>
    <body>
        <div class="ext">
          <b ><?=$order['year'];?>.<?=$order['month'];?>.<?=$order['day'];?>.<?=$order['no'];?>.<?=$order['ext'];?></b>
        </div>
        <div class="date">
           <b ><?=date('d-M-Y');?></b>
        </div>
        <div class="name">
           <b ><?=$order['name'];?></b>
        </div>
        <div class="p_name">
           <b ><?=$order['product_name'];?></b>
        </div>
        <div class="e_date">
           <b ><?=$order['entry_date'];?></b>
        </div>
        <?php if($order['custom'] == 0){?>    
            <div class="parameters_name">
                <?php
                  if(!empty($p_result)){
                  
                  foreach($p_result as $p_result){     ?>
                  
                   <b style="padding:5px;"><?=$p_result['parameters_name'];?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b style="padding:5px;"><?=$p_result['p_result'];?></b><br>
                  
                  <?php }} ?>
            </div>
        <?php }?>
        <?php if($order['custom'] == 1){?>
            <div class="format">
               <small ><?=$order['format_data'];?></small>
            </div>
        <?php }?>
    </body>
    <script>
        $(document).ready(function() {
            window.print();
            window.onafterprint =function(){ window.close();}
        });
    </script>
</html>