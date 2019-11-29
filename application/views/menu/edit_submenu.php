<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
    <div class="col-lg-8">
    <form action="<?= base_url('menu/editsubmenu'); ?>" method="post">

        <div class="form-group row">
            <label for="submenuId" class="col-sm-2 col-form-label">Submenu_id</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="submenuId" name="submenuId" value="<?= $submenu['submenu_id']; ?>" hidden>
            </div>
        </div>

        <div class="form-group row">
            <label for="submenuId" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-7">
            <input type="text" class="form-control" id="title" name="title" value="<?= $submenu['title']; ?>" placeholder="Submenu title" required>
        </div>
        </div>

        <div class="form-group row">
            <label for="submenuId" class="col-sm-2 col-form-label">Menu</label>
            <div class="col-sm-7">
                <select name="menu_id" id="menu_id" class="form-control">
                    <option value="<?= $submenu['menu_id'];?>" selected><?= $submenu['menu']?></option>
                    <?php foreach ($menu as $m) :?>
                        <option value="<?= $m['menu_id']; ?>"><?= $m['menu']; ?></option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="submenuId" class="col-sm-2 col-form-label">URL</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="url" name="url" value="<?= $submenu['url']; ?>" placeholder="Submenu url" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="submenuId" class="col-sm-2 col-form-label">Icon</label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="icon" name="icon" value="<?= $submenu['icon']; ?>" placeholder="Submenu icon" required>
            </div>
        </div>

        <div class="form-group">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" value="1" name="is_active" id="is_active" checked>
                <label class="form-check-label" for="is_active">
                    Active?
                </label>
            </div>
        </div>

        <div class="form-group row justify-content-end">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>                
        </div>
    </form>
</div>
</div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->