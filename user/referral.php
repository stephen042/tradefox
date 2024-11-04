<?php $title = "Referral"; ?>
<?php include("header.php"); ?>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3>Referral</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Referral</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <?php get_message(); ?>
            <div class="row">
              <div class="col-md-12">
                    <div class="form-row">
                        <div class="form-group col-md-12">
                          <div class="card">
                            <div class="card-body">
                              <h5 class="mb-3">To referrer a user, copy the referral link for registration</h5>
                              <label for="">Referral Link</label>
                              <input type="text" name="referral_link" class="form-control" value="https://global-emmytyips.com/register.php?ref=<?= $user_row['username'] ?>" disabled>
                            </div>
                          </div>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="card">
                              <div class="card-body">
                                <h5 class="mb-3">Your referred members</h5>
                                <table class="table">
                                  <thead>
                                    <tr>
                                      <th scope="col">Name</th>
                                      <th scope="col">Date of Registration</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                              </div>
                            </div>
                          </div>
                    </div>
              </div>
            </div>
          </div>
          <div class="col-md-12 mx-auto">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                                          </div>
                    <div class="col-md-12">
                      <h4>Affiliate Commision</h4>
                      <div class="table-responsive no-padding">
                        <table id="dataTable" class="table table-hover table-striped table-borderless">
                          <thead>
                            <tr>
                              <th>Amount</th>
                              <th>Status</th>
                              <th>Description</th>
                              <th>Created At</th>
                            </tr>
                          </thead>
                          <tbody>
                                                      </tbody>
                        </table>
                      </div>
                    </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include("footer.php"); ?>