
<!-- ============================================================== -->
<!-- Container fluid   Add Shop Manager -->
<!-- ============================================================== -->
<div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                     <form class="form-horizontal" method="post">
                        <div class="card-body">
                            <h4 class="card-title">Add Promotion Details</h4>
                             <div class="form-group row">
<!--                                <label for="promotion_id" class="col-sm-3 text-right control-label col-form-label">ID</label>-->
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" placeholder="Promotion Id" name="promotion_id" hidden>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="promotion_description" class="col-sm-3 text-right control-label col-form-label">Promotion Description</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="promotion_description" placeholder="Enter Promotion Description">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="startDate" class="col-sm-3 text-right control-label col-form-label">Start Date</label>
                                <div class="col-sm-9">
                                    <input type="Date" class="form-control" name="startDate" value="2018-11-12" min="2018-01-01" max="2018-12-31">
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="endDate" class="col-sm-3 text-right control-label col-form-label">End Date</label>
                                <div class="col-sm-9">
                                    <input type="Date" class="form-control" name="endDate" value="2018-11-12" min="2018-01-01" max="2018-12-31">
                                </div>
                            </div>
                               <div class="form-group row">
                                <label for="status" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                <div class="col-sm-1">
                                    <input type="checkbox" class="form-control" name="status">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="select_product" class="col-sm-3 text-right control-label col-form-label">Select Product</label>
                                <div class="col-sm-9">
                                    <select id="type" name="select_product">
                                        <option id="select">Select Product</option>
                                        <option id="product_type">Db se aaega</option>
                                        <option id="product_type">Db se aaega</option>
                                        <option id="product_type">Db se aaega</option>
                                        <option id="product_type">Db se aaega</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="button" name="btn_submit" class="btn btn-success">Submit</button>
                           <a href="<?php echo site_url();?>/dashboard_cont/dashboard"> <button type="button" name="btn_cancel" class="btn btn-default">Cancel</button></a>

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
