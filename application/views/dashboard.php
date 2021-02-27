<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
  <meta charset="utf-8">
  <title><?php echo $judul?></title>


<!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Books</div>
                      
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_students ;?></div>
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Operators</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_operators ;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Books</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_books ;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Shelfs</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_shelfs ;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

                        <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Borrowing</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_borrowing ;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

                        <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Majors</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_majors ;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

                        <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Transactions</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_transactions ;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

                        <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $total_users ;?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>



<!--          <div class='buttons' href="style/column_comparison.css">
            <button id='2000'>
            2000
            </button>
            <button id='2004'>
            2004
            </button>
            <button id='2008'>
            2008
            </button>
            <button id='2012'>
            2012
            </button>
            <button id='2016' class='active'>
            2016
            </button>
          </div>-->
          <figure class="highcharts-figure">
            <div id="container"></div>
          </figure>

        </div>
        <!-- /.container-fluid -->

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="<?php echo base_url('assets/css/triplecharts.css');?>"></script>
<script type="text/javascript">
Highcharts.chart('container', {
  title: {
    text: 'Data Library'
  },
  xAxis: {
    categories: ['Students', 'Operators', 'Books', 'Shelfs', 'Borrowings', 'Majors' , 'Transactions', 'Users']
  },
  labels: {
    items: [{
      html: 'Total Data Library',
      style: {
        left: '50px',
        top: '18px',
        color: ( // theme
          Highcharts.defaultOptions.title.style &&
          Highcharts.defaultOptions.title.style.color
        ) || 'black'
      }
    }]
  },
  series: [{
    type: 'column',
    colorByPoint: true,
    name: 'Total',
    data: [<?php echo $total_students ;?>, <?php echo $total_operators ;?>, <?php echo $total_books ;?>, <?php echo $total_shelfs ;?>, <?php echo $total_borrowing ;?>, <?php echo $total_majors ;?>, <?php echo $total_transactions ;?>, <?php echo $total_users ;?>]
  }, {
    type: 'pie',
    name: 'Total',
    data: [{
      name: 'Students',
      y: <?php echo $total_students ;?>,
      color: Highcharts.getOptions().colors[0] // Jane's color
    }, {
      name: 'Operators',
      y: <?php echo $total_operators ;?>,
      color: Highcharts.getOptions().colors[1] // John's color
    }, {
      name: 'Operators',
      y: <?php echo $total_books ;?>,
      color: Highcharts.getOptions().colors[2] // John's color
    }, {
      name: 'Operators',
      y: <?php echo $total_shelfs ;?>,
      color: Highcharts.getOptions().colors[3] // John's color
    }, {
      name: 'Operators',
      y: <?php echo $total_borrowing ;?>,
      color: Highcharts.getOptions().colors[4] // John's color
    }, {
      name: 'Operators',
      y: <?php echo $total_majors ;?>,
      color: Highcharts.getOptions().colors[5] // John's color
    }, {
      name: 'Operators',
      y: <?php echo $total_transactions ;?>,
      color: Highcharts.getOptions().colors[6] // John's color
    }, {
      name: 'Operators',
      y: <?php echo $total_users ;?>,
      color: Highcharts.getOptions().colors[7] // John's color
    }],
    center: [100, 80],
    size: 100,
    showInLegend: false,
    dataLabels: {
      enabled: false
    }
  }]
});

</script>