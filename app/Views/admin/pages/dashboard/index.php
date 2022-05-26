<?= $this->extend('layouts/admin/admin') ?>

<?= $this->section('content-title') ?>
    Dashboard
<?= $this->endSection() ?>

<?= $this->section('content-body') ?>
    <?php /** @var int|null $members */ ?>
    <?php /** @var int|null $shippings */ ?>
    <?php /** @var int|null $incomes */ ?>
    <?php /** @var int|null $expenditures */ ?>
    <?php /** @var array $incomesPerMonths */ ?>
    <?php /** @var array $expendituresPerMonths */ ?>
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Member</h4>
                    </div>
                    <div class="card-body">
                        <?= format_number($members, ''); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-truck"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pengiriman</h4>
                    </div>
                    <div class="card-body">
                        <?= format_number($shippings, ''); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                    <i class="fas fa-download"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pemasukan</h4>
                    </div>
                    <div class="card-body">
                        <?= format_number($incomes['total'] ?? 0); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="fas fa-upload"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Pengeluaran</h4>
                    </div>
                    <div class="card-body">
                        <?= format_number($expenditures['total'] ?? 0); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Grafik Pemasukan dan Pengeluaran</h4>
                </div>
                <div class="card-body">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('content-script') ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_keys($incomesPerMonths)) ?>,
                datasets: [{
                    label: 'Pemasukan',
                    data: <?= json_encode(array_values($incomesPerMonths)) ?>,
                    backgroundColor: [
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                },
                {
                    label: 'Pengeluaran',
                    data: <?= json_encode(array_values($expendituresPerMonths)) ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                    ],
                    borderWidth: 1
                },]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
<?= $this->endSection() ?>