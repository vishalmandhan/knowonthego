<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Shop List</title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/views/css/bootstrap.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/views/css/jquery.dataTables.css'?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/views/css/dataTables.bootstrap4.css'?>">
</head>
<body>
<div class="container">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-12">
            <div class="col-md-12">
                <h1>Shop
                    <small>List</small>
                </h1>
            </div>

            <table class="table table-striped" id="mydata">
                <thead>
                <tr>
                    <th width="70">Name</th>
                    <th width="90">Address</th>
                    <th width="60">Country</th>
                    <th width="50">City</th>
                    <th width="220">Location</th>
                    <th width="50">Status</th>
                    <th width="50">Users</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit shop</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Name</label>
                        <div class="col-md-10">
                            <input type="hidden" name="shop_id_edit" id="shop_id_edit" />
                            <input type="text" name="shop_name_edit" id="shop_name_edit" class="form-control" placeholder=" Enter Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Address</label>
                        <div class="col-md-10">
                            <input type="text" name="shop_address_edit" id="shop_address_edit" class="form-control" placeholder="Enter Address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="select country" class="col-md-2 col-form-label">Country</label>
                        <div class="col-sm-10" id="country_list_dropdown">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="select city" class="col-md-2 col-form-label">Select City</label>
                        <div class="col-sm-10" id="city_list_dropdown">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Location</label>
                        <div class="col-md-10">
                            <input type="text" name="shop_location_edit" id="shop_location_edit" class="form-control" placeholder="Map Location">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Status</label>
                        <div class="col-md-1">
                            <input type="checkbox" name="shop_status_edit" id="shop_status_edit" class="form-control">
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Shop</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure to delete this record?</strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="shop_id_delete" id="shop_id_delete" class="form-control">
                    <button type="submit" id="btn_delete" class="btn btn-primary">Yes</button>
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
    $('#mydata').dataTable();

    $(document).ready(function(){
        //call function show all product
        show_shops();

        //function show all shops
        function show_shops(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo site_url('shop_cont/shop_data')?>',
                async : true,
                dataType : 'json',
                success : function(data){
                    var html = '';

                    var i;
                    for(i=0; i<data.length; i++){
                        var activeTxt = "";
                        if(data[i].is_active == 1) { activeTxt = "Active" } else { activeTxt = "Inactive" };
                        html += '<tr>'+
                            '<td>'+data[i].shop_name+'</td>'+
                            '<td>'+data[i].shop_address+'</td>'+
                            '<td>'+data[i].country_name+'</td>'+
                            '<td>'+data[i].city_name+'</td>'+
                            '<td>'+data[i].map_location+'</td>'+
                            '<td>'+activeTxt+'</td>'+
                            '<td>'+data[i].user_name+'</td>'+
                            '<td style="text-align:right;">'+
                            '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-shop_id="'+data[i].shop_id+'" data-shop_name="'+data[i].shop_name+'" data-shop_address="'+data[i].shop_address+'" data-country_id="'+data[i].country_id+'" data-city_id="'+data[i].city_id+'" data-map_location="'+data[i].map_location+'" data-is_active="'+data[i].is_active+'">Edit</a>'+' '+
                            '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-shop_id="'+data[i].shop_id+'">Delete</a>'+
                            '</td>'+
                            '</tr>';
                    }
                    $('#show_data').html(html);
                }
            });
        }

        //function show all countries
        function show_countries(selected_country_id){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo site_url('shop_cont/country_list')?>',
                async : true,
                dataType : 'json',
                success : function(data){

                    var html = '<select name="country_name" id="country_select_box"  class="form-control">';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        var selected = "";
                        if(data[i].country_id == selected_country_id) {
                            selected = "selected";
                        }
                        html += '<option value="'+data[i].country_id+'" '+selected+'>' + data[i].country_name + '</option>';
                    }
                    html += '</select>';
                    $('#country_list_dropdown').html(html);

                    $("#country_select_box").on('change',function(){
                        var country_id = $(this).val();
                        show_countries_cities(country_id);
                    });
                }
            });
        }

        //function show cities of selected countries on change
        function show_countries_cities(country_id){
            $.ajax({
                type : "POST",
                url   : '<?php echo site_url('shop_cont/get_city_by_country')?>',
                data: {country_id:country_id},
                dataType : 'json',
                success : function(data){
                    var html = '';
                    for (var i = 0; i < data.length; i++) {
                        html += '<option value="'+data[i].city_id+'">' + data[i].city_name + '</option>';
                    }
                    $('#shop_cities').html(html);
                }
            });
        }

        //function show all cities
        function show_cities(country_id,selected_city_id){
            $.ajax({
                type  : 'POST',
                url   : '<?php echo site_url('shop_cont/get_city_by_country')?>',
                data : {country_id:country_id},
                dataType : 'json',
                success : function(data){

                    var html = '<select name="city_name" id="shop_cities"  class="form-control">';
                    var i;
                    for (i = 0; i < data.length; i++) {
                        var selected = "";
                        if(data[i].city_id == selected_city_id) {
                            selected = "selected";
                        }
                        html += '<option value="'+data[i].city_id+'" '+selected+'>' + data[i].city_name + '</option>';
                    }
                    html += '</select>';
                    $('#city_list_dropdown').html(html);
                }

            });
        }

        //get data for update record
        $('#show_data').on('click','.item_edit',function(){
            var shop_id                  = $(this).data('shop_id');
            var shop_name                = $(this).data('shop_name');
            var shop_address             = $(this).data('shop_address');
            var country_id               = $(this).data('country_id');
            var city_id                  = $(this).data('city_id');
            var map_location             = $(this).data('map_location');

            show_countries(country_id);
            show_cities(country_id,city_id);

            $('#model_edit').modal('show');
            $('[name="shop_id_edit"]').val(shop_id);
            $('[name="shop_name_edit"]').val(shop_name);
            $('[name="shop_address_edit"]').val(shop_address);
            $('[name="shop_location_edit"]').val(map_location);
            if($(this).data('is_active') == "1") {
                $('[name="shop_status_edit"]').prop("checked",true);
            } else {
                $('[name="shop_status_edit"]').prop("checked",false);
            }
        });

        //update record to database
        $('#btn_update').on('click',function(){
            var shop_id           = $('#shop_id_edit').val();
            var shop_name         = $('#shop_name_edit').val();
            var shop_address      = $('#shop_address_edit').val();
            var country_id_fk     = $('[name="country_name"]').val();
            var city_id_fk        = $('[name="city_name"]').val();
            var map_location      = $('#shop_location_edit').val();
            var status            = 0;

            if($('#shop_status_edit').is(':checked')) {
                status = 1;
            }

            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('shop_cont/shop_update')?>",
                dataType : "JSON",
                data : {shop_id:shop_id, shop_name:shop_name, shop_address:shop_address, country_id_fk:country_id_fk, city_id_fk:city_id_fk, map_location:map_location, status:status },
                success: function(data){
                    $('[name="shop_id_edit"]').val("");
                    $('[name="shop_name_edit"]').val("");
                    $('[name="shop_address_edit"]').val("");
                    $('[name="shop_location_edit"]').val("");
                    $('[name="shop_status_edit"]').val("");

                    $('#model_edit').modal('hide');

                    show_shops();
                }
            });
            return true;
        });

        //get data for delete record
        $('#show_data').on('click','.item_delete',function(){
            var shop_id = $(this).data('shop_id');
            $('#model_delete').modal('show');
            $('[name="shop_id_delete"]').val(shop_id);
        });

        //delete record to database
        $('#btn_delete').on('click',function(){
            var shop_id = $('#shop_id_delete').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('shop_cont/shop_delete')?>",
                dataType : "JSON",
                data : {shop_id:shop_id},
                success: function(data){

                    $('[name="shop_id_delete"]').val("");
                    $('#model_delete').modal('hide');

                    show_shops();
                }
            });
            return false;
        });
    });
</script>
</body>
</html>