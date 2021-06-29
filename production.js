
$(function(){
  $(document).ready(function(){
    //   alert($('#company_code').val());
       
       
       
      checkCompanyCode();
      
  }); 
});

function checkCompanyCode(){    
      if($('#company_code').val() != ''){

      $.ajax({
      url: 'http://homeofbulldogs.com/dev/insurance-csv/get_data.php?company_code='+$('#company_code').val(),
      type : 'GET',
      success:function(data){
          if(data=='' || data==0){
              alert('Please, Enter Correct Company Code.');
              return false;
          }else{
               return true;
          }
        
      }
  });
      }else{
          alert('Please, Enter your Company Code.');
          return false;
      }
       }


function get_csv_data(){
  $.ajax({
      url: 'http://homeofbulldogs.com/dev/insurance-csv/get_data.php',
      type : 'GET',
      success:function(data){
          $('#data_from_server').html(data);
      }
  });  
}
    let selectedFile;
//console.log(window.XLSX);
document.getElementById('input').addEventListener("change", (event) => {
    selectedFile = event.target.files[0];
})

let data=[{"name":"jayanth"}];


document.getElementById('button').addEventListener("click", () => {

    if(checkCompanyCode()==false){
        return false;
    }
    
    if($('#input').val()==''){
        alert('Please, Select Your CSV File.');
        return false;
        
    }
    
    
    
    
    var xl_data = [];
    //XLSX.utils.json_to_sheet(data, 'http://localhost/excel/out.xlsx');
    if(selectedFile){
        let fileReader = new FileReader();
        fileReader.readAsBinaryString(selectedFile);
        fileReader.onload = (event)=>{
            let data = event.target.result;
            let workbook = XLSX.read(data,{type:"binary"});
            // console.log(workbook);
            workbook.SheetNames.forEach(sheet => {
                let rowObject = XLSX.utils.sheet_to_row_object_array(workbook.Sheets[sheet]);
                // console.log(rowObject);
                var myjson = JSON.stringify(rowObject,undefined,4);
                // console.log(myjson[0]);
                $.ajax({
                    url: 'http://homeofbulldogs.com/dev/insurance-csv/jsonfile.php',
                    type: "POST",
                    data: {
                        listdata: myjson,
                        company_code: $('#company_code').val()
                    },
                    success: function (data) { 
                        
                        if(data == true){
                            
                            window.location.href = 'http://homeofbulldogs.com/dev/insurance-csv/IUL/index.php?cc='+$('#company_code').val();
                            
                        }else{
                            console.log(data);
                            // alert(data);
                            return false;
                        }
                        
                     
                        
                    }
                });
               
            });
        }
    }
});