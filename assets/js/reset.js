var resetbtn,resetForm;
resetbtn=createElem("#resetbtn");
resetbtn.addEventListener("click",function(event){
    event.preventDefault();
    var btn_prev=this.value;
    this.value="Submitting...";
    resetForm=createElem("#resetForm");
    var reset_data=new FormData(resetForm);
    reset_data.append("submit",btn_prev);
    ajax("POST","reset.php",function(response){
        resetbtn.value=btn_prev;
        var resp=JSON.parse(response);
        queryProperty(resp,"old_error",function(){
            createElem("#old_error").innerHTML=resp.old_error;
        });
        queryProperty(resp,"new_error",function(){
            createElem("#new_error").innerHTML=resp.new_error;
        });
        queryProperty(resp,"confirm_error",function(){
            createElem("#confirm_error").innerHTML=resp.confirm_error;
        });
        queryProperty(resp,"error_span",function(){
            createElem("#error_span").innerHTML=resp.error_span;
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
        })
    },reset_data);

})