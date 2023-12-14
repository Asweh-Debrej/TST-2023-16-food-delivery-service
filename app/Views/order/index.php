<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="row">
    <div class="col">

      <h1 class="mt-2">List of Paid Orders</h1>

      <table class="table">
        <thead>
          <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Total Amount</th>
            <th scope="col">Status</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($order as $o) : ?>
            <tr>
              <td><?= $o['order_id']; ?></td>
              <td><?= $o['customer_name']; ?></td>
              <td>Rp.<?= $o['total_amount']; ?></td>
              <td><?= $o['status']; ?></td>
              <td>
                <a href="/order/detail/<?= $o['order_id']; ?>" class="btn btn-primary">Detail Order</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

    </div>
  </div>
</div>

<?= $this->endSection(); ?>