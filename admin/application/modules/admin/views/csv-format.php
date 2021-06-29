<?php 
// print_r($users);
$searchtext = '';
if(!empty($_GET['search'])){
  $searchtext = $_GET['search'];
}
?>

<style type="text/css">
  .profileimgcont{
    margin-top: 25px;
  }
  .profileimgcont img{
    border: 1px solid #e1e1e1;
    padding: 2px;
    max-height: 125px;
  }
</style>

<div class="content-wrapper">
  <div class="page-title">
    <div style="width: 100%">
      <div class="row">
        <div class="col-md-4">
          <h1 class="text-uppercase"> 
              <i class="fa fa-users"></i> CSV FORMAT
          </h1>
        </div>
        
        <div class="col-md-4">
           <div class="form-group">
    
    <select class="form-control" id="company_code" name="company_code">
              <option value="">Select Company</option>
        <?php 
        if(!empty($company)){
            foreach($company as $c){
                ?>
                      <option value="<?=$c->company_code?>" <?php if($c->company_code==$company_code_id){echo 'selected';}?>><?=$c->company_name?></option>
                <?php
            }
        }
        ?>

    </select>
  </div>
        </div>
        
        <div class="col-md-4">
           <a href="<?php echo base_url('admin/add-csv-format');?>"><button type="button" class="btn btn-success btn-block" data-toggle="modal"  data-target="">Add New Company Format</button></a>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="contents">
            <div class="row">
              <div class="col-md-12">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                            <th>#</th>                         
                            <!-- <th>TYPE</th> -->
                            <th>COMPNAY CODE</th>
                            <th>DELETE</th>
                             <th>CSV FORMAT</th>
                             
                            <!--<th>COMPANY NAME</th>  -->
                            <!--<th>DATA</th>  -->
                            
                            
                          
                        </tr>
                      </thead>
                      <tbody>
                        <!--<input type="hidden" name="txtcounttotal" id="txtcounttotal" value="<?php echo $totalcount; ?>">-->
                          <?php 
                          
                        //   print_r($csv_format_data);

                          if(!empty($csv_format_data)){
                            $count = 0;
                            foreach ($csv_format_data as $csv_data) {
                              $count++;
                            
                          ?>

                            <tr class="">
                                <td><?php echo $count; ?></td>
                               
                              
                                
                                <td>
                                  <div style="color: #cc0d53" ><strong><?php echo ucwords($csv_data->company_code);?></strong></div>
                                  
                                </td>
                                 <td></td>
                                <td style="display: inline-flex; width: max-content;">
                                    
                                    <?php 
                                    $jsondata = json_decode($csv_data->csv_format);
                                    foreach($jsondata as $csv_json){
                                        echo '<span style="border:1px solid black;padding: 3px">'.$csv_json.'</span>';
                                    }
                                    ?>
                                    
                                    
                                    </td>
                                
                                
                                 <!--<td>
                                  <button data-id="<?php echo $user->id; ?>" data-name="<?php echo $user->company_name; ?>"  data-toggle="modal"  data-target="#modalAccountStatus" class="btn btn-primary btn-sm edit" ><i class="fa fa-pen"></i> EDIT</button>
                                </td>
                                
                                <td>
                                  <button data-id="<?php echo $user->id; ?>"  data-toggle="modal"  data-target="#modalDeleteAccount" class="btn btn-danger btn-sm" onclick="$('#deleteusrid').val($(this).attr('data-id'))" ><i class="fa fa-trash"></i> DELETE</button>
                                </td>-->
                            </tr>

                          <?php
                            }
                          }else{
                              echo "<td colspan='4' style='text-align:center'><h3>No Data Found.</h3><td>";
                          }
                          ?>
                      </tbody>
                    </table>
                  </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="modal" id="modalAccountStatus">
  <div class="modal-dialog">
    <div class="modal-content"> 
      <div class="modal-header">
        <h4 class="modal-title"><span id="statussp"></span> Company</h4>
      </div> 
      <form name="formAddCompany" id="formAddCompany">
      <div class="modal-body">
          <div class="form-group">
              <label for="exampleInputEmail1">Enter Company Name</label>
             <input type="text" id="company_name" name="company_name" placeholder="Enter Company Name" class="form-control" required>
             <input type="hidden" id="editcompanyid" name="editcompanyid" value="0" class="form-control" required>
            </div> 
            <div class="clearfix" id="enblemsg"></div>
        </div> 
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>        
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--<div class="modal" id="UpdateCompany">
  <div class="modal-dialog">
    <div class="modal-content"> 
      <div class="modal-header">
        <h4 class="modal-title"><span id="statussp"></span> Company</h4>
      </div> 
      <form name="formEditCompany" id="formEditCompany">
      <div class="modal-body">
          <div class="form-group">
              <label for="exampleInputEmail1">Enter Company Name</label>
             <input type="text" id="company_name" name="company_name" placeholder="Enter Company Name" class="form-control" required>
            </div> 
            <div class="clearfix" id="enblemsg"></div>
        </div> 
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>        
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </form>
    </div>
  </div>
</div>-->

<div class="modal" id="modalDeleteAccount">
  <div class="modal-dialog">
    <div class="modal-content"> 
      <div class="modal-header">
        <h4 class="modal-title">Delete Company</h4>
      </div> 
      <div class="modal-body">
        <form name="formAccountdelete" id="formAccountdelete">
          <div class="form-group">
            <h3 class="text-center" style="color: #f00;">Are you sure, you want to delete this Company account?</h3>
            <input type="hidden" class="form-control" id="deleteusrid" name="deleteusrid">
          </div> 
          <div class="clearfix" id="enblemsg"></div>
          <center><button type="submit" class="btn btn-primary">Delete</button></center>
        </form>
      </div> 
      <div class="modal-footer">        
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!--<div class="mypagination">-->
<!--  <button href="" data-click="1" class="btn btn-danger btn-sm"> <i class="fa fa-backward"></i> &nbsp; PREV</button>-->
<!--  <button href="" data-click="2" class="btn btn-danger btn-sm"> NEXT <i class="fa fa-forward"> &nbsp; </i></button>-->
<!--</div>-->

 <script type="text/javascript">
 
    $('.edit').click(function(){
        $('#editcompanyid').val($(this).attr('data-id'));
        $('#company_name').val($(this).attr('data-name'));
        
    });
 
 
  $('#company_code').change(function(){
        var company_code = $(this).val();
        
        if(company_code != ''){
               
            window.location.href ='<?php echo base_url('admin/CSV-Format/')?>'+company_code;
        }else{
            window.location.href = '<?php echo base_url('admin/CSV-Format')?>';
        }
        
    });
 
    
    $('#formAddCompany').on('submit', function(e){       
        e.preventDefault();

        $('#enblemsg').removeClass(' alert alert-info');
        $('#enblemsg').removeClass(' alert alert-success');
        $('#enblemsg').removeClass(' alert alert-danger');


        $('#enblemsg').html('Please wait');
        $('#enblemsg').show().delay(5000).fadeOut();
        $('#enblemsg').addClass(' alert alert-info');
        // $('#myloader').show();
        $.ajax({
            url: '<?php echo base_url('admin/add-comapny'); ?>',
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            async: true,
            success: function (data) { 
                    console.log(data);
                $('#enblemsg').removeClass(' alert alert-info');
                if(data == "success"){
                    $('#enblemsg').html('Added successfully.');
                    $('#enblemsg').show().delay(5000).fadeOut();
                    $('#enblemsg').addClass(' alert alert-success');
                     location.reload();
                    return true;
                }
                if(data == "error"){
                  $('#enblemsg').html('Error to add, retry');
                  $('#enblemsg').show().delay(5000).fadeOut();
                  $('#enblemsg').addClass(' alert alert-danger');
                  return false;
                }

                $('#enblemsg').html(data);
                $('#enblemsg').show().delay(5000).fadeOut();
                $('#enblemsg').addClass(' alert alert-danger');
            }
        });
    });

     $('#formAccountStatus').on('submit', function(e){       
        e.preventDefault();

        $('#rstatusmsg').removeClass(' alert alert-info');
        $('#rstatusmsg').removeClass(' alert alert-success');
        $('#rstatusmsg').removeClass(' alert alert-danger');


        $('#rstatusmsg').html('Please wait');
        $('#rstatusmsg').show().delay(5000).fadeOut();
        $('#rstatusmsg').addClass(' alert alert-info');
        // $('#myloader').show();
        $.ajax({
            url: '<?php echo base_url('admin/users-status'); ?>',
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            async: true,
            success: function (data) { 

                $('#rstatusmsg').removeClass(' alert alert-info');
                if(data == "success"){
                    $('#rstatusmsg').html('Change successfully.');
                    $('#rstatusmsg').show().delay(5000).fadeOut();
                    $('#rstatusmsg').addClass(' alert alert-success');
                     location.reload();
                    return true;
                }
                if(data == "error"){
                  $('#rstatusmsg').html('Error to change, retry');
                  $('#rstatusmsg').show().delay(5000).fadeOut();
                  $('#rstatusmsg').addClass(' alert alert-danger');
                  return false;
                }

                $('#rstatusmsg').html(data);
                $('#rstatusmsg').show().delay(5000).fadeOut();
                $('#rstatusmsg').addClass(' alert alert-danger');
            }
        });
    });



    $('#formAccountdelete').on('submit', function(e){       
        e.preventDefault();

        $('#delmsg').removeClass(' alert alert-info');
        $('#delmsg').removeClass(' alert alert-success');
        $('#delmsg').removeClass(' alert alert-danger');


        $('#delmsg').html('Please wait');
        $('#delmsg').show().delay(5000).fadeOut();
        $('#delmsg').addClass(' alert alert-info');
        // $('#myloader').show();
        $.ajax({
            url: '<?php echo base_url('admin/remove-company'); ?>',
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            async: true,
            success: function (data) { 

                $('#delmsg').removeClass(' alert alert-info');
                if(data == "success"){
                    $('#delmsg').html('Successfully deleted.');
                    $('#delmsg').show().delay(5000).fadeOut();
                    $('#delmsg').addClass(' alert alert-success');
                     location.reload();
                    return true;
                }
                if(data == "error"){
                  $('#delmsg').html('Error to delete account, retry');
                  $('#delmsg').show().delay(5000).fadeOut();
                  $('#delmsg').addClass(' alert alert-danger');
                  return false;
                }

                $('#delmsg').html(data);
                $('#delmsg').show().delay(5000).fadeOut();
                $('#delmsg').addClass(' alert alert-danger');
            }
        });
    });



    $(function(){
        $("#search").keyup(function () {
            var value = this.value.toLowerCase().trim();
            $("table tr").each(function (index) {
                if (!index) return;
                $(this).find("td").each(function () {
                    var id = $(this).text().toLowerCase().trim();
                    var not_found = (id.indexOf(value) == -1);
                    $(this).closest('tr').toggle(!not_found);
                    return not_found;
                });
            });
        });


        $('.mypagination button').click(function(){

            var records = 10;
            var ret_data = $('#txtcounttotal').val();
            if(ret_data == ""){
              ret_data = 0;
            }
            ret_data = parseInt(ret_data);

            var dataClick = $(this).attr('data-click');
            var searchtext = getUrlVars()['search'];
            if(typeof(searchtext) == "undefined"){
              searchtext = '';
            }

            var pageno = getUrlVars()['page'];
            if(typeof(pageno) == "undefined"){
              pageno = 0;
            }

            pageno = parseInt(pageno);
            if(parseInt(dataClick) == 1){
              pageno = pageno - 1;
              if(pageno < 0){
                pageno = 0;
              }
            }
            else if(parseInt(dataClick) == 2){
              pageno = pageno + 1;
              if(ret_data < records){
                return false;
              }
            }
             
            var redirectUrl = '<?php echo base_url('admin/users') ?>?search='+searchtext+"&page="+pageno;
            window.location.href = redirectUrl;
        });

        $('.accountbtn').click(function(){
            var ac_status = 1;
            var ac_activetext = " Enable ";
            var cr_ac_status = $(this).attr('data-active');
            if(cr_ac_status == 1){
              ac_status = 0;
              ac_activetext = " Disable ";
            }
            $('#accountactiveusrid').val($(this).attr('data-id'));
            $('#accountactive').val(ac_status);
            $('#acmsg').html(ac_activetext);
            $('#enablesp').html(ac_activetext); 
        });


         $('.accountstatbtn').click(function(){
            // var ac_status = 1;
            // var ac_activetext = " Active ";
             
            var user_profile = $(this).attr('data-user');
            var cr_ac_status = $(this).attr('data-status');
            // if(cr_ac_status == 1){
            //   ac_status = 0;
            //   ac_activetext = " Deactive ";
            // }
            $('#accountstatususrid').val($(this).attr('data-id'));
            // $('#accountstatus').val(ac_status);
            // $('#statussp').html(ac_activetext);
            // $('#statusmsg').html(ac_activetext); 
            $('#accountstatus option[value=2]').attr('disabled', true);
            $('#accountstatus option[value=2]').css('color', '#f00 !important');
            if(user_profile == '2'){
              // <option value="2"> Suspend</option> 
              $('#accountstatus option[value=2]').attr('disabled', false);
              $('#accountstatus option[value=2]').css('color', '#000 !important');
              
            } 
        })

    })

    function getUrlVars() {
      var vars = {};
      var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,    
      function(m,key,value) {
        vars[key] = value;
      });
      return vars;
    }
    
</script>
         
 
 

      
    