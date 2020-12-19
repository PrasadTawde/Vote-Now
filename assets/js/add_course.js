var addCourseButton,courseForm;
addCourseButton=createElem("#addCourseButton");
addCourseButton.addEventListener("click",function(event){
    event.preventDefault();
    var btn_prev=this.value;
    this.value="loading...";
    courseForm=createElem("#courseForm");
    var course_data=new FormData(courseForm);
    course_data.append("submit",btn_prev);
    ajax("POST","course/add_course.php",function(response){
        addCourseButton.value=btn_prev;
        var resp=JSON.parse(response);
        queryProperty(resp,"error_msg",function(){
            createElem("#error_msg").innerHTML=resp.error_msg;
        });
        queryProperty(resp,"error_msg2",function(){
            createElem("#error_msg2").innerHTML=resp.error_msg2;
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

            $('#addCourseModal').modal('hide');
        })
    },course_data);
})