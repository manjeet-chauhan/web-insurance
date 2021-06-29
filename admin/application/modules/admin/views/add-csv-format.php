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
        <div class="col-md-8">
          <h1 class="text-uppercase"> 
              <i class="fa fa-users"></i>ADD CSV FORMAT
          </h1>
        </div>
        
        <div class="col-md-4">
           
        </div>
        
       
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="contents">
            
            <div class="row">
              <div class="col-md-6">
                  <div class="form-group">
    <label for="exampleFormControlSelect1">Select Company</label>
    <select class="form-control" id="company_code" name="company_code">
              <option value="">Select Company</option>
        <?php 
        if(!empty($company)){
            foreach($company as $c){
                ?>
                      <option value="<?=$c->company_code?>"><?=$c->company_name?></option>
                <?php
            }
        }
        ?>

    </select>
    
  </div>
              </div>
              <div class="col-md-6">
                                  <div class="form-group">
                    <label for="exampleFormControlSelect1">Upload CSV Format</label>
                    <div id="file_input"><input class="form-control" type="file" id="input_file" accept=""  ></div>
                    
                  </div>
              </div>
              
              <!--<div class="col-md-12" id="csv-data">
                  <div class="row">
                  <div id="csv-field"><div class="col-md-3"><input class="form-control" type="text" id="column[]" accept=""  ></div></div>
                  
                 </div>
                 <button class="btn btn-primary" type="button" id="add">Add</button>
                 
                  </div>
              -->
              <div class="col-md-6"><div id="msg" style="background:orange;color:white;border-radius:2px"></div></div>
              
              <div class="col-md-12"><button type="submit" id="csv_button" style="float:right" class="btn btn-success">Submit</button></div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>




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
<script src="http://homeofbulldogs.com/dev/insurance-csv/xls.js"></script>
 <script type="text/javascript">
 
    
 
//  $('#format-option').change(function(){
//         var value = $(this).val();
        
//         if(value==1){
//             $('#csv-data').html('<div id="file_input"><input class="form-control" type="file" id="input" accept=""  ></div>');
//         }else if(value==2){
//             $('#csv-data').html('<div id="file_input"><input class="form-control" type="file" id="input" accept=""  ></div>');
//         }else{
//             $('#csv-data').empty();
//         }
        
//     });
    
    
//     $('#add').click(function(){
//         $('#csv-field').append('<div class="col-md-3"><input class="form-control" type="text" id="column[]" accept=""  ></div>');
        
//     });
 
    $(function(){
     let selectedFile;
//console.log(window.XLSX);
document.getElementById('input_file').addEventListener("change", (event) => {
    selectedFile = event.target.files[0];
})

let data=[{"name":"jayanth"}];


document.getElementById('csv_button').addEventListener("click", () => {
    
    $('#msg').hide();
    
  
    
    
    var xl_data = [];
    //XLSX.utils.json_to_sheet(data, 'http://localhost/excel/out.xlsx');
    if(selectedFile){
        let fileReader = new FileReader();
        fileReader.readAsBinaryString(selectedFile);
        fileReader.onload = (event)=>{
            let data = event.target.result;
            let workbook = XLSX.read(data,{type:"binary"});
            console.log(workbook.Sheets[workbook.SheetNames[0]]);
            // workbook.Sheets.Sheet1.forEach
            // workbook.SheetNames.forEach(sheet => {
            //     // let rowObject = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
            //     // console.log(rowObject);
            //     var myjson = JSON.stringify(rowObject,undefined,4);
            //     // console.log(myjson[0]);
                $.ajax({
                    url: "<?php echo base_url('admin/save-csv-format');?>",
                    type: "POST",
                    data: {
                        listdata: workbook.Sheets[workbook.SheetNames[0]],
                        company_code: $('#company_code').val(),
                    },
                    success: function (data) { 
                        
                        if(data=='success'){
                            window.location.href= "<?php echo base_url('admin/CSV-Format')?>";
                        }else{
                            
                            $('#msg').html(data).show(1000);
                        }
                        // console.log(data);
                        //alert(data);
                        // location.reload();
                        return true;
                    }
                });
               
            // });
        }
    }else{
        
    
    
            $('#msg').html('Please, Upload Your File.').show(1000);
    }
});


});
</script>
         
 
 

      
    