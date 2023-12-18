<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
  <div class="row">
    <div class="col">

      <div class="container mt-3 mb-3">
        <h1 class="mt-2"><strong>Paid Orders</strong></h1>

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
                <td><?= $o['id']; ?></td>
                <td><?= $o['recipient']; ?></td>
                <td>Rp.<?= $o['total_amount']; ?></td>
                <td><?= $o['status']; ?></td>
                <td>
                  <a href="/order/<?= $o['id']; ?>" class="btn btn-primary">Detail Order</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>

      </div>
    </div>
  </div>

  <?= $this->endSection(); ?>
