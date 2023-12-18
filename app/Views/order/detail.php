<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container mt-4">
  <div class="card">
    <div class="card-header custom-navbar text-white">
      <h1 class="card-title mb-0">Order Detail #<?= $order['id']; ?></h1>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <h5 class="card-text">Staff:</h5>
          <p class="card-text"><?= $order['staff'] ?? 'Unassigned'; ?></p>

          <h5 class="card-text">Recipient:</h5>
          <p class="card-text"><?= $order['recipient']; ?></p>

          <h5 class="card-text">Total Amount:</h5>
          <p class="card-text">Rp.<?= $order['total_amount']; ?></p>

          <h5 class="card-text">Assigned At:</h5>
          <p class="card-text"><?= $order['assigned_at'] ?? 'Unassigned'; ?></p>
        </div>
        <div class="col-md-6">
          <h5 class="card-text">Status:</h5>
          <p class="card-text"><?= $order['status']; ?></p>

          <h5 class="card-text">Sender:</h5>
          <p class="card-text"><?= $order['sender_name']; ?></p>

          <h5 class="card-text">Created At:</h5>
          <p class="card-text"><?= $order['created_at']; ?></p>

          <h5 class="card-text">Estimated Arrival:</h5>
          <p class="card-text"><?= $order['estimated_arrival'] ?? 'Not Available'; ?></p>
        </div>
      </div>
    </div>
    <div class="card-footer text-end">
      <a href="/order" class="btn btn-secondary">Back to List</a>
      <button onclick="assignToStaff()" class="btn btn-primary" <?= $order['status'] !== 'Processing' ? 'disabled' : ''; ?>>Assign to Most Available Staff</button>
    </div>
  </div>
</div>

<script>
  function assignToStaff() {
    // Call createOrderAssignment with order_id
    const order_id = <?= $order['id']; ?>;
    const url = '/assignment';
    const data = {
      order_id: order_id,
    };
    const options = {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify(data),
    };

    fetch(url, options)
      .then(response => response.json())
      .then(data => {
        console.log(data);
        if (data.error) {
          alert(data.error.message);
        } else {
          alert('Order assigned to staff successfully');
        }
      })
      .catch(error => {
        console.error(error);
      });

    // Refresh the page
    location.reload();
  }
</script>

</script>

<?= $this->endSection(); ?>
