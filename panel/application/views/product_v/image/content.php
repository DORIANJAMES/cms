<div class="row">r
    <div class="col-md-12">
        <h4 class="m-b-lg">
            <a href="<?php echo base_url("product"); ?>" class="btn btn-outline btn-primary btn-xs pull-right"> <i class="fa fa-angle-left"></i> Geri</a>
            Resim Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="<?php echo base_url("product/image_upload/".$item->id); ?>" id="id_dropzone" enctype="multipart/form-data" data-parsley-validate class="dropzone" data-plugin="dropzone" data-options="{ url: '<?php echo base_url("product/image_upload/".$item->id); ?>'}">
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
            <div class="widget-body">
                <?php
                if (empty($item_images)) { ?>
                    <div class="alert alert-info text-center">
                        <p>Bu ürün altında herhangi bir resim bulunmamaktadır. Yukarıdaki yükleme alanından resim ekleyebilirsiniz...</p>
                    </div>
                <?php } else { ?>

                    <table class="table table-hover table-bordered">
                        <thead>
                        <th class="w100 text-center">#id</th>
                        <th class="w100 text-center">Görsel</th>
                        <th class="text-center">Resim Adı</th>
                        <th class="w100 text-center">Durumu</th>
                        <th class="w100 text-center">İşlem</th>

                        </thead>
                        <tbody>

                        <?php foreach ($item_images as $image) { ?>
                            <tr>
                                <td class="text-center">#<?php echo $image->id ?> </td>
                                <td class="text-center"><img class="img-responsive img-circle w30" src="<?php echo base_url("uploads/{$viewFolder}/".$image->img_url) ?> " alt="<?php echo $image->img_url; ?> "></td>
                                <td class="text-center"><?php echo $image->img_url ?> </td>
                                <td class="text-center">
                                    <input
                                            data-url="<?php echo base_url("product/isActiveSetter") ?>"
                                            type="checkbox"
                                            class="isActive"
                                            data-switchery=""
                                            data-color="#10c469"
                                        <?php echo (true) ? "checked":"";?>
                                    >
                                </td>
                                <td class="text-center">
                                    <button
                                            data-url="<?php echo base_url("product_image/delete/$image->id"); ?>"
                                            class="btn btn-sm btn-danger btn-outline remove-btn btn-block">
                                        <i class="fa fa-trash"></i> Sil
                                    </button>
                                </td>
                            </tr>
                        <?php } ?>





                        </tbody>
                    </table>

                <?php } ?>

            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>