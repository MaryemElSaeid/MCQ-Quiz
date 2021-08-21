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
                        <h4>Add Quiz
                        <a href="<?= base_url('quiz')?>" class="btn btn-danger float-right">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                    <form action="<?= base_url('quiz-store') ?>" method="POST">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" placeholder="Title" value="<?= set_value('title'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'title') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <input type="text" class="form-control" name="desc" placeholder="Description" value="<?= set_value('desc'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'desc') : '' ?></span>
                        </div>
                        <div class="form-group">
                            <label for="total">Total Marks</label>
                            <input type="text" class="form-control" name="total" placeholder="Total Marks" value="<?= set_value('total'); ?>">
                            <span class="text-danger"><?= isset($validation) ? display_error($validation, 'total') : '' ?></span>
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