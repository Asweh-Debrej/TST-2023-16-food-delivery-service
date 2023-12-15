<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<h1>Order Detail</h1>
<div class="container">
  <div class="row">
  <div class="col">
      <h1 class="mt-2">Order ID: <?= $order['id']; ?></h1>
      <h1 class="mt-2">Customer Name: <?= $order['customer_name']; ?></h1>
      <h1 class="mt-2">Total Amount: Rp.<?= $order['total_amount']; ?></h1>
      <h1 class="mt-2">Status: <?= $order['status']; ?></h1>
      <h1 class="mt-2">Created At: <?= $order['created_at']; ?></h1>
      <h1 class="mt-2">Updated At: <?= $order['updated_at']; ?></h1>
    </div>
  </div>
</div>

<a href="/order" class="btn btn-primary">Back to List</a>
<button onclick="assignToStaff()" class="btn btn-primary">Assign Staff</button>

<script>
  function assignToStaff() {
    // Call the assignToStaff() function here
  }
</script>

  </div>
</div>

<?= $this->endSection(); ?>
