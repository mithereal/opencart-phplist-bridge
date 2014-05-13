<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
  <div class="box">
    <div class="heading">
      <h1><img src="view/image/mail.png" alt="" /> <?php echo $heading_title; ?></h1>
      <div class="buttons"><a id="button-insert" <a href=index.php?route=module/phplist/addlist&token=<?php echo $token; ?> class="button"><?php echo $button_insert; ?></a></div>
    </div>
   <br>
   <br>
   <br>
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
         <thead>
            <tr>
              <td width="1" style="text-align: center;"> 
                  List Name
              </td>
              <td width="1" style="text-align: center;"> 
                  List Description
              </td>
              <td width="1" style="text-align: center;"> 
                  Active
              </td>
              <td width="1" style="text-align: center;"> 
                  Action
              </td>
            </tr>
            </thead>
              <?php //var_dump($lists);
         foreach($lists as $list)
         {
         ?>
         <tr>
         <td>
             <?php
           echo  $list['name'];
             ?>
             <br> List Members:
            
             <?php
           echo  $list['members'];
             ?>
         </td>
         <td>
             <?php
           echo  $list['description'];
             ?>
         </td>
         <td>
             <?php
           if($list['active']==1)
           {
             ?>
             <input type="checkbox" value="<?php
           echo  $list['id'];
             ?>" name="active" checked="true">
             <?php
             }else{
             ?>
             <input type="checkbox" value="<?php
           echo  $list['id'];
             ?>" name="active">
             <?php
             }
             ?>
         </td>
         <td>
             <a href="index.php?route=module/phplist/editlist&listid=<?php echo $list['id']; ?>&token=<?php echo $token; ?>">[<?php echo $entry_edit; ?>]</a> <a href="index.php?route=module/phplist/listmembers&listid=<?php echo $list['id']; ?>&token=<?php echo $token; ?>">[<?php echo $entry_viewmembers; ?>] </a><a href="index.php?route=module/phplist/deletelist&listid=<?php echo $list['id']; ?>&token=<?php echo $token; ?>">[<?php echo $entry_delete; ?>]</a><a href="index.php?route=module/phplist/contact&listname=<?php echo $list['name']; ?>&token=<?php echo $token; ?>">[<?php echo $entry_sendmessage; ?>]</a>
         </td>
         </tr>
         <?php
         }
         ?>
        </table>
   </form>

    </div>
  </div>
</div>
<script type="text/javascript"><!--	
$('[name=\'active\']').click(function(){
var id=$(this).val();


var checked =$(this).attr('checked')?1:0;
  
$.post('index.php?route=module/phplist/toggleactivelist&token=<?php echo $token; ?>', { id: id, active: checked }, function(data) {
        //$(this).attr('checked').val(data);
        });
}
);
//--></script> 
<?php echo $footer; ?>
