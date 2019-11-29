<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <form action="<?= base_url('admin/editrole'); ?>" method="post">
        <div class="modal-body">
            <div class="form-group">
                <input type="text" class="form-control" id="roleId" name="roleId" value="<?= $role['role_id']; ?>" hidden>
                <input type="text" class="form-control" id="role" name="role" value="<?= $role['role']; ?>" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
