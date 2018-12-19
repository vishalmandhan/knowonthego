<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Customer List</title>
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
                <h1>Customer
                    <small>List</small>
                </h1>
            </div>

            <table class="table table-striped" id="mydata">
                <thead>
                <tr>
                    <th width="100">Name</th>
                    <th width="90">UserName</th>
                    <th width="70">Email</th>
                    <th width="50">Contact</th>
                    <th width="50">Status</th>
                    <th width="90">App ID</th>
                    <th width="90">Date</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Full Name</label>
                        <div class="col-md-10">
                            <input type="hidden" name="customer_id_edit" id="customer_id_edit" />
                            <input type="text" name="customer_name_edit" id="customer_name_edit" class="form-control" placeholder="Full Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-10">
                            <input type="text" name="customer_email_edit" id="customer_email_edit" class="form-control" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Contact</label>
                        <div class="col-md-10">
                            <input type="text" name="customer_contact_edit" id="customer_contact_edit" class="form-control" placeholder="Contact">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Status</label>
                        <div class="col-md-1">
                            <input type="checkbox" name="customer_status_edit" id="customer_status_edit" class="form-control" placeholder="Status">
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure to delete this record?</strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="customer_id_delete" id="customer_id_delete" class="form-control">
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
    $('#mydata').dataTable();

    $(document).ready(function(){
        //call function show all customers
        show_customers();


        //function show all users
        function show_customers(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo site_url('customer_cont/customer_data')?>',
                async : true,
                dataType : 'json',
                success : function(data){
                    var html = '';
                    var i;
                    for(i=0; i<data.length; i++){
                        var activeTxt = "";
                        if(data[i].status == 1) { activeTxt = "Active" } else { activeTxt = "Inactive" };
                        html += '<tr>'+
                            '<td>'+data[i].customer_name+'</td>'+
                            '<td>'+data[i].username+'</td>'+
                            '<td>'+data[i].customer_email+'</td>'+
                            '<td>'+data[i].contact+'</td>'+
                            '<td>'+activeTxt+'</td>'+
                            '<td>'+data[i].application_id+'</td>'+
                            '<td>'+data[i].dateTime+'</td>'+
                            '<td style="text-align:right;">'+
                            '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-customer_id="'+data[i].customer_id+'" data-customer_name="'+data[i].customer_name+'" data-customer_username="'+data[i].username+'" data-customer_email="'+data[i].customer_email+'" data-customer_contact="'+data[i].contact+'" data-customer_status="'+data[i].status+'" data-customer_appid="'+data[i].application_id+'" data-datetime="'+data[i].dateTime+'">Edit</a>'+' '+
                            '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-customer_id="'+data[i].customer_id+'">Delete</a>'+
                            '</td>'+
                            '</tr>';
                    }
                    $('#show_data').html(html);
                }

            });
        }

        //get data for update record
        $('#show_data').on('click','.item_edit',function(){
            var customer_id           = $(this).data('customer_id');
            var customer_name         = $(this).data('customer_name');
            var customer_email        = $(this).data('customer_email');
            var customer_contact      = $(this).data('customer_contact');

            $('#model_edit').modal('show');
            $('[name="customer_id_edit"]').val(customer_id);
            $('[name="customer_name_edit"]').val(customer_name);
            $('[name="customer_email_edit"]').val(customer_email);
            $('[name="customer_contact_edit"]').val(customer_contact);
            if($(this).data('customer_status') == "1") {
                $('[name="customer_status_edit"]').prop("checked",true);
            } else {
                $('[name="customer_status_edit"]').prop("checked",false);
            }

        });

        //update record to database
        $('#btn_update').on('click',function(){
            var customer_id           = $('#customer_id_edit').val();
            var customer_name         = $('#customer_name_edit').val();
            var customer_email        = $('#customer_email_edit').val();
            var customer_contact      = $('#customer_contact_edit').val();
            var status         = 0;
            if($('#customer_status_edit').is(':checked')) {
                status = 1;
            }

            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('customer_cont/customer_update')?>",
                dataType : "JSON",
                data : {customer_id:customer_id, customer_name:customer_name, customer_email:customer_email, customer_contact:customer_contact, status:status },
                success: function(data){
                    $('[name="customer_id_edit"]').val("");
                    $('[name="customer_name_edit"]').val("");
                    $('[name="customer_email_edit"]').val("");
                    $('[name="customer_contact_edit"]').val("");
                    $('[name="customer_status_edit"]').val("");

                    $('#model_edit').modal('hide');
                    show_customers();
                }
            });
            return true;
        });

        //get data for delete record
        $('#show_data').on('click','.item_delete',function(){
            var customer_id = $(this).data('customer_id');
            $('#model_delete').modal('show');
            $('[name="customer_id_delete"]').val(customer_id);
        });

        //Delete data for delete record
        $('#btn_delete').on('click',function(){

            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('customer_cont/customer_delete')?>",
                dataType : "JSON",
                data : {customer_id : $('#customer_id_delete').val()},
                success: function(data){
                    if(typeof data.message !== "undefined") { alert(data.message) };
                    $('[name="customer_id_delete"]').val("");
                    $('#model_delete').modal('hide');
                    show_customers();
                }
            });
            return false;
        });

    });

</script>
</body>
</html>