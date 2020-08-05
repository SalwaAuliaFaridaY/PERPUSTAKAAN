<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </head>
  <body>
    <div class="container my-5">
      <div class="row justify-content-center align-items-center">
      <div class="col-sm-6 card">
        <div class="card-header">
          <h3>Login Form</h3>
        </div>
        <div class="card-body">
          <form action="proses_login_siswa.php" method="post">
            <input type="text" name="username" class="form-control mb-2" placeholder="Username" required>
            <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
            <button type="submit" class="btn btn-warning btn-block">
              LOGIN O REK!
            </button>
          </form>
        </div>
      </div>
     </div>
    </div>
  </body>
</html>
