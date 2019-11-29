<!-- Begin Page Content -->
<div class="container-fluid">

  <h3 class="h3 mb-2 text-gray-800"><?= $title; ?></h3>

  <?php if (validation_errors()) :?>
  <div class="alert alert-danger d-inline-block" role="alert">
      <?= validation_errors(); ?>
  </div>
  <?php endif;?>
  <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>') ?>
  <?= $this->session->flashdata('message'); ?>
  <br>

  <div class="row">
    <div class="col-sm-8">
      <form action="<?= base_url('admin/clarans'); ?>" method="post">
        <div class="form-group row">
          <div class="col-sm-7">
            <select name="year_transaction" id="year_transaction" class="form-control">
              <option value="">Select Year</option>
              <?php foreach ($year as $y) :?>
                <option value="<?php echo $y['date']; ?>"><?php echo $y['date']; ?></option>
              <?php endforeach;?>
            </select>
          </div>
          <div class="col-sm-5">
            <button type="submit" class="btn btn-primary mb-2">Cluster</button>
            <a class="btn btn-warning mb-2" href="<?= base_url('admin/displayaccess/');?>">Display</a>
          </div>
        </div>
      </form>
    </div>
  </div>
  <h6 class="text-warning">Cluster Quality = <?= $sx;?></h6>

  <h4>Cluster 1</h4>
  <dt>Cost Cluster 1 = <?= $total_cluster1;?></dt>
  <dt>ax = <?= $ax;?></dt>
  <table class="table table-hover">
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
      <?php foreach ($cluster1 as $key =>$c1) : ?>
        <tr>
          <th scope="row"><?= $i; ?></th>
          <td><?= $list[$key]['product'] ?></td>
          <td><img src="<?= base_url('assets/img/product/') . $list[$key]['image']?>" class="img-thumbnail col-sm-2"></td>
          <td><?= $list[$key]['total'] ?></td>
          <td><?= $list[$key]['modus'] ?></td>
        </tr>
      <?php $i++; ?>
      <?php endforeach; ?>
    </tbody>
  </table>

  <h4>Cluster 2</h4>
  <dt>Cost Cluster 2 = <?= $total_cluster2;?></dt>
  <dt>bx = <?= $bx;?></dt>
  <table class="table table-hover">
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
      <?php foreach ($cluster2 as $key =>$c2) : ?>
        <tr>
          <th scope="row"><?= $i; ?></th>
          <td><?= $list[$key]['product'] ?></td>
          <td><img src="<?= base_url('assets/img/product/') . $list[$key]['image']?>" class="img-thumbnail col-sm-2"></td>
          <td><?= $list[$key]['total'] ?></td>
          <td><?= $list[$key]['modus'] ?></td>
        </tr>
      <?php $i++; ?>
      <?php endforeach; ?>
    </tbody>
  </table>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->