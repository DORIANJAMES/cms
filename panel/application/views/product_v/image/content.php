<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <a href="<?php echo base_url("product"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-angle-left"></i> Geri</a>
            Resim Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form data-url="<?php echo base_url("product/refresh_image_list/".$item->id); ?>" action="<?php echo base_url("product/image_upload/".$item->id); ?>" id="dropzone" enctype="multipart/form-data" data-parsley-validate class="dropzone" data-plugin="dropzone" data-options="{ url: '<?php echo base_url("product/image_upload/".$item->id); ?>'}">
                    <div class="dz-message">
                        <h3 class="m-h-lg">Dosyalarınız bu alana sürükleyip bırakınız ya da tıklayarak seçim yapabilirsiniz.</h3>
                        <p class="m-b-lg text-muted">Bu alana bırakacağınız dosya türleri .png, .jpg, .jpeg, .tiff ya da .webp uzantılarından birisine sahip olmalıdır.</p>
                    </div>
                </form>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>

<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <b><?php echo $item->title ?></b> için Yüklü Resimler
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body image_list_container">
                
                <?php $this->load->view("{$viewFolder}/{$subViewFolder}/render_elements/image_list_v") ?>

            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>