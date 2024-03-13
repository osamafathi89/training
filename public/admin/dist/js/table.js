
    $('.alert').hide(3000)

    function deleteRow(id){

           $.ajax({
                url:`/dash/courses/ajaxdelete/${id}`,
                type:'get',
                datatype:'json',
                success:(data)=>{
                   if(data=='"done"'){
                    $('.alert').show(1000)
                    $('.alert').slideUp(1000)
                    $('#tr_'+id).addClass('alert-danger');
                    $('#tr_'+id).slideUp(500);
                   }
                }
            })

    }

    
    function searchCourses(wordsearch){
        if(!wordsearch){
            wordsearch="all_courses"
        }
        $.ajax({
             url:`/dash/courses/ajaxsearch/${wordsearch}`,
             type:'get',
             datatype:'json',
             success:(data)=>{
                $("#tbl_show").html(data);
             }
         })

 }
