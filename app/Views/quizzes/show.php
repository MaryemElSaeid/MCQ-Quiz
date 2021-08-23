<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Quiz</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4><?= $quiz['title']; ?>
                        <a href="<?= base_url('quiz')?>" class="btn btn-danger float-right">BACK</a>
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
                    </form>
                    <table class="table table-bordered">
                            <thead>
                                <tr style="text-align:center;">
                                    <th>Id</th>
                                    <th>Question</th>
                                    <th>Choice 1</th>
                                    <th>Choice 2</th>
                                    <th>Choice 3</th>
                                    <th>Answer</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($question as $row) : ?>
                                <tr style="text-align:center;">
                                    <td><?= $row['id'] ?></td>
                                    <td><?= $row['question'] ?></td>
                                    <td><?= $row['choice1'] ?></td>
                                    <td><?= $row['choice2'] ?></td>   
                                    <td><?= $row['choice3'];?></td>  
                                    <td><?= $row['answer'];?></td> 
                           
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