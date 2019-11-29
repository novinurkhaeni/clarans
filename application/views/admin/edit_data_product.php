<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">
        <?= $title; ?>
    </h1>
    <div class="row">
        <div class="col-lg-8">
            <?= form_open_multipart('admin/editproduct'); ?>
                <div class="form-group row">
                    <!-- <label for="product" class="col-sm-3 col-form-label">Product ID</label> -->
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="productId" name="productId" value="<?= $product['product_id']; ?>" hidden>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="product" class="col-sm-3 col-form-label">Product Name</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="product" name="product" value="<?= $product['product']; ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-3">Picture</div>
                    <div class="col-sm-9">
                        <div class="row">
                            <div class="col-sm-4">
                                <img src="<?= base_url('assets/img/product/') . $product['image']?>" class="img-thumbnail">
                            </div>
                            <div class="col-sm-8">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="image" name="image">
                                    <label for="image" class="custom-file-label">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-9">
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