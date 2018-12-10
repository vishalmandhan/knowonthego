
<!-- ============================================================== -->
<!-- Container fluid   Add Shop Manager -->
<!-- ============================================================== -->
<div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                     <form class="form-horizontal" method="post">
                        <div class="card-body">
                            <h4 class="card-title">Add Product Details</h4>
                             <div class="form-group row">
<!--                                <label for="product_id" class="col-sm-3 text-right control-label col-form-label">Id</label>-->
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Product Id" name="product_id" hidden>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_name" class="col-sm-3 text-right control-label col-form-label">Product Name</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="product_name" placeholder="Enter Product  ">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_description" class="col-sm-3 text-right control-label col-form-label">Product Description</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="product_description" placeholder="Enter Product Description">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="product_price" class="col-sm-3 text-right control-label col-form-label">Product Price</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="product_price" placeholder="Enter Product Price">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-sm-3 text-right control-label col-form-label">Upload Image</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control" name="image">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="select_shop" class="col-sm-3 text-right control-label col-form-label">Select Shop</label>
                                <div class="col-sm-9">
                                    <select id="type" name="select_shop">
                                        <option id="select">Select Type</option>
                                        <option id="shop_type">Db se aaega</option>
                                        <option id="shop_type">Db se aaega</option>
                                        <option id="shop_type">Db se aaega</option>
                                        <option id="shop_type">Db se aaega</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="border-top">
                            <div class="card-body">
                               <a href="<?php echo site_url();?>/dashboard_cont/dashboard"> <button type="button" name="btn_cancel" class="btn btn-default">Cancel</button></a>
                                <button type="button" name="btn_submit" class="btn btn-success">Submit</button>
                            </div>
                        </div>
                     </form>
                </div>
            </div>
        </div>
    </div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
