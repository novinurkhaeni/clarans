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
    
    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newTransactionModal">Add New Transactions</a>

    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">List of Sales Transactions</h5>
                    <table class="table table-hover">
                        <thead>
                            <th scope="col">No</th>
                            <th scope="col">Product</th>
                            <th scope="col">Total</th>
                            <th scope="col">Date Transactions</th>
                            <th scope="col">Action</th>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data->result() as $row) : ?>
                                <tr>
                                    <th scope="row"><?= $i; ?></th>
                                    <td><?= $row->product; ?></td>
                                    <td><?= $row->total; ?></td>
                                    <td><?= $row->date_transaction; ?></td>
                                    <td>
                                        <a class="badge badge-success" href="<?= base_url('admin/selecttransaction/') . $row->transaction_id; ?>">Edit</a>
                                        <a class="badge badge-danger" href="<?= base_url('admin/deletetransaction/') . $row->transaction_id; ?>">Delete</a>
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

<!-- Modal transaction-->
<div class="modal fade" id="newTransactionModal" tabindex="-1" role="dialog" aria-labelledby="newTransactionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newTransactionModalLabel">Add New Transaction</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/inputtransaction'); ?>" method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <select name="product_id" id="product_id" class="form-control">
                            <option value="">Select Product</option>
                            <?php foreach ($product as $p) :?>
                            <option value="<?= $p['product_id']; ?>"><?= $p['product']; ?></option>
                            <?php endforeach;?>
                        </select>
                    </div>

                    <div class="form-group">
                        <input type="number" class="form-control" id="total" name="total" placeholder="Total transaction">
                    </div>

                    <div class="form-group">
                        <input type="date" class="form-control" id="date" name="date" placeholder="Date transaction">
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

