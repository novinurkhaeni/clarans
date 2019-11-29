<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
                <form action="<?= base_url('menu/editmenu'); ?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="menuId" name="menuId" value="<?= $menu['menu_id']; ?>" hidden>
                            <input type="text" class="form-control" id="menu" name="menu" value="<?= $menu['menu']; ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                </form>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->