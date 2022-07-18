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
                $('.image_list_container').html(response);

                swal({

                    text: 'Ürün güncellemesi tamamlanmıştır.',
                    type: 'success'
                });
            });
        }
    });

    $(".image_list_container").on('change', '.imageIsActive', function () {

        var $data = $(this).prop("checked");
        var $data_url = $(this).data("url");

        if (typeof $data !== "undefined" && typeof $data_url !== "undefined") {
            $.post($data_url, { data: $data }, function (response) {
                $(".image_list_container").html(response);

                // Switchery yüklemesi yapılıyor.
                $('[data-switchery]').each(function (){
                    var $this = $(this),
                        color = $this.attr('data-color') || '#188ae2',
                        jackColor = $this.attr('data-jackColor') || '#ffffff',
                        size = $this .attr('data-size') || 'default'

                    new Switchery(this, {
                        color: color,
                        size: size,
                        jackColor: jackColor
                    });
                });

                $(".sortable-aside").sortable();
                $(".sortable").sortable();

            });
        }
    });

    $(".image_list_container").on('change', '.isCover', function(){
       var $data  = $(this).prop("checked");
       var $data_url = $(this).data("url");

       if (typeof $data !== "undefined" && typeof $data_url !== "undefined") {
           $.post($data_url, {data: $data}, function (response){
               $(".image_list_container").html(response);

               // Switchery yüklemesi yapılıyor.
               $('[data-switchery]').each(function (){
                   var $this = $(this),
                       color = $this.attr('data-color') || '#188ae2',
                       jackColor = $this.attr('data-jackColor') || '#ffffff',
                       size = $this .attr('data-size') || 'default'

                   new Switchery(this, {
                       color: color,
                       size: size,
                       jackColor: jackColor
                   });
               });

               $(".sortable-aside").sortable();
               $(".sortable").sortable();

               swal({
                  text: 'Kapak fotoğrafı güncellenmiştir...',
                  type: 'success'
              });
           });
       }
    });

    $(".image_list_container, .content-container").on("sortupdate",'.sortable', function () {
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


    // Dropzone üzerinde resim yükleme işlemi tamamladığında çalışacak olan kodların başlangıcı.
    var uploadSection = Dropzone.forElement("#dropzone");

    uploadSection.on("complete", function(){

        var $data_url = $("#dropzone").attr("data-url");

        $.post($data_url, {}, function($response){
            $(".image_list_container").html($response);

            // Switchery yüklemesi yapılıyor.
            $('[data-switchery]').each(function (){
                var $this = $(this),
                    color = $this.attr('data-color') || '#188ae2',
                    jackColor = $this.attr('data-jackColor') || '#ffffff',
                    size = $this .attr('data-size') || 'default'

                new Switchery(this, {
                    color: color,
                    size: size,
                    jackColor: jackColor
                });
            });
        });
    });
    // Dropzone üzerinde resim yükleme işlemi tamamladığında çalışacak olan kodların bitişi.

});