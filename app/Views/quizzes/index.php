<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Quizzes</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
               <div>
                    <?php if(session()->getFlashdata('success')) : ?>
                        <div class="success alert-success" style="border-radius:5px; padding:5px;text-align:center;"><?= session()->getFlashdata('success'); ?>
                    <?php endif ?>
                    <?php if(session()->getFlashdata('fail')) : ?>
                        <div class="success alert-danger" style="border-radius:5px; padding:5px;text-align:center;"><?= session()->getFlashdata('fail'); ?>
                    <?php endif ?>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>All Quizzes Data
                        <a href="<?= base_url('quiz-add')?>" class="btn btn-primary float-right">Add Quiz</a>
                        <a href="<?= base_url('/admindashboard')?>" class="btn btn-danger float-right">BACK</a>
                     
                        </h4>

                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr style="text-align:center;">
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Total</th>
                                    <th>Host</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($quiz as $row) : ?>
                                <tr style="text-align:center;">
                                    
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['title'] ?></td>
                                    <td><?= $row['desc'] ?></td>
                                    <td><?= $row['total'] ?></td>   
                                    <td><?= $row['name'];?></td>  
                                    <td class="d-flex justify-content-around">
                                        <a href="<?= base_url('quiz/show/'.$row['id'])?>" class="btn btn-primary btn-sm">View</a>
                                        <a href="<?= base_url('quiz/edit/'.$row['id'])?>" class="btn btn-success btn-sm">Edit</a>
                                        <form action="<?= base_url('quiz/delete/'.$row['id'])?>" method="POST">
                                            <input type="hidden" name="_method" value="DELETE" />
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this quiz ? Warning: Deleting this quiz will delete all related questions!')">Delete</button>
                                        </form>
                                        
                                    </td>                            
                                <?php endforeach; ?>

                                        
                                        
                                                               
                                    

                                </tr>
                                

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>