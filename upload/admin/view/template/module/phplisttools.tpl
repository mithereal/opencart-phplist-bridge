<?php echo $header; ?>
<div id="content">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
    <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
<?php if (isset($error_warning)) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<div class="box">
  <div class="heading">
    <h1><img src="view/image/module.png" alt="" /> <?php echo $heading_title; ?></h1>
    <div class="buttons"><a onclick="$('#form').submit();" class="button"><span><?php echo $button_save; ?></span></a><a onclick="location = '<?php echo $cancel; ?>';" class="button"><span><?php echo $button_cancel; ?></span></a></div>
  </div>
  <div class="content">
      <div align="left">
<br>


<div id="tabs" class="htabs"><a href="index.php?route=module/phplist&token=<?php echo $token; ?>" style="display: inline;">Settings</a><a href="index.php?route=module/phplist/config&token=<?php echo $token; ?>" style="display: inline;">Config</a><a class="selected" href="index.php?route=module/phplist/tools&token=<?php echo $token; ?>" style="display: inline;">Tools</a></div>

 <div class="buttons"><a id="iocd" class="button"><span><?php echo $button_createocd; ?></span></a></div>
 
</div>
      <div id="result">
          
      </div>

      
      <script type="text/javascript"><!--	
       $('#iocd').click(function(){
	var page; 
        var num_pages;

		$.ajax({
			url: 'index.php?route=module/phplist/ocimport&token=<?php echo $token; ?>',
             
            dataType: 'json',
			success: function(json) {		
				
                               console.log(json);
                               page=json['page'] ;
                               num_pages=json['max_pages'];
                               
                               for(var i = 0; json['emails'].length; i++)
                               {
                               $('#result').append(json['emails'][i]['email']);
                               $('#result').append('<br/>');
                               }
                              
                           
			}
		});
                
                   while(page <= num_pages)
        {
        $.ajax({
			url: 'index.php?route=module/phplist/ocimport&token=<?php echo $token; ?>',
             
            dataType: 'json',
			success: function(json) {		
				
                               console.log(json);
                               page=json['page'] ;
                               
                               for(var i = 0; json['emails'].length; i++)
                               {
                               $('#result').append(json['emails'][i]['email']);
                               $('#result').append('<br/>');
                               }
			}
		});

	}

	
});</script>
<?php echo $footer; ?>
