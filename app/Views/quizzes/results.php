<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Edit User</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4><?= $quiz['title']; ?>
                        <a href="<?= base_url('/userdashboard')?>" class="btn btn-danger float-right">Home Page</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <label type="text" class="form-control" name="title"><?= $quiz['title']; ?>
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <label type="text" class="form-control" name="desc"><?= $quiz['desc']; ?>
                        </div>
                        <div class="form-group">
                            <label for="total">Total</label>
                            <label type="text" class="form-control" name="total" ><?= $quiz['total']; ?>
                        </div>
                    
                        <h4 name="score"><?php $score =0; ?></h4>
                        
                        <?php 
                           $number_of_questions = sizeof($question);

                           for($i=0;$i<$number_of_questions;$i++) { $correct_answer = $question[$i]['answer'];?>
                            
                                <form method="post" action="">  
                            
                                
                                <p><?=$question[$i]['question']?></p>
                                

                                <?php if ($user_answers[$i] == $correct_answer) { ?>
                                    <p><span style="background-color: #ADFFB4"><?=$user_answers[$i]?></span></p>
                                    <?php $score = $score + 1; ?>
                                 
                                <?php } else { ?>
                                    <p><span style="background-color: #FF9C9E"><?=$user_answers[$i]?></span></p>
                                    <p><span style="background-color: #ADFFB4"><?=$question[$i]['answer']?></span></p>
                                    
                                
                                <?php } } ?>
                                <h4>Your Score: </h4>
                                <h4><?=$score.'/'.$quiz['total']?></h4>

                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</body>
</html>


