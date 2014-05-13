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
<?PHP
if(isset($settings))
{
?>
<div id="tabs" class="htabs"><a href="index.php?route=module/phplist&token=<?php echo $token; ?>" style="display: inline;">Settings</a><a class="selected" href="index.php?route=module/phplist/config&token=<?php echo $token; ?>" style="display: inline;">Config</a><a href="index.php?route=module/phplist/tools&token=<?php echo $token; ?>" style="display: inline;">Tools</a></div>
<?php
}else{
?>
<div id="tabs" class="htabs"><a class="selected" href="index.php?route=module/phplist&token=<?php echo $token; ?>" style="display: inline;">Settings</a><a href="index.php?route=module/phplist/config&token=<?php echo $token; ?>" style="display: inline;">Config</a><a href="index.php?route=module/phplist/tools&token=<?php echo $token; ?>" style="display: inline;">Tools</a></div>
<?php
}
if(isset($settings))
{
?>
<p class="leaftitle">phplist - configure phplist</p>
<p class="information">Here you need to specify the correct values for your website.<br>
You can use certain <b>Placeholders</b> in your values.
Placeholders look like <b>[SOMETEXT]</b>, where <i>SOMETEXT</i> can be different.
Some useful placeholders are:
</p>
<div class="placeholders">
<ul>
<li>WEBSITE - the address you type for your website</li>
<li>DOMAIN - the text you type for your domain</li>
<li>SUBSCRIBEURL - the location of the subscribe page</li>
<li>UNSUBSCRIBEURL - the location of the unsubscribe page</li>
<li>BLACKLISTURL - the location of the unsubscribe page for unknown users</li>
<li>PREFERENCESURL - the location of the page where users can update their details</li>
<li>CONFIRMATIONURL - the location of the page where users have to confirm their subscription</li>
</ul>
</div>
<?php
}else{
?>
<p class="leaftitle">phplist - configure phplist Database</p>
<p class="information">Here you need to specify the correct values for your websites phplist database prefix.<br>

</p>
<?php
}
?>
    <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        
    
<?php
//var_dump($settings);
?>
          <table id="module" class="form ">
               <tr>
    <td>
    <?php 
     echo $text_dbprefix;
     ?>
         </td>
    <td>
   <input type="text" name="dbprefix" id="dbprefix" value="<?php echo htmlentities($dbprefix) ?>"size="25">
         </td>
         </tr>

<?php
if(isset($settings))
{
?>

    <td>
       </td> 
</tr>
<tr>
    <td>
    <?php 
     echo $entry_default_list;
     ?>
         </td>
    <td>
        <select name="defaultlist">
        <?php
foreach($lists as $list)
{
?>
<option id="<?php echo trim($list['id']);?>" value="<?php echo trim($list['id']); ?>">
    <?php
    echo $list['name'];
    ?>
</option>
<?php
}
        ?>
        </select>
         </td>
</tr>
<?php
foreach($settings as $setting)
{
?>
<tr>
    <td>
    <?php 
     echo $setting['entry'];
     ?>
         </td>

    <td>
<?php
    if(isset($setting['inputtype']) && $setting['inputtype'] =='textarea')
    {
    ?>
       <textarea name="<?php echo $setting['item'] ?>" id="<?php echo $setting['item'] ?>" rows="15" cols="100"><?php echo htmlentities($setting['value']) ?></textarea>
    <?php
    }else{
    ?>
   <input type="text" name="<?php echo $setting['item'] ?>" id="<?php echo $setting['item'] ?>" value="<?php echo htmlentities($setting['value']) ?>"size="80">
   <?php
}
?>
    </td>
</tr>

<?php
}
}
?>
      </table>
    </form>
  </div>
</div>
</div>

<script type="text/javascript" src="view/javascript/ckeditor/ckeditor.js"></script>
<script type="text/javascript"><!--
CKEDITOR.replace('phplist_description', {
	filebrowserBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashBrowseUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserImageUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>',
	filebrowserFlashUploadUrl: 'index.php?route=common/filemanager&token=<?php echo $token; ?>'
});
//--></script>

<script type="text/javascript"><!--
var module_row = <?php echo $module_row; ?>;

function addModule() {	
	html  = '<tbody id="module-row' + module_row + '">';
	html += '  <tr>';
	html += '    <td class="left"><select name="phplist_module[' + module_row + '][layout_id]">';
	<?php foreach ($layouts as $layout) { ?>
	html += '      <option value="<?php echo $layout['layout_id']; ?>"><?php echo addslashes($layout['name']); ?></option>';
	<?php } ?>
	html += '    </select></td>';
	html += '    <td class="left"><select name="phplist_module[' + module_row + '][position]">';
	html += '      <option value="content_top"><?php echo $text_content_top; ?></option>';
	html += '      <option value="content_bottom"><?php echo $text_content_bottom; ?></option>';
	html += '      <option value="column_left"><?php echo $text_column_left; ?></option>';
	html += '      <option value="column_right"><?php echo $text_column_right; ?></option>';
	html += '    </select></td>';
	html += '    <td class="left"><select name="phplist_module[' + module_row + '][status]">';
    html += '      <option value="1" selected="selected"><?php echo $text_enabled; ?></option>';
    html += '      <option value="0"><?php echo $text_disabled; ?></option>';
    html += '    </select></td>';
	html += '    <td class="right"><input type="text" name="phplist_module[' + module_row + '][sort_order]" value="" size="3" /></td>';
	html += '    <td class="left"><a onclick="$(\'#module-row' + module_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
	html += '  </tr>';
	html += '</tbody>';
	
	$('#module tfoot').before(html);
	
	module_row++;
}
//--></script> 

<?php echo $footer; ?>
