<div class="row">
    <div class="col-md-12">
        <h4 class="m-b-lg">
            Resim Ekle
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <form action="../api/dropzone" class="dropzone" data-plugin="dropzone" data-options="{ url: '../api/dropzone'}">
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
            Yüklü Resimler
        </h4>
    </div><!-- END column -->
    <div class="col-md-12">
        <div class="widget">
            <div class="widget-body">
                <table class="table table-hover">
                    <thead>
                        <th>#id</th>
                        <th>Görsel</th>
                        <th>Resim Adı</th>
                        <th>Durumu</th>
                        <th>İşlem</th>

                    </thead>
                    <tbody>
                        <tr>
                            <td>#1</td>
                            <td><img width="30" class="img-responsive" src="https://yt3.ggpht.com/ytc/AKedOLSj2FK7hgQqQZh3yP73icIUBHrElm1blSMpOsHV=s176-c-k-c0x00ffffff-no-rj" alt=""></td>
                            <td>deneme-urunu.jpeg</td>
                            <td>
                                <input
                                    data-url="<?php echo base_url("product/isActiveSetter") ?>" 
                                    type="checkbox"
                                    class="isActive"
                                    data-switchery=""
                                    data-color="#10c469"
                                    <?php echo (true) ? "checked":"";?>
                                >
                            </td>
                            <td>
                                <button 
                                    data-url="<?php echo base_url("product/delete/"); ?>" 
                                    class="btn btn-sm btn-danger btn-outline remove-btn">
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