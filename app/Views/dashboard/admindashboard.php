<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>AdminDashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

</head>
<body>

<div class="container">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Quiz Application</a>
  <div class="collapse navbar-collapse" id="navbarNavDropdown">
    <ul class="navbar-nav  ml-auto">
      <li class="nav-item active">
        <a class="nav-link" href="<?= site_url("auth/logout"); ?>">Logout <span class="sr-only">(current)</span></a>
      </li>
    </ul>
  </div>
</nav>
<div class="blockquote text-center" style="margin-top:100px;margin-bottom:100px;">
    <h4>Welcome <?= $adminInfo['name'] ?></h4>
</div>

<div class="row">
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body" style="background-color:#EBF4FA;">
        <h5 class="card-title">Quizzes</h5>
        <p class="card-text">Manage quizzes, Add,edit or delete.</p>
        <a href="<?= base_url('/quiz')?>" class="btn btn-primary ">Go</a>
      </div>
    </div>
  </div>
  <div class="col-sm-6">
    <div class="card">
      <div class="card-body" style="background-color:#EBF4FA;">
        <h5 class="card-title">users</h5>
        <p class="card-text">Manage quizzes, Add,edit or delete.</p>
        <a href="<?= base_url('/user')?>" class="btn btn-primary">Go</a>
      </div>
    </div>
  </div>
</div>
</div>
</body>
</html>