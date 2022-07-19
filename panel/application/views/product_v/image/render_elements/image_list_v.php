<?php
    if (empty($item_images)) { ?>
        <div class="alert alert-info text-center">
            <p>Bu ürün altında herhangi bir resim bulunmamaktadır. Yukarıdaki yükleme alanından resim ekleyebilirsiniz...</p>
        </div>
    <?php } else { ?>

        <table class="table table-hover table-striped">
            <thead>
                <th class="reorder"><i class="fa fa-reorder"></i></th>
                <th class="w30 text-center">#id</th>
                <th class="w100 text-center">Görsel</th>
                <th class="text-center">Resim Adı</th>
                <th class="w100 text-center">Durumu</th>
                <th class="w100 text-center">Kapak</th>
                <th class="w100 text-center">İşlem</th>
            </thead>

            <tbody class="sortable" data-url="<?php echo base_url("product/imageRankSetter"); ?> " >

            <?php foreach ($item_images as $image) { ?>

                <tr id="ord-<?php echo $image->id; ?> ">
                    <td class="reorder"><i class="fa fa-reorder"></i></td>
                    <td class="text-center">#<?php echo $image->id ?> </td>
                    <td class="text-center"><img class="img-responsive img-circle w30" src="<?php echo base_url("uploads/{$viewFolder}/".$image->img_url) ?> " alt="<?php echo $image->img_url; ?> "></td>
                    <td class="text-center"><?php echo $image->img_url ?> </td>
                    <td class="text-center">
                        <input
                                data-url="<?php echo base_url("product/imageIsActiveSetter/$image->id/$image->product_id") ?>"
                                type="checkbox"
                                class="imageIsActive"
                                data-switchery=""
                                data-color="#10c469"
                            <?php echo ($image->isActive) ? "checked":"";?>
                        >
                    </td>
                    <td class="text-center">
                        <input
                                data-url="<?php echo base_url("product/isCoverSetter/$image->id/$image->product_id") ?>"
                                type="checkbox"
                                class="isCover"
                                data-switchery=""
                                data-color="#f9c851 "
                            <?php echo ($image->isCover) ? "checked":"";?>
                        >
                    </td>
                    <td class="text-center">
                        <button
                                data-url="<?php echo base_url("product/imageDelete/$image->id/$image->product_id"); ?>"
                                class="btn btn-sm btn-danger btn-outline remove-btn btn-block">
                            <i class="fa fa-trash"></i> Sil
                        </button>
                    </td>
                </tr>
            <?php } ?>





            </tbody>
        </table>

    <?php } ?>
