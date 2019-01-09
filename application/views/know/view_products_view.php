<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Product List</title>
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
                <h1>Product
                    <small>List</small>
                </h1>
            </div>

            <table class="table table-striped" id="mydata">
                <thead>
                <tr>
                    <th width="80">Image</th>
                    <th width="120">Product Name</th>
                    <th width="280">Description</th>
                    <th width="70">Price</th>
                    <th width="100">Shop Name</th>
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
<form action="<?php echo site_url('product_cont/product_update')?>" enctype="multipart/form-data" method="post" id="form">
    <div class="modal fade" id="model_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group row">
                        <label for="image" class="col-md-2 col-form-label">Upload Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="product_image">
                            <input type="hidden" class="form-control" name="image_name">
                            <div id="product_image"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Product Name</label>
                        <div class="col-md-10">
                            <input type="hidden" name="product_id_edit" id="product_id_edit" />
                            <input type="text" name="product_name_edit" id="product_name_edit" class="form-control" placeholder="Product Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Product Description</label>
                        <div class="col-md-10">
                            <input type="text" name="product_description_edit" id="product_description_edit" class="form-control" placeholder="Description">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Product Price</label>
                        <div class="col-md-10">
                            <input type="text" name="product_price_edit" id="product_price_edit" class="form-control" placeholder="Product Price">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="select shop" class="col-md-2 col-form-label">Select Shop</label>
                        <div class="col-sm-10" id="shop_list_dropdown">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn_update" class="btn btn-primary">Update</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure to delete this record?</strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="product_id_delete" id="product_id_delete" class="form-control">
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
        show_product();

        //function show all shops
        function show_shops(selected_shop_id){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo site_url('product_cont/shop_list')?>',
                async : true,
                dataType : 'json',
                success : function(data){

                    var html = '<select name="shop_name"  class="form-control">';
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

                }

            });
        }

        //function show all product
        function show_product(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo site_url('product_cont/product_data')?>',
                async : true,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                            '<td><img src="<?php echo base_url() ?>assets/product_images/'+data[i].product_image+'?<?php echo microtime(true);?>" width="70px"/></td>'+
                            '<td>'+data[i].product_name+'</td>'+
                            '<td>'+data[i].product_description+'</td>'+
                            '<td>'+data[i].product_price+'</td>'+
                            '<td>'+data[i].shop_name+'</td>'+
                            '<td style="text-align:right;">'+
                            '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-product_id="'+data[i].product_id+'" data-product_name="'+data[i].product_name+'" data-product_description="'+data[i].product_description+'" data-product_price="'+data[i].product_price+'" data-product_image="'+data[i].product_image+'" data-shop_id="'+data[i].shop_id+'">Edit</a>'+' '+
                            '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-product_id="'+data[i].product_id+'">Delete</a>'+
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
            var product_id           = $(this).data('product_id');
            var product_name         = $(this).data('product_name');
            var product_description  = $(this).data('product_description');
            var product_price        = $(this).data('product_price');
            var product_image        = $(this).data('product_image');
            var shop_id              = $(this).data('shop_id');

            show_shops(shop_id);

            $('#model_edit').modal('show');
            $('[name="product_id_edit"]').val(product_id);
            $('[name="product_name_edit"]').val(product_name);
            $('[name="product_description_edit"]').val(product_description);
            $('[name="product_price_edit"]').val(product_price);
            $('[name="image_name"]').val(product_image);
            $('#product_image').html('<img src="<?php echo base_url() ?>assets/product_images/'+product_image+'" width="70px" />')

        });

        //update record to database
        $("#form").on('submit',(function(e) {
            e.preventDefault();
            var product_id           = $('#product_id_edit').val();
            var product_name         = $('#product_name_edit').val();
            var product_description  = $('#product_description_edit').val();
            var product_price        = $('#product_price_edit').val();
            var product_image        = $('[name="product_image"]').val();
            var shop_id_fk           = $('[name="shop_name"]').val();

            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('product_cont/product_update')?>",
                dataType : "JSON",
                data:  new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
                //data : {product_id:product_id, product_name:product_name, product_description:product_description, product_price:product_price, product_image:product_image, shop_id_fk:shop_id_fk},
                success: function(data){
                    $('[name="product_id_edit"]').val("");
                    $('[name="product_name_edit"]').val("");
                    $('[name="product_description_edit"]').val("");
                    $('[name="product_price_edit"]').val("");
                    $('[name="product_image_edit"]').val("");
                    $('[name="image_name"]').val("");
                    // $('[name="product_image_edit"]').val("");
                    //$('#shop_list_dropdown').html("");
                    $('#model_edit').modal('hide');
                    show_product();
                }
            });
            return true;
        }));

        //get data for delete record
        $('#show_data').on('click','.item_delete',function(){
            var product_id = $(this).data('product_id');
            $('#model_delete').modal('show');
            $('[name="product_id_delete"]').val(product_id);
        });

        //delete record to database
        $('#btn_delete').on('click',function(){
            var product_id = $('#product_id_delete').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('product_cont/product_delete')?>",
                dataType : "JSON",
                data : {product_id:product_id},
                success: function(data){
                    if(typeof data.message !== "undefined") { alert(data.message) };
                    $('[name="product_id_delete"]').val("");
                    $('#model_delete').modal('hide');
                    show_product();
                }
            });
            return false;
        });

    });

</script>
</body>
</html>