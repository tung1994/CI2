<h3><?php echo isset($title) ? $title : ""; ?></h3>
<form action="" method="post" enctype="multipart/form-data">
	 <table class="table table-bordered table-hover">
		<tbody>
            <tr>
        	    <td width="130">Category name</td>
             	<td>
             		<input type="text" name="cate_name" value="<?php echo isset($info['cate_name']) ? $info['cate_name'] : ""; ?>" />
             		<span class="error"><?php echo form_error("cate_name"); ?></span>
             	</td>
            </tr>
            <tr>
        	    <td width="130">Category Parent</td>
             	<td>
             		<select name="parent">
             			<option value=""></option>
             		</select>
             	</td>
            </tr>
            <tr>
        	    <td width="130">Category Status</td>
             	<td>Active<input type="radio" name="status" value="0" <?php echo isset($info['status']) && $info['status'] == 0 ? "checked" : "checked"; ?> />
             		Disable<input type="radio" name="status" value="1" <?php echo isset($info['status']) && $info['status'] == 1 ? "checked" : ""; ?> />
             	</td>
            </tr>
             <tr>
        	    <td width="130">Category Images</td>
             	<td>
             		<input type="file" name="images" />
             		<br/>
             		<?php if(isset($info['image'])  && $info['image'] != null): ?>
             		<img src="/uploads/<?php echo $info['image'] ?>" width="100" />
             		<?php endif; ?>
             	</td>
            </tr>
            <tr>
        	    <td width="130">&nbsp;</td>
             	<td><input type="submit" name="btnok" value="<?php echo isset($title) ? $title : ""; ?>" /></td>
            </tr>
       	</tbody>
	</table>
</form>