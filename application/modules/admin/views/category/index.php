<h1 class="page-header">
                            Quản lý Category
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active" style="float:right">
                                <a href="/admin/category/insert">
                                    <i class="fa fa-file"></i> Create new</a>
                            </li>
                        </ol>
                        <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(isset($category) && $category != null){ 
                                        foreach($category as $value){
                                    ?>
                                    <tr>
                                        <td><?php echo $value['cate_name']; ?></td>
                                        <td><?php echo $value['status']; ?></td>
                                        <td>
                                        <?php if($value['image'] != null): ?>
                                            <img src="/uploads/<?php echo $value['image']; ?>" width="50" />
                                        <?php endif; ?>
                                        </td>
                                        <td>
                                            <a href="/admin/category/edit/<?php echo $value['id']; ?>">Edit</a>&nbsp;&nbsp;&nbsp;
                                            <a onclick="return confirm('Ban co muon xoa khong ?');" href="/admin/category/delete/<?php echo $value['id']; ?>">Delete</a>
                                        </td>
                                    </tr>
                                    <?php  }} ?>
                                </tbody>
                            </table>
                            <div class='pagination'>
                            <?php echo $this->pagination->create_links(); ?>
                            </div>
                        <style>
                            .pagination a{
                                text-decoration: none;
                                background: #ccc;
                                border: 1px solid #f1f1f1;
                                padding: 5px;
                            }
                        </style>