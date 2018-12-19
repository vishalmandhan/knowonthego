<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>User List</title>
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
                <h1>User
                    <small>List</small>
                </h1>
            </div>

            <table class="table table-striped" id="mydata">
                <thead>
                <tr>
                    <th width="210">Full Name</th>
                    <th width="120">UserName</th>
                    <th width="200">Email</th>
                    <th width="80">Status</th>
                    <th width="60">Type</th>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Full Name</label>
                        <div class="col-md-10">
                            <input type="hidden" name="user_id_edit" id="user_id_edit" />
                            <input type="text" name="user_name_edit" id="user_name_edit" class="form-control" placeholder="Full Name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Email</label>
                        <div class="col-md-10">
                            <input type="text" name="user_email_edit" id="user_email_edit" class="form-control" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label">Status</label>
                        <div class="col-md-1">
                            <input type="checkbox" name="user_status_edit" id="user_status_edit" class="form-control" placeholder="Email Address">
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
                    <h5 class="modal-title" id="exampleModalLabel">Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>Are you sure to delete this record?</strong>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="user_id_delete" id="user_id_delete" class="form-control">
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
        //call function show all users
        show_user();


        //function show all users
        function show_user(){
            $.ajax({
                type  : 'ajax',
                url   : '<?php echo site_url('user_cont/user_data')?>',
                async : true,
                dataType : 'json',
                success : function(data){
                    var html = '';

                    var i;
                    for(i=0; i<data.length; i++){
                        var activeTxt = "";
                        if(data[i].is_active == 1) { activeTxt = "Active" } else { activeTxt = "Inactive" };
                        html += '<tr>'+
                            '<td>'+data[i].user_name+'</td>'+
                            '<td>'+data[i].username+'</td>'+
                            '<td>'+data[i].user_email+'</td>'+
                            '<td>'+activeTxt+'</td>'+
                            '<td>'+data[i].user_type+'</td>'+
                            '<td style="text-align:right;">'+
                            '<a href="javascript:void(0);" class="btn btn-info btn-sm item_edit" data-user_id="'+data[i].user_id+'" data-user_name="'+data[i].user_name+'" data-user_username="'+data[i].username+'" data-user_email="'+data[i].user_email+'" data-user_status="'+data[i].is_active+'">Edit</a>'+' '+
                            '<a href="javascript:void(0);" class="btn btn-danger btn-sm item_delete" data-user_id="'+data[i].user_id+'">Delete</a>'+
                            '</td>'+
                            '</tr>';
                    }
                    $('#show_data').html(html);
                }

            });
        }

        //get data for update record
        $('#show_data').on('click','.item_edit',function(){
            var user_id           = $(this).data('user_id');
            var user_name         = $(this).data('user_name');
            var user_email        = $(this).data('user_email');

            $('#model_edit').modal('show');
            $('[name="user_id_edit"]').val(user_id);
            $('[name="user_name_edit"]').val(user_name);
            $('[name="user_email_edit"]').val(user_email);
            if($(this).data('user_status') == "1") {
                $('[name="user_status_edit"]').prop("checked",true);
            } else {
                $('[name="user_status_edit"]').prop("checked",false);
            }

        });

        //update record to database
        $('#btn_update').on('click',function(){
            var user_id           = $('#user_id_edit').val();
            var user_name         = $('#user_name_edit').val();
            var user_email        = $('#user_email_edit').val();
            var is_active         = 0;
            if($('#user_status_edit').is(':checked')) {
                is_active = 1;
            }

            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('user_cont/user_update')?>",
                dataType : "JSON",
                data : {user_id:user_id, user_name:user_name, user_email:user_email, is_active:is_active },
                success: function(data){
                    $('[name="user_id_edit"]').val("");
                    $('[name="user_name_edit"]').val("");
                    $('[name="user_email_edit"]').val("");
                    $('[name="user_status_edit"]').val("");

                    $('#model_edit').modal('hide');
                    show_user();
                }
            });
            return true;
        });

        //get data for delete record
        $('#show_data').on('click','.item_delete',function(){
            var user_id = $(this).data('user_id');
            $('#model_delete').modal('show');
            $('[name="user_id_delete"]').val(user_id);
        });

        //Delete data for delete record
        $('#btn_delete').on('click',function(){

            $.ajax({
                type : "POST",
                url  : "<?php echo site_url('user_cont/user_delete')?>",
                dataType : "JSON",
                data : {user_id : $('#user_id_delete').val()},
                success: function(data){
                    if(typeof data.message !== "undefined") { alert(data.message) };
                    $('[name="user_id_delete"]').val("");
                    $('#model_delete').modal('hide');
                    show_user();
                }
            });
            return false;
        });

    });

</script>
</body>
</html>