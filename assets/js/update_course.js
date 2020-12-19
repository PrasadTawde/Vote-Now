var updateCourseButton,updateCourseForm;
updateCourseButton=createElem("#updateCourseButton");
updateCourseButton.addEventListener("click",function(event){
    event.preventDefault();
    var btn_prev=this.value;
    this.value="loading...";
    updateCourseForm=createElem("#updateCourseForm");
    var course_data=new FormData(updateCourseForm);
    course_data.append("submit",btn_prev);
    ajax("POST","course/update_course.php",function(response){
        updateCourseButton.value=btn_prev;
        var resp=JSON.parse(response);
        queryProperty(resp,"dept_error",function(){
            createElem("#dept_error").innerHTML=resp.dept_error;
        });
        queryProperty(resp,"course_error",function(){
            createElem("#course_error").innerHTML=resp.course_error;
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
            $('#updateCourseModal').modal('hide');
        })
    },course_data);
})