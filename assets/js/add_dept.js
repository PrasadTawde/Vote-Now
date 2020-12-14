var addDeptButton,deptForm;
addDeptButton=createElem("#addDeptButton");
addDeptButton.addEventListener("click",function(event){
    event.preventDefault();
    var btn_prev=this.value;
    this.value="loading...";
    deptForm=createElem("#deptForm");
    var dept_data=new FormData(deptForm);
    dept_data.append("submit",btn_prev);
    ajax("POST","department/add_department.php",function(response){
        addDeptButton.value=btn_prev;
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

            $('#addDeptModal').modal('hide');
        })
    },dept_data);

})