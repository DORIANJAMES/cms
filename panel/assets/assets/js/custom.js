$(document).ready(function () {


    // SORTABLE Classes Start Point.
    $(".sortable-aside").sortable();
    $(".sortable").sortable();
    // Block End.





    $(".remove-btn").click(function () {

        var $data_url = $(this).data("url");

        swal({
            title: 'Emin misiniz?',
            text: "Bu işlemi geri alamayacaksınız!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Evet, Sil!',
            cancelButtonText: "Hayır"
        }).then(function (result) {
            if (result.value) {

                window.location.href = $data_url;
            }
        });
    });

    $(".isActive").change(function () {

        var $data = $(this).prop("checked");
        var $data_url = $(this).data("url");

        if (typeof $data !== "undefined" && typeof $data_url !== "undefined") {
            $.post($data_url, { data: $data }, function (response) {
                swal({

                    text: 'Ürün güncellemesi tamamlanmıştır.',
                    type: 'success'
                });
            });
        }
    });

    $(".sortable").on("sortupdate", function () {
        var $data = $(this).sortable("serialize");
        var $data_url = $(this).data("url");

        

        $.post($data_url, {data: $data}, function (response) {
            swal({
                text: 'Sıralama ' + response + ' şeklinde değiştirildi',
                type: 'success'
            });
        });
    });

    $(".sortable-aside").on("sortupdate", function () {
        var $data = $(this).sortable("serialize");
        var $data_url = $(this).data("url");

        $.post($data_url, { data: $data }, function (response) {
            swal({
                text: 'Sıralama' + response + ' şeklinde değiştirildi',
                type: 'success'
            });
        });
    });

    $(".hovercolor").mouseover(function(){
        $(this).css("color","grey");
    }).mouseout(function(){
        $(this).css("color","")
    });

    var uploadSection = Dropzone.forElement("#id_dropzone");

    uploadSection.on("complete", function(){
       alert();
    });

});