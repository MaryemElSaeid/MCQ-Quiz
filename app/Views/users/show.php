<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <title>Show User</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5">
                <div class="card">
                    <div class="card-header">
                        <h4><?= $user['name']; ?>
                        <a href="<?= base_url('user')?>" class="btn btn-danger float-right">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <label type="text" class="form-control" name="name" ><?= $user['name']; ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <label type="text" class="form-control" name="email" ><?= $user['email']; ?>
                        </div>

                        <table class="table table-bordered">
                            <thead>
                                <tr style="text-align:center;">
                                    <th>Quiz</th>
                                    <th>Score</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                <?php foreach($userquiz as $row) : ?>
                                <tr style="text-align:center;">
                                    <td><?= $row['title'] ?></td>
                                    <td><?= $row['score'] ?></td>
                                    <td><?= date("Y-m-d", strtotime($row['created_at'])) ?></td>
                                </tr>
                                <?php endforeach; ?>

                            </tbody>
                        </table>
                    </form>
                                            
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>