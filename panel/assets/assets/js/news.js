$(document).ready(function (){

    $(".news_type_select").change(function (){
       var selected = $(this).val();

       if (selected == "image") {
           $(".image_upload_container").attr("type", "hidden");
       }
    });

});
