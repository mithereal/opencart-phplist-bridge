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
      <h1><img src="view/image/mail.png" alt="" /> <?php echo $message_title; ?></h1>
      <div class="buttons"><a id="button-send" <a onclick="$('#form').submit();" class="button"><?php echo $button_send; ?></a><a href="<?php echo $cancel; ?>" class="button"><?php echo $button_cancel; ?></a></div>
    </div>
    <div class="content">
           
          <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
               <input type="hidden" id="id" name="id" value="<?php
                     if(isset( $message['id'])){
                       echo $message['id']; 
                       }
                    
                        ?>">
               <?php
           //    var_dump($message); 
               ?>
        <table id="mail" class="form">
         <tr>
          <td>
          <?php echo $entry_from;?>
          </td>
          <td><input id="sender_email" type="text" name="sender_email" value="<?php echo $senderemail; ?>" /></td>
           </tr>
           
          <tr>
            <td><?php echo $entry_to; ?></td>
            <td>
                <?php
        foreach ($lists as $list) {
             if(isset($list['checked']))
        {
               ?>
                 <input type="checkbox"  name="subscribe[]" value="<?php echo $list['id']; ?>" checked="<?php echo $list['checked']; ?>">
                     <?php
                     }else{
         ?>
                      <input type="checkbox"  name="subscribe[]" value="<?php echo $list['id']; ?>">
                      <?php
                     }
                     if(!empty($list['description'])){
                     echo $list['description'];
                     }else{
                     echo $list['name'];
                     }
                      }
                     
                     ?>
              
            </td>
   
          </tr>
        
          <tr>
            <td><span class="required">*</span> <?php echo $entry_subject; ?></td>
            <td><input type="text" name="subject" value="<?php echo $message['subject']; ?>" size="80"/></td>
          </tr>
          <tr>
          <td>Send As:</td>
          
           <td>
             HTML <input name="sendformat" value="html" <?php
           if($message['sendformat']=="html")
        {
        echo 'checked';
        }
               ?> type="radio">
             <?php echo $entry_text; ?> <input name="sendformat" <?php
           if($message['sendformat']=="text")
        {
        echo 'checked';
        }
               ?> value="text"  type="radio">
            </td>
            </tr>
          <tr>
          <td>Delay Sending Until</td>
          <td><input id="embargo" type="text" name="embargo" value="<?php echo $message['embargo']; ?>" /></td>
           </tr>
          <tr>
          <td>email to alert when sending of this message starts</td>
          <td><input id="emailalertstart" type="text" name="emailalertstart" value="<?php echo $message['emailalertstart']; ?>" /></td>
           </tr>
          <tr>
          <td>email to alert when sending of this message ends</td>
          <td><input id="emailalertend" type="text" name="emailalertend" value="<?php echo $message['emailalertend']; ?>" /></td>
           </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $entry_message; ?></td>
            <td><textarea name="message"><?php echo $message['message']; ?></textarea></td>
          </tr>
          </form>
        </table>
    </div>
  </div>
</div>
<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
<script type="text/javascript"><!--
CKEDITOR.replace('message', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
//--></script> 
<script type="text/javascript"><!--	
$('select[name=\'to\']').bind('change', function() {
	$('#mail .to').hide();
	
	$('#mail #to-' + $(this).attr('value').replace('_', '-')).show();
});

$('select[name=\'to\']').trigger('change');
//--></script> 
<script type="text/javascript"><!--

$.widget('custom.catcomplete', $.ui.autocomplete, {
	_renderMenu: function(ul, items) {
		var self = this, currentCategory = '';
		
		$.each(items, function(index, item) {
			if (item.category != currentCategory) {
				ul.append('<li class="ui-autocomplete-category">' + item.category + '</li>');
				
				currentCategory = item.category;
			}
			
			self._renderItem(ul, item);
		});
	}
});

$('input[name=\'customers\']').catcomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/customer/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {	
				response($.map(json, function(item) {
					return {
						category: item.customer_group,
						label: item.name,
						value: item.customer_id
					}
				}));
			}
		});
		
	}, 
	select: function(event, ui) {
		$('#customer' + ui.item.value).remove();
		
		$('#customer').append('<div id="customer' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="customer[]" value="' + ui.item.value + '" /></div>');

		$('#customer div:odd').attr('class', 'odd');
		$('#customer div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('#customer div img').live('click', function() {
	$(this).parent().remove();
	
	$('#customer div:odd').attr('class', 'odd');
	$('#customer div:even').attr('class', 'even');	
});
//--></script> 
<script type="text/javascript"><!--	
$('input[name=\'affiliates\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=sale/affiliate/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.affiliate_id
					}
				}));
			}
		});
		
	}, 
	select: function(event, ui) {
		$('#affiliate' + ui.item.value).remove();
		
		$('#affiliate').append('<div id="affiliate' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="affiliate[]" value="' + ui.item.value + '" /></div>');

		$('#affiliate div:odd').attr('class', 'odd');
		$('#affiliate div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('#affiliate div img').live('click', function() {
	$(this).parent().remove();
	
	$('#affiliate div:odd').attr('class', 'odd');
	$('#affiliate div:even').attr('class', 'even');	
});

$('input[name=\'products\']').autocomplete({
	delay: 500,
	source: function(request, response) {
		$.ajax({
			url: 'index.php?route=catalog/product/autocomplete&token=<?php echo $token; ?>&filter_name=' +  encodeURIComponent(request.term),
			dataType: 'json',
			success: function(json) {		
				response($.map(json, function(item) {
					return {
						label: item.name,
						value: item.product_id
					}
				}));
			}
		});
	}, 
	select: function(event, ui) {
		$('#product' + ui.item.value).remove();
		
		$('#product').append('<div id="product' + ui.item.value + '">' + ui.item.label + '<img src="view/image/delete.png" alt="" /><input type="hidden" name="product[]" value="' + ui.item.value + '" /></div>');

		$('#product div:odd').attr('class', 'odd');
		$('#product div:even').attr('class', 'even');
				
		return false;
	},
	focus: function(event, ui) {
      	return false;
   	}
});

$('#product div img').live('click', function() {
	$(this).parent().remove();
	
	$('#product div:odd').attr('class', 'odd');
	$('#product div:even').attr('class', 'even');	
});

function send(url) { 
	$('textarea[name=\'message\']').html(CKEDITOR.instances.message.getData());
	
	$.ajax({
		url: url,
		type: 'post',
		data: $('select, input, textarea'),		
		dataType: 'json',
		beforeSend: function() {
			$('#button-send').attr('disabled', true);
			$('#button-send').before('<span class="wait"><img src="view/image/loading.gif" alt="" />&nbsp;</span>');
		},
		complete: function() {
			$('#button-send').attr('disabled', false);
			$('.wait').remove();
		},				
		success: function(json) {
			$('.success, .warning, .error').remove();
			
			if (json['error']) {
				if (json['error']['warning']) {
					$('.box').before('<div class="warning" style="display: none;">' + json['error']['warning'] + '</div>');
			
					$('.warning').fadeIn('slow');
				}
				
				if (json['error']['subject']) {
					$('input[name=\'subject\']').after('<span class="error">' + json['error']['subject'] + '</span>');
				}	
				
				if (json['error']['message']) {
					$('textarea[name=\'message\']').parent().append('<span class="error">' + json['error']['message'] + '</span>');
				}									
			}			
			
			if (json['next']) {
				if (json['success']) {
					$('.box').before('<div class="success">' + json['success'] + '</div>');
					
					send(json['next']);
				}		
			} else {
				if (json['success']) {
					$('.box').before('<div class="success" style="display: none;">' + json['success'] + '</div>');
			
					$('.success').fadeIn('slow');
				}					
			}				
		}
	});
}
//--></script> 

<script type="text/javascript">
 // if user clicked on button, the overlay layer or the dialogbox, close the dialog 

 
     $('#button-send-email').click(function () {        
        var addemail = $('input[id=add_email]').val();  
        
         $.post('index.php?route=module/phplist/addEmail&token=<?php echo $token; ?>', { email: addemail },function(data) 
        {
        $('#sender_email').html(data);
        });
        
        $('#dialog-overlay, #dialog-box').toggle();  
        return false;
    });
    
    
    $('#dialog-overlay').click(function () {        
         $('#dialog-overlay, #dialog-box').toggle();     
         $('#dialog-message-email, #dialog-textbox-email,#button-send-email').hide();     
         $('#dialog-message, #dialog-textbox,#button-send-name').hide();     
        return false;
    });
    
    $('#addemail').click(function () {        
         $('#dialog-overlay, #dialog-box').toggle();     
         $('#dialog-message-email, #dialog-textbox-email,#button-send-email').show();     
         $('#dialog-message, #dialog-textbox,#button-send-name').hide();     
        return false;
    });
    
    $('#dialog-box').keydown(function(e)
    {
        if(e.which === 13)
        { 
               // var id=$(this).attr('checked').val();
              alert("id");
            
             return false;
           }
    });
    
     $('#button-send-name').click(function () {        
        var addfrom = $('input[id=add_from]').val();  
        
        $.post('index.php?route=module/phplist/addFrom&token=<?php echo $token; ?>', { from: addfrom }, function(data) {

        $('#from').html(data);
        });


        $('#dialog-overlay, #dialog-box').toggle();  
        return false;
    });
    
    
    $('#addfrom').click(function () {        
         $('#dialog-overlay, #dialog-box').toggle();     
         $('#dialog-message-email, #dialog-textbox-email,#button-send-email').hide();    
         $('#dialog-message, #dialog-textbox,#button-send-name').show();  
        return false;
    });
    
    // if user resize the window, call the same function again
    // to make sure the overlay fills the screen and dialogbox aligned to center    
    $(window).resize(function () {
        
        //only do it if the dialog box is not hidden
        if (!$('#dialog-box').is(':hidden')) popup();        
    });    
    
    
//Popup dialog
function popup(message) {
        
    // get the screen height and width
    var maskHeight = $(document).height();
    var maskWidth = $(window).width();
    
    // calculate the values for center alignment
    var dialogTop = (maskHeight/3) - ($('#dialog-box').height());
    var dialogLeft = (maskWidth/2) - ($('#dialog-box').width()/2);
    
    // assign values to the overlay and dialog box
    $('#dialog-overlay').css({height:maskHeight, width:maskWidth}).show();
    $('#dialog-box').css({top:dialogTop, left:dialogLeft}).show();
    
    // display the message
    $('#dialog-message').html(message);
            
}

$('#embargo').datetimepicker();
</script>
<?php echo $footer; ?>
