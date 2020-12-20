var updateVoteButton,vote_form;
updateVoteButton=createElem("#updateVoteButton");
updateVoteButton.addEventListener("click",function(event){
    event.preventDefault();
    var btn_prev=this.value;
    this.value="loading...";
    vote_form=createElem("#vote_form");
    var vote_data=new FormData(vote_form);
    vote_data.append("submit",btn_prev);
    ajax("POST","vote/add_vote.php",function(response){
        updateVoteButton.value=btn_prev;
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
        })
    },vote_data);
})