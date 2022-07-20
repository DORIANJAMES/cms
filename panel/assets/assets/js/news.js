$(document).ready(function (){

    $(".news_type_select").change(function (){
       var selected = $(this).val();

       if (selected == "image") {
           $(".image_upload_container").fadeIn();
           $(".video_url_container").css("display", "none");
       } else if (selected == "video"){
           $(".video_url_container").fadeIn();
           $(".image_upload_container").css("display", "none");
       }
    });
});
