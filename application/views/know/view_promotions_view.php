<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Promotion List</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/views/css/bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/views/css/jquery.dataTables.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/views/css/dataTables.bootstrap4.css'?>">
</head>
<body>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1>Promotion
                    <small>List</small>
                </h1>
            </div>

            <table class="table table-striped" id="mydata">
                <thead>
                <tr>
                    <th width="150">Description</th>
                    <th width="90">StartDate</th>
                    <th width="90">EndDate</th>
                    <th width="50">Status</th>
                    <th width="60">Product</th>
                    <th width="60">Shop</th>
                    <th width="60">User</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
                </thead>
                <tbody id="show_data">

                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- MODAL EDIT -->

<form>
    <div class="modal fade" id="model_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Promotion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Description</label>
                        <div class="col-md-10">
                            <input type="hidden" name="promotion_id_edit" id="promotion_id_edit" />
                            <input type="text" name="promotion_description_edit" id="promotion_description_edit" class="form-control" placeholder="Description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Start Date</label>
                        <div class="col-md-10">
                            <input type="text" name="promotion_startDate_edit" id="promotion_startDate_edit" class="form-control" placeholder="YY-MM-DD">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">End Date</label>
                        <div class="col-md-10">
                            <input type="text" name="promotion_endDate_edit" id="promotion_endDate_edit" class="form-control" placeholder="YY-MM-DD">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Status</label>
                        <div class="col-md-1">
                            <input type="checkbox" name="promotion_status_edit" id="promotion_status_edit" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="select shop" class="col-md-2 col-form-label">Select Shop</label>
                        <div class="col-sm-10" id="shop_list_dropdown">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="select product" class="col-md-2 col-form-label">Select Product</label>
                        <div class="col-sm-10" id="product_list_dropdown">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" type="submit" id="btn_update" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--END MODAL EDIT-->

<!--MODAL DELETE-->
<form>
    <div class="modal fade" id="model_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Promotion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure to delete this record?</strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="promotion_id_delete" id="promotion_id_delete" class="form-control">
                    <button type="button" type="submit" id="btn_delete" class="btn btn-primary">Yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--END MODAL DELETE-->

<script type="text/javascript" src="<?php echo base_url().'assets/views/js/jquery.dataTables.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/views/js/bootstrap.js'?>"></script>
<script type="text/javascript" src="<?php echo base_url().'assets/views/js/dataTables.bootstrap4.js'?>"></script>

<script type="text/javascript">

    $(document).ready(function(){
        //call function show all product
        show_promotion();

        //function show all shops
        function show_shops(selected_shop_id){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo site_url('product_cont/shop_list')?>',
                async : true,
                dataType : 'json',
                success : function(data){

                    var html = '<select name="shop_name" id="shop_select_box"  class="form-control">';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        var selected = "";
                        if(data[i].shop_id == selected_shop_id) {
                            selected = "selected";
                        }
                        html += '<option value="'+data[i].shop_id+'" '+selected+'>' + data[i].shop_name + '</option>';
                    }
                    html += '</select>';
                    $('#shop_list_dropdown').html(html);

                    $("#shop_select_box").on('change',function(){
                        var shop_id = $(this).val();
                        show_shops_products(shop_id);
                    });
                }

            });
        }

        //function show products of selected shops on change
        function show_shops_products(shop_id){
            $.ajax({
                type : "POST",
                url   : '<?php echo site_url('promotion_cont/get_products_by_shop')?>',
                data: {shop_id:shop_id},
                dataType : 'json',
                success : function(data){
                    var html = '';
                    for (var i = 0; i < data.length; i++) {
                        html += '<option value="'+data[i].product_id+'">' + data[i].product_name + '</option>';
                    }
                    $('#shop_products').html(html);
                }

            });
        }

        //function show all products
        function show_products(shop_id,selected_product_id){
            $.ajax({
                type  : 'POST',
                url   : '<?php echo site_url('promotion_cont/get_products_by_shop')?>',
                data : {shop_id:shop_id},
                dataType : 'json',
                success : function(data){

                    var html = '<select name="product_name" id="shop_products"  class="form-control">';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        var selected = "";
                        if(data[i].product_id == selected_product_id) {
                            selected = "selected";
                        }
                        html += '<option value="'+data[i].product_id+'" '+selected+'>' + data[i].product_name + '</option>';
                    }
                    html += '</select>';
                    $('#product_list_dropdown').html(html);
                }

            });
        }

        //function show all promotions
        function show_promotion(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo site_url('promotion_cont/promotion_data')?>',
                async : true,
                dataType : 'json',
                success : function(data){
                    var html = '';

                    var i;
                    for(i=0; i<data.length; i++){
                        var activeTxt = "";
                        if(data[i].status == 1) { activeTxt = "Active" } else { activeTxt = "Inactive" };
                        html += '<tr>'+
                            '<td>'+data[i].promotion_description+'</td>'+
                            '<td>'+data[i].startDate+'</td>'+
                            '<td>'+data[i].endDate+'</td>'+
                            '<td>'+activeTxt+'</td>'+
                            '<td>'+data[i].product_name+'</td>'+
                            '<td>'+data[i].shop_name+'</td>'+
                            '<td>'+data[i].user_name+'</td>'+
                            '<td style="text-align:right;">'+
                            '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-promotion_id="'+data[i].promotion_id+'" data-promotion_description="'+data[i].promotion_description+'" data-start_date="'+data[i].startDate+'" data-end_date="'+data[i].endDate+'" data-status="'+data[i].status+'" data-shop_id="'+data[i].shop_id+'" data-product_id="'+data[i].product_id+'">Edit</a>'+' '+
                            '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-promotion_id="'+data[i].promotion_id+'">Delete</a>'+
                            '</td>'+
                            '</tr>';
                    }
                    $('#show_data').html(html);
                    $('#mydata').dataTable();
                }

            });
        }

        //get data for update record
        $('#show_data').on('click','.item_edit',function(){
            var promotion_id                  = $(this).data('promotion_id');
            var promotion_description         = $(this).data('promotion_description');
            var startDate                     = $(this).data('start_date');
            var endDate                       = $(this).data('end_date');
            var shop_id                       = $(this).data('shop_id');
            var product_id                    = $(this).data('product_id');

            show_shops(shop_id);
            show_products(shop_id,product_id);

            $('#model_edit').modal('show');
            $('[name="promotion_id_edit"]').val(promotion_id);
            $('[name="promotion_description_edit"]').val(promotion_description);
            $('[name="promotion_startDate_edit"]').val(startDate);
            $('[name="promotion_endDate_edit"]').val(endDate);
            if($(this).data('status') == "1") {
                $('[name="promotion_status_edit"]').prop("checked",true);
            } else {
                $('[name="promotion_status_edit"]').prop("checked",false);
            }

        });

        //update record to database
        $('#btn_update').on('click',function(){
            var promotion_id                  = $('#promotion_id_edit').val();
            var promotion_description         = $('#promotion_description_edit').val();
            var startDate                     = $('#promotion_startDate_edit').val();
            var endDate                       = $('#promotion_endDate_edit').val();
            var shop_id_fk                    = $('[name="shop_name"]').val();
            var product_id_fk                 = $('[name="product_name"]').val();
            var status         = 0;

            if($('#promotion_status_edit').is(':checked')) {
                status = 1;
            }

            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('promotion_cont/promotion_update')?>",
                dataType : "JSON",
                data : {promotion_id:promotion_id, promotion_description:promotion_description, startDate:startDate, endDate:endDate, status:status, shop_id_fk:shop_id_fk, product_id_fk:product_id_fk },
                success: function(data){
                    $('[name="promotion_id_edit"]').val("");
                    $('[name="promotion_description_edit"]').val("");
                    $('[name="promotion_startDate_edit"]').val("");
                    $('[name="promotion_endDate_edit"]').val("");
                    $('[name="promotion_status_edit"]').val("");

                    $('#model_edit').modal('hide');

                    show_promotion();
                }
            });
            return true;
        });

        //get data for delete record
        $('#show_data').on('click','.item_delete',function(){
            var promotion_id = $(this).data('promotion_id');
            $('#model_delete').modal('show');
            $('[name="promotion_id_delete"]').val(promotion_id);
        });

        //delete record to database
        $('#btn_delete').on('click',function(){
            var promotion_id = $('#promotion_id_delete').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('promotion_cont/promotion_delete')?>",
                dataType : "JSON",
                data : {promotion_id:promotion_id},
                success: function(data){

                    $('[name="promotion_id_delete"]').val("");
                    $('#model_delete').modal('hide');

                    show_promotion();
                }
            });
            return false;
        });
    });
</script>
</body>
</html>