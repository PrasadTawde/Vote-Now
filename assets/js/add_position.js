var addPositionButton,positionForm;
addPositionButton=createElem("#addPositionButton");
addPositionButton.addEventListener("click",function(event){
    event.preventDefault();
    var btn_prev=this.value;
    this.value="loading...";
    positionForm=createElem("#positionForm");
    var position_data=new FormData(positionForm);
    position_data.append("submit",btn_prev);
    ajax("POST","position/add_position.php",function(response){
        addPositionButton.value=btn_prev;
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

            $('#addPositionModal').modal('hide');
        })
    },position_data);
})