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
      <div class="buttons"><a id="button-insert" href="index.php?route=module/phplist/contact&token=<?php echo $token; ?>" class="button"><?php echo $button_insert; ?></a></div>
    </div>
   <br>
   <br>
   <br>
 <div id="tabs" class="htabs"><a href="#tab-queued"><?php  echo $tab_queued; ?></a><a href="#tab-draft"><?php echo $tab_draft; ?></a><a href="#tab-sent"><?php echo  $tab_sent; ?></a></div>
 
 

          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
              <div id="tab-queued">
        <table class="list">
         <thead>
            <tr>
              <td width="1" style="text-align: center;"> 
                  Message Info
              </td>
              <td width="1" style="text-align: center;"> 
                 Time List Entered
              </td>
              <td width="1" style="text-align: center;"> 
                  Delay sending until
              </td>
              <td width="1" style="text-align: center;"> 
                  status
              </td>
              <td width="1" style="text-align: center;"> 
                  Action
              </td>
            </tr>
            </thead>
              <?php 
         foreach($messages as $message)
         {
         ?>
         <tr>
         <td>From:
             <?php
           echo  $message['fromfield'];
             ?>
             <br>
             TO:
             <?php
             if(isset($message['lists']) )
             {
             foreach($message['lists'] as $list)
             {
             echo '<strong>"<u>'.$list['name'] . '</u>"</strong> ' ;
             }
             }
             ?>
             <br>
             Subject
             <?php
           echo  $message['subject'];
        
             ?>
         </td>
         <td>
           <?php
           echo  $message['entered'];
             ?>
             
         </td>
         </td>
         <td>
             <?php
        
             if($message['embargo']!='0000-00-00 00:00:00')
             {
              echo  $message['embargo'];
              }
             ?>
         </td>
         <td>
     <?php
           echo  $message['status'];
              if($message['status'] == 'inprocess')
           {
           ?>
<p>
            <?php
             echo  $message['message_data']['to process'];
             ?> still to process<br/>
             ETA: <?php
             echo  $message['message_data']['ETA'];
             ?><br/>
            Processing <?php
            echo (int)$message['message_data']['msg/hr'];
            ?> msgs/hr<br/>
            
             <?php
          };
             ?>
         </td>
         <td>
             <a href="index.php?route=module/phplist/editmessage&messageid=<?php echo $message['id']; ?>&token=<?php echo $token; ?>">[<?php echo $entry_edit; ?>]</a> <a href="index.php?route=module/phplist/deletemessage&messageid=<?php echo $message['id']; ?>&token=<?php echo $token; ?>">[<?php echo $entry_delete; ?>]</a>
             <?php
             if($message['status']== 'submitted' || $message['status']== 'inprocess'){
             ?>
             <a href="index.php?route=module/phplist/suspendmessage&messageid=<?php echo $message['id']; ?>&token=<?php echo $token; ?>&status=suspended">[<?php echo $entry_suspend; ?>]</a>
             <?php
             }elseif($message['status']== 'suspended'){
             ?>
             <a href="index.php?route=module/phplist/resendmessage&messageid=<?php echo $message['id']; ?>&token=<?php echo $token; ?>&status=submitted">[<?php echo $entry_continue; ?>]</a>
             <?php
             }else{
             ?>
             <a href="index.php?route=module/phplist/queuemessage&messageid=<?php echo $message['id']; ?>&token=<?php echo $token; ?>&status=submitted">[<?php echo $entry_sendmessage; ?>]</a>
             <?php
             }
             ?>
         </td>
         </tr>
         <?php
         }
         ?>
        </table>
             
            <div class="pagination"><?php echo $submitted_pagination; ?></div>  
              </div>
              
              <div id="tab-draft">
        <table class="list">
         <thead>
            <tr>
              <td width="1" style="text-align: center;"> 
                  Message Info
              </td>
              <td width="1" style="text-align: center;"> 
                 Time List Entered
              </td>
              <td width="1" style="text-align: center;"> 
                  Delay sending until
              </td>
              <td width="1" style="text-align: center;"> 
                  status
              </td>
              <td width="1" style="text-align: center;"> 
                  Action
              </td>
            </tr>
            </thead>
              <?php 
         foreach($draftmessages as $message)
         {
         ?>
         <tr>
         <td>From:
             <?php
           echo  $message['fromfield'];
             ?>
             <br>
             TO:
             <?php
             if(isset($message['lists']) )
             {
             foreach($message['lists'] as $list)
             {
             echo '<strong>"<u>'.$list['name'] . '</u>"</strong> ' ;
             }
             }
             ?>
             <br>
             Subject
             <?php
           echo  $message['subject'];
             ?>
         </td>
         <td>
           <?php
           echo  $message['entered'];
             ?>
         </td>
         </td>
         <td>
             <?php
        
             if($message['embargo']!='0000-00-00 00:00:00')
             {
              echo  $message['embargo'];
              }
             ?>
         </td>
         <td>
     <?php
           echo  $message['status'];
             ?>
         </td>
         <td>
             <a href="index.php?route=module/phplist/editmessage&messageid=<?php echo $message['id']; ?>&token=<?php echo $token; ?>">[<?php echo $entry_edit; ?>]</a> <a href="index.php?route=module/phplist/deletemessage&messageid=<?php echo $message['id']; ?>&token=<?php echo $token; ?>">[<?php echo $entry_delete; ?>]</a>
             <?php
             if($message['status']== 'submitted' || $message['status']== 'sending'){
             ?>
             <a href="index.php?route=module/phplist/suspendmessage&messageid=<?php echo $message['id']; ?>&token=<?php echo $token; ?>&status=suspended">[<?php echo $entry_suspend; ?>]</a>
             <?php
             }elseif($message['status']== 'suspended'){
             ?>
             <a href="index.php?route=module/phplist/resendmessage&messageid=<?php echo $message['id']; ?>&token=<?php echo $token; ?>&status=submitted">[<?php echo $entry_continue; ?>]</a>
             <?php
             }else{
             ?>
             <a href="index.php?route=module/phplist/queuemessage&messageid=<?php echo $message['id']; ?>&token=<?php echo $token; ?>&status=submitted">[<?php echo $entry_sendmessage; ?>]</a>
             <?php
             }
             ?>
         </td>
         </tr>
         <?php
         }
         ?>
        </table>
              <div class="pagination"><?php echo $draft_pagination; ?></div>
             </div>
              <div id="tab-sent">
        <table class="list">
         <thead>
            <tr>
              <td width="1" style="text-align: center;"> 
                  Message Info
              </td>
              <td width="1" style="text-align: center;"> 
                 Time List Entered
              </td>
              <td width="1" style="text-align: center;"> 
                  Delay sending until
              </td>
              <td width="1" style="text-align: center;"> 
                  status
              </td>
              <td width="1" style="text-align: center;"> 
                  Action
              </td>
            </tr>
            </thead>
              <?php 
         foreach($sentmessages as $message)
         {
         ?>
         <tr>
         <td>From:
             <?php
           echo  $message['fromfield'];
             ?>
             <br>
             TO:
             <?php
             if(isset($message['lists']) )
             {
             foreach($message['lists'] as $list)
             {
             echo '<strong>"<u>'.$list['name'] . '</u>"</strong> ' ;
             }
             }
             ?>
             <br>
             Subject
             <?php
           echo  $message['subject'];
             ?>
         </td>
         <td>
           <?php
           echo  $message['entered'];
             ?>
         </td>
         </td>
         <td>
             <?php
        
             if($message['embargo']!='0000-00-00 00:00:00')
             {
              echo  $message['embargo'];
              }
             ?>
         </td>
         <td>
     <?php
           echo  $message['status'];
             ?>
         </td>
         <td>
             <a href="index.php?route=module/phplist/editmessage&messageid=<?php echo $message['id']; ?>&token=<?php echo $token; ?>">[<?php echo $entry_edit; ?>]</a> <a href="index.php?route=module/phplist/deletemessage&messageid=<?php echo $message['id']; ?>&token=<?php echo $token; ?>">[<?php echo $entry_delete; ?>]</a>
             <?php
             if($message['status']== 'submitted' || $message['status']== 'inprocess'){
             ?>
             <a href="index.php?route=module/phplist/suspendmessage&messageid=<?php echo $message['id']; ?>&token=<?php echo $token; ?>&status=suspended">[<?php echo $entry_suspend; ?>]</a>
             <?php
             }elseif($message['status']== 'suspended'){
             ?>
             <a href="index.php?route=module/phplist/resendmessage&messageid=<?php echo $message['id']; ?>&token=<?php echo $token; ?>&status=submitted">[<?php echo $entry_continue; ?>]</a>
             <?php
             }else{
             ?>
             <a href="index.php?route=module/phplist/queuemessage&messageid=<?php echo $message['id']; ?>&token=<?php echo $token; ?>&status=submitted">[<?php echo $entry_sendmessage; ?>]</a>
             <?php
             }
             ?>
         </td>
         </tr>
         <?php
         }
         ?>
        </table>
              <div class="pagination"><?php echo $sent_pagination; ?></div>
              </div>
   </form>

    </div>
  </div>

<script type="text/javascript"><!--
$('#tabs a').tabs();

//--></script>
<?php echo $footer; ?>
<?php
/* 
* To change this template, choose Tools | Templates
* and open the template in the editor.
*/

?>
