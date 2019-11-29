<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h3 class="h3 mb-2 text-gray-800">
        <?= $title; ?>
    </h3>
    <a class="btn btn-primary mb-2" href="<?= base_url('user/best/');?>">Best Seller Product</a>
    <a class="btn btn-primary mb-2" href="<?= base_url('user/promo/');?>">Discount</a>
    <h5 class="card-title">All Product</h5>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Product</th>
                <th scope="col">Image</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>
            <?php foreach ($product->result() as $row) : ?>
            <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $row->product; ?></td>
                <td><img src="<?= base_url('assets/img/product/') . $row->image;?>" class="img-thumbnail col-sm-2"></td>
            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br/>
    <!--Tampilkan pagination-->
    <?php echo $pagination; ?>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->