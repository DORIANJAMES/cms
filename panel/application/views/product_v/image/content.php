<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
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
                <table class="table table-hover table-bordered">
                    <thead>
                        <th class="w100 text-center">#id</th>
                        <th class="w100 text-center">Görsel</th>
                        <th class="text-center">Resim Adı</th>
                        <th class="w100 text-center">Durumu</th>
                        <th class="w100 text-center">İşlem</th>

                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">#1</td>
                            <td class="text-center"><img width="30" class="img-responsive" src="https://yt3.ggpht.com/ytc/AKedOLSj2FK7hgQqQZh3yP73icIUBHrElm1blSMpOsHV=s176-c-k-c0x00ffffff-no-rj" alt=""></td>
                            <td class="text-center">deneme-urunu.jpeg</td>
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
                                    data-url="<?php echo base_url("product/delete/"); ?>" 
                                    class="btn btn-sm btn-danger btn-outline remove-btn btn-block">
                                    <i class="fa fa-trash"></i> Sil
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div><!-- .widget-body -->
        </div><!-- .widget -->
    </div><!-- END column -->
</div>