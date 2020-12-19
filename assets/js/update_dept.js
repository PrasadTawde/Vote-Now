var updateDeptButton,updateDeptForm;
updateDeptButton=createElem("#updateDeptButton");
updateDeptButton.addEventListener("click",function(event){
    event.preventDefault();
    var btn_prev=this.value;
    this.value="loading...";
    updateDeptForm=createElem("#updateDeptForm");
    var dept_data=new FormData(updateDeptForm);
    dept_data.append("submit",btn_prev);
    ajax("POST","department/update_department.php",function(response){
        updateDeptButton.value=btn_prev;
        var resp=JSON.parse(response);
        queryProperty(resp,"namedpt_error",function(){
            createElem("#namedpt_error").innerHTML=resp.namedpt_error;
        });
        queryProperty(resp,"error",function(){
            swal({
                icon:"error",
                title:"Oops!!",
                text:resp.error
            });
        });
        queryProperty(resp,"success",function(){
            swal({
                icon:"success",
                title:"successful",
                text:resp.success
            }).then(function(){
                location.reload();
            });
            $('#updateDeptModal').modal('hide');
        })
    },dept_data);
})