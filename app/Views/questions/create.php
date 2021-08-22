<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Question</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Question
                        <a href="<?= base_url('quiz')?>" class="btn btn-danger float-right">Finish Quiz</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <form action="<?= base_url('question/store/'.$id) ?>" method="POST">
                        <div class="form-group">
                            <label for="question">Question</label>
                            <input type="text" class="form-control" name="question" placeholder="Question">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'question') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="choice1">Choice1</label>
                            <input type="text" class="form-control" name="choice1" placeholder="Choice1" >
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'choice1') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="choice2">Choice2</label>
                            <input type="text" class="form-control" name="choice2" placeholder="Choice2" >
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'choice2') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="choice3">Choice3</label>
                            <input type="text" class="form-control" name="choice3" placeholder="Choice2" >
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'choice3') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="answer">Answer</label>
                            <input type="text" class="form-control" name="answer" placeholder="Answer" >
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'answer') : '' ?></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                                            
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>