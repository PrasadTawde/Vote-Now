var ScheduleButton,scheduleForm;
ScheduleButton=createElem("#ScheduleButton");
ScheduleButton.addEventListener("click",function(event){
    event.preventDefault();
    var btn_prev=this.value;
    this.value="loading...";
    scheduleForm=createElem("#scheduleForm");
    var election_data=new FormData(scheduleForm);
    election_data.append("submit",btn_prev);
    ajax("POST","election/add_election.php",function(response){
        ScheduleButton.value=btn_prev;
        var resp=JSON.parse(response);
        queryProperty(resp,"error_position",function(){
            createElem("#error_position").innerHTML=resp.error_position;
        });
        queryProperty(resp,"error_dept",function(){
            createElem("#error_dept").innerHTML=resp.error_dept;
        });
        queryProperty(resp,"error_course",function(){
            createElem("#error_course").innerHTML=resp.error_course;
        });
        queryProperty(resp,"error_date",function(){
            createElem("#error_date").innerHTML=resp.error_date;
        });
        queryProperty(resp,"error_time_from",function(){
            createElem("#error_time_from").innerHTML=resp.error_time_from;
        });
        queryProperty(resp,"error_time_to",function(){
            createElem("#error_time_to").innerHTML=resp.error_time_to;
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

            $('#scheduleElectionModal').modal('hide');
        })
    },election_data);
})