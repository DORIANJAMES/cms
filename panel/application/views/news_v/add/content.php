<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Yeni Haber Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("news/save"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input class="form-control" placeholder="Başlık" name="title">
                        <?php if (isset($form_error)) { ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("title"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Açıklama</label>
                        <textarea name="description" class="m-0" data-plugin="summernote" data-options="{height: 250}"></textarea>
                        <?php if (isset($form_error)) { ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("description"); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group">
                        <label>Sıra</label>
                        <input class="form-control" placeholder="Başlık" name="rank">
                        <?php if (isset($form_error)) { ?>
                            <small class="pull-right input-form-error"> <?php echo form_error("rank"); ?></small>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="control-demo-5" class="">Haberin Türü</label>
                        <div id="control-demo-5" class="">
                            <select class="form-control news_type_select" name="news_type">
                                <option value="image" <?php echo (isset($form_error) && $news_type =="image") ?"selected":""; ?> >Resim</option>
                                <option value="video" <?php echo (isset($form_error) && $news_type =="video") ?"selected":""; ?> >Video</option>
                            </select>
                        </div>
                    </div>

                    <?php if (isset($form_error)) { ?>
                        <div class="form-group image_upload_container" style="display: <?php echo ($news_type) == "image"?"block":"none"; ?> ">
                            <label>Görsel Seçiniz</label>
                            <input type="file" class="form-control" name="img_url">
                        </div>

                        <div class="form-group video_url_container" style="display: <?php echo ($news_type) == "video"?"block":"none"; ?> ">
                            <label>Video URL</label>
                            <input class="form-control" placeholder="Video bağlantısını bu alandan ekleyebilirsiniz" name="video_url">
                            <?php if (isset($form_error)) { ?>
                                <small class="pull-right input-form-error"> <?php echo form_error("video_url"); ?></small>
                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <div class="form-group image_upload_container">
                            <label>Görsel Seçiniz</label>
                            <input type="file" class="form-control" name="img_url">
                        </div>

                        <div class="form-group video_url_container">
                            <label>Video URL</label>
                            <input class="form-control" placeholder="Video bağlantısını bu alandan ekleyebilirsiniz" name="video_url">
                        </div>
                    <?php } ?>

                    <div class="form-group">
                        <label class="">Durum</label>
                        <div class="">
                        <select class="form-control" name="isActive" id="">
                            <option value="1">Aktif</option>
                            <option value="0">Pasif</option>
                        </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary btn-md btn-outline btn-sm">Kaydet</button>
                    <a href="<?php echo base_url("news"); ?>" class="btn btn-md btn-danger btn-outline btn-sm">İptal</a>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>