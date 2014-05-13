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
      <div class="buttons"><a id="button-insert" <a href=index.php?route=module/phplist/deleteevents&token=<?php echo $token; ?> class="button"><?php echo $button_delete; ?></a></div>
    </div>
   <br>
   <br>
   <h2>  
       Eventlog</h2>

          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="list">
         <thead>
            <tr>
              <td width="1" style="text-align: center;"> 
                 <?php
           echo  $entry_id;
             ?>
              </td>
              <td width="1" style="text-align: center;"> 
                 <?php
           echo  $entry_time;
             ?>
              </td>
           
              <td width="1" style="text-align: center;"> 
                   <?php
           echo  $entry_message;
             ?>
              </td>
              <td width="1" style="text-align: center;"> 
                  <?php
           echo  $entry_action;
             ?>
              </td>
            </tr>
            </thead>
              <?php 
              //var_dump($events);
              if(isset($events))
              {
        foreach($events as $event)
         {
         ?>
         <tr>
         <td>
             <?php
           echo  $event['id'];
             ?>
         </td>
         <td>
           <?php
           echo  $event['entered'];
             ?>
         </td>
         </td>

         <td>
     <?php
           echo  $event['entry'];
             ?>
         </td>
         <td>
          <a href="index.php?route=module/phplist/deleteevent&eventid=<?php echo $event['id']; ?>&token=<?php echo $token; ?>">[<?php echo $entry_delete; ?>]</a>
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
