<?php echo $header; ?>
       <div id="dialog-overlay"></div>
    
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
        <table id="member" class="form">

            <input name="list" value="" type="hidden">
            <input name="id" value="<?php
                     if(isset($user['id'])){
                       echo $user['id']; 
                       }
                     ?>" type="hidden"><input name="returnpage" value="" type="hidden"><input name="returnoption" value="" type="hidden"><tbody><tr><td>ID</td><td id="user_id"><?php
                     if(isset($user['id'])){
                       echo $user['id']; 
                       }
                     ?></td></tr><tr><td>Email</td><td><input id="email" name="email" value="<?php
                     if(isset( $user['email'])){
                       echo $user['email']; 
                       }
                     ?>" size="30" type="text"></td></tr>
<tr>
    <td>
       Lists:
    </td>
    <td>
        <?php
        foreach ($lists as $list) {
        if(isset($list['member']))
        {
               ?>
                 <input type="checkbox"  name="subscribe[]" value="<?php echo $list['id']; ?>" checked="<?php echo $list['member']; ?>">
                     <?php
                     }else{
                     ?>
                      <input type="checkbox"  name="subscribe[]" value="<?php echo $list['id']; ?>">
                      <?php
                     }
                     
                     if(!empty($list['description'])){
                     echo $list['description'];
                     }elseif(!empty($list['listname'])){
                     echo $list['listname'];
                     }else{
                     echo $list['name'];
                     }?>
                 <?php
               }
                ?>
            </td>
</tr>
<tr><td>Is this user confirmed (1/0)</td><td><input name="confirmed" value="<?php
                     if(isset( $user['confirmed'])){
                       echo $user['confirmed']; 
                       }
                     ?>" size="5" type="text"></td></tr>
<tr><td>Is this user blacklisted</td>
    <td>
        <input name="blacklisted" value="<?php
                     if(isset( $user['blacklisted'])){
                       echo $user['blacklisted']; 
                       }
                     ?>
                     " size="5" type="text" >
    </td></tr><tr><td>Number of bounces on this user</td><td>
        <input name="bouncecount" value="<?php
                     if(isset( $user['bouncecount'])){
                       echo $user['bouncecount']; 
                       }
                     ?>
                      " size="5" type="text" disabled >
    </td></tr><tr><td>Entered</td><td>
        <input name="entered" value="<?php
                     if(isset( $user['entered'])){
                       echo $user['entered']; 
                       }
                     ?>
                     " size="15" type="text" disabled >
    </td></tr><tr><td>Last Modified</td><td>
        <input name="modified" value="<?php
                     if(isset( $user['modified'])){
                       echo $user['modified']; 
                       }
                     ?>
                     " size="15" type="text" disabled >
    </td></tr><tr><td>Unique ID for User</td><td>
                <input name="uniqid" value="<?php
                     if(isset( $user['uniqid'])){
                       echo $user['uniqid']; 
                       }
                     ?>
                     " size="30" type="text" disabled >
    </td></tr><tr><td>Send this user HTML emails</td><td><input name="htmlemail" value="<?php
                     if(isset( $user['htmlemail'])){
                       echo $user['htmlemail']; 
                       }
                     ?>" size="3" type="text"></td></tr>
<tr><td>Which page was used to subscribe</td><td>
                        <input name="subscribepage" value="<?php
                     if(isset( $user['subscribepage'])){
                       echo $user['subscribepage']; 
                       }
                     ?>
                      " size="3" type="text" disabled >
    </td></tr><tr><td>RSS Frequency</td><td><input name="rssfrequency" value="<?php
                     if(isset( $user['rssfrequency'])){
                       echo $user['rssfrequency']; 
                       }
                     ?>" size="3" type="text"></td></tr>
<tr><td>Password</td><td><input name="password" value="<?php
                     if(isset( $user['password'])){
                       echo $user['password']; 
                       }
                     ?>" size="15" type="text"></td></tr>
<tr>
    <td>
        Last time password was changed
    </td>
    <td>
                                <input name="passwordchanged" value="<?php
                     if(isset( $user['passwordchanged'])){
                       echo $user['passwordchanged']; 
                       }
                     ?>
                                          " size="15" type="text" disabled >

    </td>
</tr>
<tr>
    <td>
        Is this account disabled?
    </td>
    <td>
        <input name="disabled" value="<?php
                     if(isset( $user['disabled'])){
                       echo $user['disabled']; 
                       }
                     ?>" size="3" type="text">
    </td>
</tr>
<tr>
    <td>Additional data
    </td>
    <td>
        <input name="extradata" value="<?php
                     if(isset( $user['extradata'])){
                       echo $user['extradata']; 
                       }
                     ?>" size="30" type="text">
    </td>
</tr>
<tr>
    <td>
        Foreign Key
    </td>
    <td>
        <input name="foreignkey" value="<?php
                     if(isset( $user['foreignkey'])){
                       echo $user['foreignkey']; 
                       }
                     ?>" size="30" type="text">
    </td>
</tr>
<tr>
    <td colspan="2">
        <input name="change" value="Save Changes" type="submit">
    </td>
</tr>
            </tbody>
            
</table>
         </form>
    </div>
  </div>
</div>
<script type="text/javascript"><!--	
       $('input[name=\'email\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=module/phplist/autocomplete&token=<?php echo $token; ?>&email='+  encodeURIComponent(request.term),
             
            dataType: 'json',
			success: function(json) {		
				response($.map(json, function(email) {
					return {
						id: email.id,
						email: email.email,
						confirmed: email.confirmed,
						value: email.email,
						label: email.email,
						blacklisted: email.blacklisted,
						bouncecount: email.bouncecount,
						entered: email.entered,
						modified: email.modified,
						uniqid: email.uniqid,
						htmlemail: email.htmlemail,
						subscribepage: email.subscribepage,
						rssfrequency: email.rssfrequency,
						password: email.password,
						passwordchanged: email.passwordchanged,
						disabled: email.disabled,
						extradata: email.extradata,
						foreignkey: email.foreignkey,
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
       $('#user_id').html(ui.item.id);
       $('input[name=\'id\']').val(ui.item.id);
       $('input[name=\'confirmed\']').val(ui.item.confirmed);
       $('input[name=\'blacklisted\']').val(ui.item.blacklisted);
       $('input[name=\'bouncecount\']').val(ui.item.bouncecount);
       $('input[name=\'entered\']').val(ui.item.entered);
       $('input[name=\'modified\']').val(ui.item.modified);
       $('input[name=\'uniqid\']').val(ui.item.uniqid);
       $('input[name=\'htmlemail\']').val(ui.item.htmlemail);
       $('input[name=\'subscribepage\']').val(ui.item.subscribepage);
       $('input[name=\'rssfrequency\']').val(ui.item.rssfrequency);
       $('input[name=\'password\']').val(ui.item.password);
       $('input[name=\'passwordchanged\']').val(ui.item.passwordchanged);
       $('input[name=\'disabled\']').val(ui.item.disabled);
       $('input[name=\'extradata\']').val(ui.item.extradata);
       $('input[name=\'foreignkey\']').val(ui.item.foreignkey);
       $(this).val(ui.item.email);
    
      //  console.log('error','test');
	//	alert(ui.item.value);
				
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});</script>
<?php echo $footer; ?>
