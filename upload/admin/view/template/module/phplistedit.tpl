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
      <div class="buttons"><a id="button-save" <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
            
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
              <input type="hidden" id="id" name="id" value="<?php
                     if(isset( $list['id'])){
                       echo $list['id']; 
                       }
                     ?>">
        <table id="mail" class="form">
            <tr>
                <td>
                List Name
                </td>
                <td>
                    <?php
                   // var_dump($list);
                    ?>
                <input type="text" value="<?php
                       if(isset($list['name'])){
                       echo $list['name']; 
                       }
                       ?>" name="name" id="name"></input>
                </td>
            </tr>
            <tr>
                <td>
                Active:
                </td>
                <td>
               <input type="checkbox" checked="" value="1" name="active">
                </td>
            </tr>
            <tr>
                <td>
                List Description
                </td>
                <td>
               <textarea rows="15" cols="55" name="description"><?php 
if(isset($list['description']))
            {
              echo $list['description'];
            }
?></textarea>
                </td>
            </tr>
         
        </table>
               </form>
    </div>
  </div>
</div>

<?php echo $footer; ?>
