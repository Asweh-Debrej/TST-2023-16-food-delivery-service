<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
  <div class="card">
    <div class="card-header custom-navbar text-white">
      <h1 class="card-title mb-0">Order Detail</h1>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <h5 class="card-text">Order ID:</h5>
          <p class="card-text"><?= $order['id']; ?></p>

          <h5 class="card-text">Customer Name:</h5>
          <p class="card-text"><?= $order['customer_name']; ?></p>

          <h5 class="card-text">Total Amount:</h5>
          <p class="card-text">Rp.<?= $order['total_amount']; ?></p>
        </div>
        <div class="col-md-6">
          <h5 class="card-text">Status:</h5>
          <p class="card-text"><?= $order['status']; ?></p>

          <h5 class="card-text">Created At:</h5>
          <p class="card-text"><?= $order['created_at']; ?></p>

          <h5 class="card-text">Delivers To:</h5>
          <p class="card-text"><?= $order['updated_at']; ?></p>
        </div>
      </div>
    </div>
    <div class="card-footer text-end">
      <a href="/order" class="btn btn-secondary">Back to List</a>
      <button onclick="assignToStaff()" class="btn btn-primary">Assign Staff</button>
    </div>
  </div>
</div>

<script>
  function assignToStaff() {
    // Call the assignToStaff() function here
  }
</script>

<?= $this->endSection(); ?>