$('#cat_id').on('change',function(){
    let id = $('#cat_id').val();
    let route=$('#cat_id').attr('route');

   
   if(id>0){
    $.ajax({
        url:`${route}/${id}`,
        method:'get',
        type:'json',
        success:function(data){
           $("#sub_cat").slideDown(300);
           $("#sub_cat_id").html(data);
        }
    })
   }else{
    $("#sub_cat").slideUp(300);
   }
})

let counter = 0;
let permission = Notification.permission;
if (permission === "granted") {
    showNotification();
} else if (permission === "default") {
    requestAndShowPermission();
} else {
    alert("Use normal alert");
}
function notClose(){
document.getElementById('con').style.display = "none";
}
function showNotification() {
    if (document.visibilityState === "visible") {
        var id = 5;
        var title = "JavaScript Jeep";
        //  icon = "image-url"
        var body = "Message to be displayed";
        var notification = new Notification('Title', {
            body
        });

        document.getElementById('not-content').innerHTML = "Osama";

        if (counter < id) {
            document.getElementById('con').style.display = "block";
        } else {
            document.getElementById('con').style.display = "none";
        }
        setTimeout(() => {
            counter = id;
            console.log(counter);
        }, 5000);

    }
    var title = "JavaScript Jeep";
    //  icon = "image-url"
    var body = "Message to be displayed";
    var notification = new Notification('Title', {
        body
    });


    notification.onclick = () => {
        notification.close();
        window.parent.focus();
    }
}

function requestAndShowPermission() {
    Notification.requestPermission(function(permission) {
        if (permission === "granted") {
            showNotification();
        }
    });
}
