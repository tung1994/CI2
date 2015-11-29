
<h1 class="page-header">Edit User</h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                            </li>
                            <li class="active" style='float:right;'>
                                <a href='/admin/user'><i class="fa fa-file"></i> 
                                Back</a>
                            </li>
                        </ol>
                        <form action="" method="post">
                             <label>Username</label>
                             <input type="text" name="name" value="<?php echo $infoUser['name']; ?>" />
                             <span class='error'><?php echo form_error("name"); ?></span>
                             <br/>
                             <label>Email</label>
                             <input type="text" name="email" value="<?php echo $infoUser['email']; ?>" />
                             <span class='error'><?php echo form_error("email"); ?></span>
                             <br/>
                             <label>Password</label>
                             <input type="password" name="pass" value="" />
                             <span class='error'><?php echo form_error("pass"); ?></span>
                             <br/>
                             <label>Re-password</label>
                             <input type="password" name="repass" value="" />
                             <span class='error'><?php echo form_error("repass"); ?></span>
                             <br/>
                             <label>Address</label>
                             <input type="text" name="address" value="<?php echo $infoUser['address']; ?>" />
                             <span class='error'><?php echo form_error("address"); ?></span>
                             <br/>
                             <label>&nbsp;</label>
                             <input type="submit" value="Edit" name="btnok" />
                        </form>
