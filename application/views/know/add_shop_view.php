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

                <?php echo form_open('shop_cont/add_shop', 'class="form-horizontal"'); ?>
                <!--                     <form class="form-horizontal" method="post">-->
                <div class="card-body">
                    <h4 class="card-title">Add Shop Details</h4>
                    <div class="form-group row">
<!--                        <label for="name" class="col-sm-3 text-right control-label col-form-label">Id</label>-->
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="userid" placeholder="Shop Id" hidden>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shop_name" class="col-sm-3 text-right control-label col-form-label">Shop
                            Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="shop_name" placeholder="Enter Shop Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shop_address" class="col-sm-3 text-right control-label col-form-label">Shop
                            Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="shop_address"
                                   placeholder="Enter Shop Address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="city" class="col-sm-3 text-right control-label col-form-label">City Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="city" placeholder="Enter City Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="country" class="col-sm-3 text-right control-label col-form-label">Country
                            Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="country" placeholder="Enter Country Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="map_location" class="col-sm-3 text-right control-label col-form-label">Map
                            Location</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="map_location"
                                   placeholder="Enter Shop Location">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_active" class="col-sm-3 text-right control-label col-form-label">Status</label>
                        <div class="col-sm-1">
                            <input type="checkbox" class="form-control" name="status" checked>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="select user" class="col-sm-3 text-right control-label col-form-label">Select
                            Type</label>
                        <div class="col-sm-9">
                            <select name="user_name" class="form-control">
                                <option value="">Select Type</option>
                                <?php foreach ($user_names as $user_name) { ?>
                                    <option value="<?= $user_name['user_id'] ?>"><?= $user_name['user_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="card-body">
                        <a href="<?php echo site_url(); ?>/dashboard_cont/dashboard">
                            <button type="button" name="btn_cancel" class="btn btn-default">Cancel</button>
                        </a>
                        <button type="submit" name="btn_submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
                <!--                     </form>-->
                <?php echo form_close(); ?>

            </div>
        </div>
        <div class="col-md-6">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d8613.933139744011!2d67.02768743301463!3d24.80440171650946!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33d099d178ffb%3A0x5a4f572c3d002126!2sOutfitters!5e0!3m2!1sen!2s!4v1543250792720" width="500" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>

        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->
