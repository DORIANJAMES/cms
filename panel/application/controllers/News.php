<?php

class News extends CI_Controller
{
    public $viewFolder = "";

    public function __construct()
    {
        parent::__construct();

        $this->viewFolder = "news_v";
        $this->load->model("news_model");
        $this->load->model("news_image_model");
    }

    public function index()
    {
        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $items = $this->news_model->get_all(
            array(),"rank ASC"
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "list";
        $viewData->items = $items;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function new_form()
    {
        $viewData = new stdClass();
        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function save()
    {
        $this->load->library("form_validation");
        $news_type = $this->input->post("news_type");

        if ($news_type == "image"){

            // Resim seçilmediğinde çalışacak olan kodların başlangıcı.
            if ($_FILES["img_url"]["name"] == ""){
                print_r($_FILES['img_url']);
                $alert = array(
                    "title"=>"Opps...!",
                    "text"=>"Devam edebilmek için bir resim seçmelisiniz.",
                    "type"=>"error"
                );
                $this->session->set_flashdata("alert", $alert);
                redirect(base_url("news/new_form"));
            }
            // Resim seçilmediğinde çalışacak olan kodların bitişi.


        } elseif ($news_type == "video"){
            $this->form_validation->set_rules("video_url", "Video URL", "required|trim");
            $this->form_validation->set_message(
                array(
                    "required"  => "<b>{field}</b> alanı doldurulmalıdır."
                )
            );
            $video_url = $this->input->post("video_url");
            if (empty($video_url)) {
                $alert = array(
                    "title"=>"Opps...!",
                    "text"=>"Devam edebilmek için bir video seçmelisiniz.",
                    "type"=>"error"
                );
                $this->session->set_flashdata("alert", $alert);
            }
        }

        // Kurallar yazilir..
        $this->form_validation->set_rules("title", "Başlık", "required|trim");

        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır."
            )
        );

        // Form Validation Çalıştırılır..
        $validate = $this->form_validation->run();


        if ($validate) {


            if ($news_type == "image") {

                // Haber türü resim ise aşağıdaki kodlar çalışır.
                $file_name = pathinfo($_FILES["img_url"]["name"], PATHINFO_FILENAME).".".pathinfo($_FILES["img_url"]["name"], PATHINFO_EXTENSION);
                $config["allowed_types"] = "png|jpeg|jpg|gif";
                $config["upload_path"] = "uploads/$this->viewFolder/";
                $config["file_name"] = $file_name;

                $this->load->library("upload", $config);

                $upload = $this->upload->do_upload("img_url");
                if ($upload) $img_url = $this->upload->data("file_name");

                $insert = $this->news_model->add(
                    array(
                        "title"         => $this->input->post("title"),
                        "description"   => $this->input->post("description"),
                        "url"           => convertToSEO($this->input->post("title")),
                        "rank"          => $this->input->post("rank"),
                        "news_type"     => $this->input->post("news_type"),
                        "img_url"       => convertToSEO($img_url),
                        "isActive"      => $this->input->post("isActive"),
                        "createdAt"     => date("Y-m-d H:i:s")
                    )
                );
            } elseif ($news_type == "video") {

                // Haber türü videolu haber ise aşağıdaki kodlar çalışır.
                $video_post = $this->input->post("video_url");
                $video_url = explode("?", $video_post);


                // Video YouTube'dan gelen bir video ise aşağıdaki kodlar çalışır.
                if ($video_url[0] == "https://www.youtube.com/watch") {
                    $isYouTube = 1;
                    $insert = $this->news_model->add(
                        array(
                            "title" => $this->input->post("title"),
                            "description"   => $this->input->post("description"),
                            "url"           => convertToSEO($this->input->post("title")),
                            "rank"          => $this->input->post("rank"),
                            "news_type"     => $this->input->post("news_type"),
                            "video_url"     => $video_url[1],
                            "isYouTube"     => $isYouTube,
                            "isActive"      => $this->input->post("isActive"),
                            "createdAt"     => date("Y-m-d H:i:s")
                        )
                    );
                } else {
                    // Video YouTube'dan gelen bir video değil ise aşağıdaki kodlar çalışır.
                    $isYouTube = 0;
                    $insert = $this->news_model->add(
                        array(
                            "title"         => $this->input->post("title"),
                            "description"   => $this->input->post("description"),
                            "url"           => convertToSEO($this->input->post("title")),
                            "rank"          => $this->input->post("rank"),
                            "news_type"     => $this->input->post("news_type"),
                            "video_url"     => $video_post,
                            "isYouTube"     => $isYouTube,
                            "isActive"      => $this->input->post("isActive"),
                            "createdAt"     => date("Y-m-d H:i:s")
                        )
                    );
                }
            }

            // TODO Alert sistemi eklendi...
            if ($insert) {
                $alert = array(
                    "title" => "Tebrikler",
                    "text" => "Ekleme işlemi başarılı bir şekilde gerçekleştirilmiştir.",
                    "type" => "success"
                );

            } else {
                $alert = array(
                    "title" => "Opps!",
                    "text" => "Ekleme işlemi ne yazık ki tamamlanamadı. Yeniden deneyiniz ya da sistem yöneticinize başvurunuz!",
                    "type" => "error"
                );
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("news"));
        } else {

            $viewData = new stdClass();

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "add";
            $viewData->form_error = true;
            $viewData->news_type = $news_type;

            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
        // Başarılı ise
        // Kayit işlemi baslar
        // Başarısız ise
        // Hata ekranda gösterilir...
    }

    public function update_form($id)
    {

        $viewData = new stdClass();

        /** Tablodan Verilerin Getirilmesi.. */
        $item = $this->news_model->get(
            array(
                "id"    => $id,
            )
        );

        /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update($id)
    {
        $this->load->library("form_validation");

        // Kurallar yazilir..
        $this->form_validation->set_rules("title", "Başlık", "required|trim");

        $this->form_validation->set_message(
            array(
                "required"  => "<b>{field}</b> alanı doldurulmalıdır"
            )
        );

        // Form Validation Calistirilir..
        // TRUE - FALSE
        $validate = $this->form_validation->run();

        // Monitör Askısı
        // monitor-askisi

        if ($validate) {

            $update = $this->news_model->update(
                array(
                    "id"    => $id
                ),
                array(
                    "title"         => $this->input->post("title"),
                    "description"   => $this->input->post("description"),
                    "url"           => convertToSEO($this->input->post("title")),
                )
            );

            // TODO Alert sistemi eklenecek...
            if ($update) {
                $alert = array(
                    "title" => "Tebrikler!",
                    "text" => "Düzenleme işlemi başarılı bir şekilde gerçekleştirilmiştir.",
                    "type" => "success"
                );

            } else {
                $alert = array(
                    "title" => "Oppss!",
                    "text" => "Düzenleme işlemi ne yazık ki tamamlanamadı. Yeniden deneyiniz ya da sistem yöneticinize başvurunuz!",
                    "type" => "error"
                );
            }
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("news"));
        } else {

            $viewData = new stdClass();

            /** Tablodan Verilerin Getirilmesi.. */
            $item = $this->news_model->get(
                array(
                    "id"    => $id,
                )
            );

            /** View'e gönderilecek Değişkenlerin Set Edilmesi.. */
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $item;


            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }

        // Başarılı ise
        // Kayit işlemi baslar
        // Başarısız ise
        // Hata ekranda gösterilir...

    }

    public function delete($id)
    {
        $delete = $this->news_model->delete(
            array(
                "id"    => $id
            )
        );

        // TODO Alert Sistemi Eklenecek...
        if ($delete) {
            $alert = array(
                "title" => "Tebrikler",
                "text" => "Silme işlemi başarılı bir şekilde gerçekleştirilmiştir.",
                "type" => "success"
            );

        } else {
            $alert = array(
                "title" => "Oppss!",
                "text" => "Silme işlemi ne yazık ki tamamlanamadı. Yeniden deneyiniz ya da sistem yöneticinize başvurunuz!",
                "type" => "error"
            );
        }
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("news"));
    }

    public function imageDelete($id, $parent_id)
    {
        $fileName = fileName($this->news_image_model, $id);

        // Helper olmadan resim url'sini çeken kodlar.
        //$fileName = $this->news_image_model->get(
        //  array(
        //      "id" => $id
        //  )
        //);

        $delete = $this->news_image_model->delete(
            array(
                "id"    => $id
            )
        );

        // TODO Alert Sistemi Eklenecek...
        if ($delete) {
            unlink("uploads/{$this->viewFolder}/$fileName");
            $alert = array(
              "title" => "Tebrikler!",
              "text" => "Resim, başarı ile sistemden silinmiştir.",
              "type" => "success"
            );
        } else {
            $alert = array(
                "title" => "Tebrikler!",
                "text" => "Resim, başarı ile sistemden silinmiştir.",
                "type" => "success"
            );
        }
        $this->session->sub_flashdata("alert", $alert);
        redirect(base_url("news/image_form/".$parent_id));
    }

    public function isActiveSetter($id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true" ? '1' : '0');
            $this->news_model->update(

                array(
                    "id" => $id
                ),
                array(
                    "isActive" => $isActive
                )
            );
        }
    }

    public function imageIsActiveSetter($id, $parent_id)
    {
        if ($id) {
            $isActive = ($this->input->post("data") === "true" ? '1' : '0');
            $this->news_image_model->update(

                array(
                    "id" => $id
                ),
                array(
                    "isActive" => $isActive
                )
            );

            $viewData = new stdClass();

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "image";

            $viewData->item_images = $this->news_image_model->get_all(
                array(
                    "news_id" => $parent_id
                ),"rank ASC"
            );

            $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);
            echo $render_html;
        }
    }

    public function isCoverSetter($id, $parent_id) {
        if ($id && $parent_id){

            $isCover = ($this->input->post("data") === "true") ? 1 : 0;

            // KApak yapılmak istenen ürün resmi için gerekli işlemler
            $this->news_image_model->update(
                array(
                    "id" => $id,
                    "news_id" => $parent_id
                ),
                array(
                    "isCover" => $isCover
                )
            );

            // Kapak yapılan ürün resmi haricinde kalan tüm resimlerin isCover sütununu "0"'a çevirmek için yapılan işlemler.
            $this->news_image_model->update(
                array(
                    "id !=" =>$id,
                    "news_id" => $parent_id
                ),
                array(
                    "isCover" => 0
                )
            );


            $viewData = new stdClass();

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "image";

            $viewData->item_images = $this->news_image_model->get_all(
                array(
                    "news_id" => $parent_id
                ), "rank ASC"
            );

            $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);
            echo $render_html;
        }
    }

    public function rankSetter()
    {
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order["ord"];

        foreach ($items as $rank => $id) {
            $isOk = $this->news_model->update(
                array(
                    "id"        => $id,
                    "rank !="   => $rank
                ),
                array(
                    "rank"      => $rank
                )
            );
            if ($isOk) {
                echo $id;
            } else {
                echo "İşleminizde hata oluştu.";
            }
        }
    }

    public function imageRankSetter()
    {
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order["ord"];

        foreach ($items as $rank => $id) {
            $isOk = $this->news_image_model->update(
                array(
                    "id"        => $id,
                    "rank !="   => $rank
                ),
                array(
                    "rank"      => $rank
                )
            );
            if ($isOk) {
                echo $id;
            } else {
                echo "İşleminizde hata oluştu.";
            }
        }
    }

    public function image_form($id) 
    {
        $viewData = new stdClass();

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $viewData->item = $this->news_model->get(
            array(
                "id" => $id
            )
        );

        $viewData->item_images = $this->news_image_model->get_all(
            array(
                "news_id" => $id
            ), "rank ASC"
        );

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);

    }

    public function image_upload($id)
    {
        $file_name = convertToSEO(pathinfo($_FILES["file"]["name"],PATHINFO_FILENAME)) . "." .pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $config["allowed_types"] = "png|jpeg|jpg|gif";
        $config["upload_path"] = "uploads/$this->viewFolder/";
        $config["file_name"] = $file_name;


        $this->load->library("upload", $config);

        $upload = $this->upload->do_upload("file");

        if ($upload) { 
            $uploaded_file = $this->upload->data("file_name");
            $this->news_image_model->add(
                array(
                    "img_url" => $uploaded_file,
                    "rank" => 0,
                    "isActive" => 1,
                    "isCover" => 0,
                    "createdAt" => date("Y-m-d H:i:s"),
                    "news_id" => $id
                )
            );

        } else {
            echo "Hata! Başarısız oldu.";
        }

    }

    public function refresh_image_list($id) {
        $viewData = new stdClass();

        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $viewData->item_images = $this->news_image_model->get_all(
            array(
                "news_id" => $id
            )
        );

        $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData);

    }
}