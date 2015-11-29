<div id="content" class="float_r">
    <?php if(isset($product) && $product != null ): ?>
    <h1>Sản phẩm mới nhất</h1>
        <?php foreach ($product as $listpro):?>
        <div class="product_box">
            <a href="">
                <img src="/uploads/<?php echo $listpro['image']; ?>" alt="Image 01" width="200" height="150" />
            </a>
            <h3><?php echo $listpro['name']; ?></h3>
            <p class="product_price"><?php echo number_format($listpro['price'],0); ?></p>
            <a href="shoppingcart.html" class="add_to_card">Add to Cart</a>
            <a href="productdetail.html" class="detail">Detail</a>
        </div>        	
        <?php endforeach; ?>
    <?php endif; ?>
</div> 