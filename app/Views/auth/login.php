<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>SignIn</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</head>
<body>
<div class="container">
       <div class="row" style="margin-top:50px;justify-content:center;">
           <div class="col-md-4 col-md-offset-4">
               <h4>Sign In</h4><hr>
               <form action="<?= base_url('auth/check')?>" method="post">
                <div >
                  <?php if(!empty(session()->getFlashdata('fail'))) : ?>
                    <div class="alert alert-danger" style="border-radius:5px; padding:5px;text-align:center;" ><?= session()->getFlashdata('fail'); ?>
                  <?php endif ?>
                </div>
                   <div class="form-group">
                       <label for="">Email</label>
                       <input type="text" class="form-control" name="email" placeholder="Enter your email" value="<?= set_value('email'); ?>">
                       <span class="text-danger"><?= isset($validation) ? display_error($validation, 'email') : '' ?></span>
                   </div>
                   <div class="form-group">
                       <label for="">Password</label>
                       <input type="password" class="form-control" name="password" placeholder="Enter password">
                       <span class="text-danger"><?= isset($validation) ? display_error($validation, 'password') : '' ?></span>
                   </div>
                   <div class="form-group">
                       <button class="btn btn-primary btn-block"  type="submit">Sign In</button>
                   </div>
                   <br>
                   <a href="<?= site_url('auth/register'); ?>">Have no Account , Sign Up now</a>
               </form>
           </div>
       </div>  
   </div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</body>
</html>