<div id="templatemo_main">
    <div id="sidebar" class="float_l">
    <div class="sidebar_box"><span class="bottom"></span>
    	<h3>Danh mục sản phẩm</h3>   
        <div class="content"> 
            <?php if(isset($category) && $category != null): ?>
        	<ul class="sidebar_list">
                <?php foreach ($category as $value): ?>
            	<li class="first">
                    <a href="<?php echo base_url("home/product/listcategory/". $value['id']); ?>"><?php echo $value['cate_name']; ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>