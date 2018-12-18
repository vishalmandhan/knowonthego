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
                <div class="card-body">
                    <h4 class="card-title">Add Shop Details</h4>
                    <div class="form-group row">
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="shop_id" placeholder="Shop Id" hidden>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shop_name" class="col-sm-3 text-right control-label col-form-label">Shop Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="shop_name" placeholder="Enter Shop Name" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shop_address" class="col-sm-3 text-right control-label col-form-label">Shop
                            Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="shop_address" placeholder="Enter Shop Address" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="select country" class="col-sm-3 text-right control-label col-form-label">Select Country</label>
                        <div class="col-sm-9">
                            <select id="country_select_option" name="shop_country" class="form-control" required>
                                <option value="">Select Country</option>
                                <?php foreach ($countries as $country) { ?>
                                    <option value="<?= $country['country_id'] ?>"><?= $country['country_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-9" id="div_cities_select_box">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="map_location" class="col-sm-3 text-right control-label col-form-label">Map Location</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="map_location" placeholder="Enter Shop Location" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="is_active" class="col-sm-3 text-right control-label col-form-label">Status</label>
                        <div class="col-sm-1">
                            <input type="checkbox" checked="checked" name="status">
                        </div>
                    </div>
                    <?php if ($session_data['is_admin']) { ?>
                    <div class="form-group row">
                        <label for="select user" class="col-sm-3 text-right control-label col-form-label">Select User</label>
                        <div class="col-sm-9">
                            <select name="shop_users" class="form-control" required>
                                <option value="">Select User</option>
                                <?php foreach ($users as $user) { ?>
                                    <option value="<?= $user['user_id'] ?>"><?= $user['user_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <?php } ?>
                </div>
                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" name="btn_submit" class="btn btn-success">Submit</button>
                        <a href="<?php echo site_url(); ?>/dashboard_cont/dashboard">
                            <button type="button" name="btn_cancel" class="btn btn-default">Cancel</button>
                        </a>
                    </div>
                </div>
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
<script type="text/javascript">
    $("#country_select_option").on('change',function(){
        var country_id = $(this).val();
        show_cities(country_id);
    });

    //function show cities of selected countries on change
    function show_cities(country_id){
        $.ajax({
            type : "POST",
            url   : '<?php echo site_url('shop_cont/get_cities_by_country')?>',
            data: {country:country_id},
            dataType : 'json',
            success : function(data){
                var html = '<select name="shop_city" class="form-control" required>';
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="'+data[i].city_id+'">' + data[i].city_name + '</option>';
                }
                html += '</select>';
                $('#div_cities_select_box').html(html);

                var label_product = '<label for="select city" class="col-sm-3 text-right control-label col-form-label cityLabel">Select City</label>';
                $('.cityLabel').remove();
                $('#div_cities_select_box').before(label_product);
            }

        });
    }
</script>