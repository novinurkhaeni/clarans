<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h3 class="h3 mb-4 text-gray-800">
        <?= $title; ?>
    </h3>
    <form action="<?= base_url('admin/clusteraccess'); ?>" method="post">
        <h5 class="text-gray-800">Select the class to make as best seller product!</h5>
        <div class="form-group">
            <input type="radio" name="cluster" value="1"> Cluster1<br>
            <input type="radio" name="cluster" value="2"> Cluster2<br>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

    
    <div class="row">
    <!-- Area Best Seller -->
        <div class="col-xl-6 col-lg-7">
            <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Best Seller Product</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <?php if($class1 != null) :?>
                <table class="table table-hover col-8">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Product</th>
                            <th scope="col">Image</th>
                            <th scope="col">Total</th>
                            <th scope="col">Modus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($class1 as $c1) : ?>
                        <tr>
                            <th scope="row">
                                <?= $i; ?>
                            </th>
                            <td>
                                <?= $c1['product'] ?>
                            </td>
                            <td><img src="<?= base_url('assets/img/product/') . $c1['image']?>" class="img-thumbnail"></td>
                            <td>
                                <?= $c1['total'] ?>
                            </td>
                            <td>
                                <?= $c1['modus'] ?>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>

                <?php if($class2 != null) :?>
                <table class="table table-hover col-8">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Product</th>
                            <th scope="col">Image</th>
                            <th scope="col">Total</th>
                            <th scope="col">Modus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($class2 as $c2) : ?>
                        <tr>
                            <th scope="row">
                                <?= $i; ?>
                            </th>
                            <td>
                                <?= $c2['product'] ?>
                            </td>
                            <td><img src="<?= base_url('assets/img/product/') . $c2['image']?>" class="img-thumbnail"></td>
                            <td>
                                <?= $c2['total'] ?>
                            </td>
                            <td>
                                <?= $c2['modus'] ?>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>          
            </div>
        </div>
    </div>

    <!-- Area discount -->
    <div class="col-xl-6 col-lg-7">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Product Discount</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <?php if($promo1 != null) :?>
                <table class="table table-hover col-8">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Product</th>
                            <th scope="col">Image</th>
                            <th scope="col">Total</th>
                            <th scope="col">Modus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($promo1 as $p1) : ?>
                        <tr>
                            <th scope="row">
                                <?= $i; ?>
                            </th>
                            <td>
                                <?= $p1['product'] ?>
                            </td>
                            <td><img src="<?= base_url('assets/img/product/') . $p1['image']?>" class="img-thumbnail"></td>
                            <td>
                                <?= $p1['total'] ?>
                            </td>
                            <td>
                                <?= $p1['modus'] ?>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>

                <?php if($promo2 != null) :?>
                <table class="table table-hover col-8">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Product</th>
                            <th scope="col">Image</th>
                            <th scope="col">Total</th>
                            <th scope="col">Modus</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($promo2 as $p2) : ?>
                        <tr>
                            <th scope="row">
                                <?= $i; ?>
                            </th>
                            <td>
                                <?= $p2['product'] ?>
                            </td>
                            <td><img src="<?= base_url('assets/img/product/') . $p2['image']?>" class="img-thumbnail"></td>
                            <td>
                                <?= $p2['total'] ?>
                            </td>
                            <td>
                                <?= $p2['modus'] ?>
                            </td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endif; ?>  
            </div>
        </div>
    </div>
    
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->