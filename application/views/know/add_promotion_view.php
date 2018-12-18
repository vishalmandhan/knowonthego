
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
                                    <input type="text" class="form-control" name="promotion_description" placeholder="Enter Promotion Description" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="startDate" class="col-sm-3 text-right control-label col-form-label">Start Date</label>
                                <div class="col-sm-9">
                                    <input type="Date" class="form-control" name="startDate" value="MM/DD/yyyy" required>
                                </div>
                            </div>
                           <div class="form-group row">
                                <label for="endDate" class="col-sm-3 text-right control-label col-form-label">End Date</label>
                                <div class="col-sm-9">
                                    <input type="Date" class="form-control" name="endDate" value="MM/DD/yyyy" required>
                                </div>
                            </div>
                               <div class="form-group row">
                                <label for="status" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                <div class="col-sm-1">
                                    <input type="checkbox" checked="checked" name="status">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="select shop" class="col-sm-3 text-right control-label col-form-label">Select Shop</label>
                                <div class="col-sm-9">
                                    <select name="promotion_shop" id="shop_select_box" class="form-control" required>
                                        <option value="">Select Shop</option>
                                        <?php foreach ($shops as $shop) { ?>
                                            <option value="<?= $shop['shop_id'] ?>"><?= $shop['shop_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-sm-9" id="div_promotion_product">
                                </div>
                            </div>
                        </div>
                    <div class="border-top">
                        <div class="card-body">
                            <button type="submit" name="btn_submit" class="btn btn-success">Submit</button>
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
<script type="text/javascript">
    $("#shop_select_box").on('change',function(){
    var shop_id = $(this).val();
    show_shops_products(shop_id);
    });

    //function show products of selected shops on change
    function show_shops_products(shop_id){
        $.ajax({
            type : "POST",
            url   : '<?php echo site_url('promotion_cont/get_products_by_shop')?>',
            data: {shop_id:shop_id},
            dataType : 'json',
            success : function(data){
                var html = '<select name="promotion_product" class="form-control" required>';
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="'+data[i].product_id+'">' + data[i].product_name + '</option>';
                }
                html += '</select>';
                $('#div_promotion_product').html(html);

                var label_product = '<label for="select shop" class="col-sm-3 text-right control-label col-form-label proLabel">Select Product</label>';
                $('.proLabel').remove();
                $('#div_promotion_product').before(label_product);
            }

        });
    }
</script>