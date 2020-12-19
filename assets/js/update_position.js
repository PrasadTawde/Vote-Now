var updatePositionButton,updatePositionForm;
updatePositionButton=createElem("#updatePositionButton");
updatePositionButton.addEventListener("click",function(event){
    event.preventDefault();
    var btn_prev=this.value;
    this.value="loading...";
    updatePositionForm=createElem("#updatePositionForm");
    var position_data=new FormData(updatePositionForm);
    position_data.append("submit",btn_prev);
    ajax("POST","position/update_position.php",function(response){
        updatePositionButton.value=btn_prev;
        var resp=JSON.parse(response);
        queryProperty(resp,"error_msg",function(){
            createElem("#error_msg").innerHTML=resp.error_msg;
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
            $('#updatePositionModal').modal('hide');
        })
    },position_data);
})