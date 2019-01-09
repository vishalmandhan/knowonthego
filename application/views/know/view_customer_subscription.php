<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Customer Subscription</title>
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
                <h1>Customer
                    <small>Subscription</small>
                </h1>
            </div>

            <table class="table table-striped" id="mydata">
                <thead>
                <tr>
                    <th width="150">Customer Name</th>
                    <th width="130">Shop Name</th>
                    <th width="150">Date Time</th>
                    <th style="text-align: right;">Actions</th>
                </tr>
                </thead>
                <tbody id="show_data">

                </tbody>
            </table>
        </div>
    </div>

</div>

<!--MODAL DELETE-->
<form>
    <div class="modal fade" id="model_delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Subscription</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure to delete this record?</strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="customer_subscribe_id" id="customer_subscribe_id" class="form-control">
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

    $(document).ready(function(){
        //call function show all customer Subscription
        show_subscription();

        //function show all shop subscriptions
        function show_subscription(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo site_url('customer_cont/customer_subscription_data')?>',
                async : true,
                dataType : 'json',
                success : function(data){
                    var html = '';

                    var i;
                    for(i=0; i<data.length; i++){
                        html += '<tr>'+
                            '<td>'+data[i].customer_name+'</td>'+
                            '<td>'+data[i].shop_name+'</td>'+
                            '<td>'+data[i].dateTime+'</td>'+
                            '<td style="text-align:right;">'+
                            '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-customer_subscribe_id="'+data[i].customer_subscribe_id+'">Delete</a>'+
                            '</td>'+
                            '</tr>';
                    }
                    $('#show_data').html(html);
                    $('#mydata').dataTable();
                }
            });
        }

        //get data for delete record
        $('#show_data').on('click','.item_delete',function(){
            var subscribe_id = $(this).data('customer_subscribe_id');
            $('#model_delete').modal('show');
            $('[name="customer_subscribe_id"]').val(subscribe_id);
        });

        //delete record to database
        $('#btn_delete').on('click',function(){
            var subscribe_id = $('#customer_subscribe_id').val();
            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('customer_cont/customer_subscribe_delete')?>",
                dataType : "JSON",
                data : {customer_subscribe_id : $('#customer_subscribe_id').val()},
                success: function(data){

                    $('[name="customer_subscribe_id"]').val("");
                    $('#model_delete').modal('hide');

                    show_subscription();
                }
            });
            return false;
        });
    });
</script>
</body>
</html>