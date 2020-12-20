var updatebtn,profile_form;
updatebtn=createElem("#updatebtn");
updatebtn.addEventListener("click",function(event){
    event.preventDefault();
    var btn_prev=this.value;
    this.value="Submitting...";
    profile_form=createElem("#profile_form");
    var profile_data=new FormData(profile_form);
    profile_data.append("submit",btn_prev);
    ajax("POST","update_profile.php",function(response){
        updatebtn.value=btn_prev;
        var resp=JSON.parse(response);
        queryProperty(resp,"firstName_error",function(){
            createElem("#firstName_error").innerHTML=resp.firstName_error;
        });
        queryProperty(resp,"lastName_error",function(){
            createElem("#lastName_error").innerHTML=resp.lastName_error;
        });
        queryProperty(resp,"error_email",function(){
            createElem("#error_email").innerHTML=resp.error_email;
        });
        queryProperty(resp,"contact_error",function(){
            createElem("#contact_error").innerHTML=resp.contact_error;
        });
        queryProperty(resp,"image_error",function(){
            createElem("#image_error").innerHTML=resp.image_error;
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
    },profile_data);

})