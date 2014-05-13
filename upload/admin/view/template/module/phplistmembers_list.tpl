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
      <div class="buttons"><a id="button-insert" <a href=index.php?route=module/phplist/addmember&token=<?php echo $token; ?> class="button"><?php echo $button_insert; ?></a></div>
    </div>
   <br>
   <br>
   <h2>  <?php
           echo  $entry_listname;
             ?>   <?php
  if(isset($listname))
           echo  $listname;
           else echo 'all';
         //  var_dump($members);
             ?></h2>

          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
         <thead>
            <tr>
              <td width="1" style="text-align: center;"> 
                 <?php
           echo  $entry_members;
             ?>
              </td>
              <td width="1" style="text-align: center;"> 
                 <?php
           echo  $entry_confirmed;
             ?>
              </td>
           
              <td width="1" style="text-align: center;"> 
                   <?php
           echo  $entry_messages;
             ?>
              </td>
              <td width="1" style="text-align: center;"> 
                  <?php
           echo  $entry_action;
             ?>
              </td>
            </tr>
            </thead>
              <?php if(isset($members))
              {
        foreach($members as $member)
         {
         ?>
         <tr>
         <td>
             <?php
           echo  $member['email'];
             ?>
         </td>
         <td>
           <?php
           echo  $member['confirmed'];
             ?>
         </td>
         </td>

         <td>
     <?php
           echo  $member['total'];
             ?>
         </td>
         <td>
          <a href="index.php?route=module/phplist/viewmember&userid=<?php echo $member['id']; ?>&token=<?php echo $token; ?>">[<?php echo $entry_viewmember; ?>] </a><a href="index.php?route=module/phplist/deletemembership&userid=<?php echo $member['id']; ?>&listid=<?php echo $this->request->get['listid']; ?>&token=<?php echo $token; ?>">[<?php echo $entry_delete; ?>]</a>
         </td>
         </tr>
         <?php
         }
         }
         ?>
        </table>
              <div class="pagination"><?php echo $pagination; ?></div>
   </form>

    </div>
  </div>
</div>
<script type="text/javascript"><!--	
$('[name=\'active\']').click(function(){
var id=2;
alert('id is '+id);
}
);
//--></script> 
<?php echo $footer; ?>
<?php
/* 
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/

?>
