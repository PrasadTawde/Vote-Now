var updateApplicationButton,updateApplicationForm;
updateApplicationButton=createElem("#updateApplicationButton");
updateApplicationButton.addEventListener("click",function(event){
    event.preventDefault();
    var btn_prev=this.value;
    this.value="loading...";
    updateApplicationForm=createElem("#updateApplicationForm");
    var candidate_data=new FormData(updateApplicationForm);
    candidate_data.append("submit",btn_prev);
    ajax("POST","apply/modify_candidate.php",function(response){
        updateApplicationButton.value=btn_prev;
        var resp=JSON.parse(response);
        queryProperty(resp,"error_msg",function(){
            createElem("#error_msg").innerHTML=resp.error_msg;
        });
        queryProperty(resp,"error",function(){
            swal({
                icon:"error",
                title:"Oops!!",
                text:resp.error
            }).then(function(){
                location.reload();
            });
            $('#updateApplicationModal').modal('hide');
        });
        queryProperty(resp,"info",function(){
            swal({
                icon:"info",
                title:"Nothing Happend!",
                text:resp.error
            }).then(function(){
                swal.close();
                $('#updateApplicationModal').modal('hide');
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
            $('#updateApplicationModal').modal('hide');
        })
    },candidate_data);
})