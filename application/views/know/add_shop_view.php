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
                            <input type="text" class="form-control" name="map_location" id="map_location" placeholder="Select Shop Location From Map" required>
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
        <?php echo $map['js']; ?>
        <div class="col-md-6">
            <?php echo $map['html']; ?>
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