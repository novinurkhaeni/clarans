<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
    <div class="col-lg-8">
    <form action="<?= base_url('admin/edittransaction'); ?>" method="post">

        <div class="form-group row">
            <div class="col-sm-7">
                <input type="text" class="form-control" id="transactionId" name="transactionId" value="<?= $transaction['transaction_id']; ?>" hidden>
            </div>
        </div>

        <div class="form-group row">
            <label for="product_id" class="col-sm-2 col-form-label">Product</label>
            <div class="col-sm-7">
                <select name="product_id" id="product_id" class="form-control">
                    <option value="<?= $transaction['product_id'];?>" selected><?= $transaction['product'];?></option>
                    <?php foreach ($product as $p) :?>
                    <option value="<?= $p['product_id']; ?>"><?= $p['product']; ?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="total" class="col-sm-2 col-form-label">Total</label>
            <div class="col-sm-7">
                <input type="number" class="form-control" id="total" name="total" value="<?= $transaction['total']; ?>" placeholder="Total Transaction" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="date" class="col-sm-2 col-form-label">Icon</label>
            <div class="col-sm-7">
                <input type="date" class="form-control" id="date" name="date" value="<?= $transaction['date_transaction']; ?>" placeholder="Date Transaction" required>
            </div>
        </div>

        <div class="form-group row justify-content-end">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>                
        </div>
    </form>
</div>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->