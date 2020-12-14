var btSubmitLogin,signinID;
btSubmitLogin=createElem("#btSubmitLogin");
btSubmitLogin.addEventListener("click",function(event){
    event.preventDefault();
    var btn_prev=this.value;
    this.value="loading...";
    signinID=createElem("#signinID");
    var login_data=new FormData(signinID);
    login_data.append("submit",btn_prev);
    ajax("POST","signin.php",function(response){
        btSubmitLogin.value=btn_prev;
        var resp=JSON.parse(response);
        queryProperty(resp,"error_span",function(){
            createElem("#error_span").innerHTML=resp.error_span;
        });
        queryProperty(resp,"error_email",function(){
            createElem("#error_email").innerHTML=resp.error_email;
        });
        queryProperty(resp,"error_password",function(){
            createElem("#error_password").innerHTML=resp.error_password;
        });
        queryProperty(resp,"error",function(){
            
        });
        queryProperty(resp,"success",function(){
            location.href = "../index.php";
        })
    },login_data);

})