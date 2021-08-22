<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>UserDashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

</head>
<body>
    <div>
         <?php if(session()->getFlashdata('success')) : ?>
            <div class="success alert-success" style="border-radius:5px; padding:5px;text-align:center;"><?= session()->getFlashdata('success'); ?>
         <?php endif ?>
         <?php if(session()->getFlashdata('fail')) : ?>
            <div class="success alert-danger" style="border-radius:5px; padding:5px;text-align:center;"><?= session()->getFlashdata('fail'); ?>
         <?php endif ?>
    </div>

    <h4>Welcome <?= $userInfo['name'] ?></h4>
    <h4>email <?= $userInfo['email'] ?></h4>
    <a href="<?= base_url('quiz/list')?>" class="btn btn-primary ">All Quizzes</a>
    <a href="<?= base_url('user/show/'.$userInfo['id'])?>" class="btn btn-primary">My Profile</a>
    <a href="<?= base_url('user/edit/'.$userInfo['id'])?>" class="btn btn-primary">Edit Profile</a>
    <a href="<?= site_url("auth/logout"); ?>">Logout</a>
    
    
</body>
</html>