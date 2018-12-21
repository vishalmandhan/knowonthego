
<!-- ============================================================== -->
<!-- Container fluid   Add Shop Manager -->
<!-- ============================================================== -->
<div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">

                    <?php
                    if (isset($db_error)) {
                        echo '<div class="alert alert-danger alert">' . $db_error . '</div>';
                    } elseif (isset($db_success)) {
                        echo '<div class="alert alert-success">' . $db_success . '</div>';
                    }
                    ?>

                    <div class="m-t-25 m-b--5 align-center">
                        <?php echo validation_errors(); ?>
                    </div>

                    <?php echo form_open_multipart('product_cont/add_product', 'class="form-horizontal"')?>
                        <div class="card-body">
                            <h4 class="card-title">Add Product Details</h4>
                             <div class="form-group row">
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Product Id" name="product_id" hidden>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_name" class="col-sm-3 text-right control-label col-form-label">Product Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="product_name" placeholder="Enter Product" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_description" class="col-sm-3 text-right control-label col-form-label">Product Description</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="product_description" placeholder="Enter Product Description" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_price" class="col-sm-3 text-right control-label col-form-label">Product Price</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="product_price" placeholder="Enter Product Price" required">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-sm-3 text-right control-label col-form-label">Upload Image</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="image" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="select shop" class="col-sm-3 text-right control-label col-form-label">Select
                                    Shop</label>
                                <div class="col-sm-9">
                                    <select name="product_shop" class="form-control" required>
                                        <option value="">Select shop</option>
                                        <?php foreach ($shops as $shop) { ?>
                                            <option value="<?= $shop['shop_id'] ?>"><?= $shop['shop_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" name="btn_submit" class="btn btn-success">Submit</button>
                               <a href="<?php echo site_url();?>/dashboard_cont/dashboard"> <button type="button" name="btn_cancel" class="btn btn-default">Cancel</button></a>

                            </div>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
