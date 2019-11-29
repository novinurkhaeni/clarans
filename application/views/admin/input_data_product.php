<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-1 text-gray-800"><?= $title; ?></h1>
    <?php if (validation_errors()) :?>
    <div class="alert alert-danger d-inline-block" role="alert">
        <?= validation_errors(); ?>
    </div>
    <?php endif;?>
    <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
    <?= $this->session->flashdata('message'); ?>
    <br>

    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newProductuModal">Add New Product</a>

    <div class="row">
        <div class="col-sm-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Product List</h5>
                    <table class="table table-hover">
                        <thead>
                            <th scope="col">No</th>
                            <th scope="col">Product</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data->result() as $row) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $row->product; ?></td>
                                    <td><img src="<?= base_url('assets/img/product/') . $row->image?>" class="img-thumbnail col-sm-7"></td>
                                    <td>
                                        <a class="badge badge-success" href="<?= base_url('admin/selectproduct/') . $row->product_id; ?>">Edit</a>
                                        <a class="badge badge-danger" href="<?= base_url('admin/deleteproduct/') . $row->product_id; ?>">Delete</a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <br/>
                    <!--Tampilkan pagination-->
                    <?php echo $pagination; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal product -->
<div class="modal fade" id="newProductuModal" tabindex="-1" role="dialog" aria-labelledby="newProductuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newProductuModalLabel">Add New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?= form_open_multipart('admin/inputdata'); ?>
                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" class="form-control" id="product" name="product" placeholder="Product name">
                    </div>

                    <div class="form-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label for="image" class="custom-file-label">Choose file</label>
                            </div>
                    </div>
   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>