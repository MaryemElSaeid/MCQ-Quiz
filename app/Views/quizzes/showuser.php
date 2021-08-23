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
                        </h4>
                    </div>
                    <div class="card-body">
                    <form action="<?= base_url('quiz/check/'.$quiz['id']) ?>" method="POST">
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
                        <?php foreach($question as $row) { ?>
                            
                            <p><?=$row['question']?></p>
    
                        <?php $ans_array = array($row['choice1'], $row['choice2'], $row['choice3'], $row['answer']);
                        shuffle($ans_array); ?>

                        <select name="<?=$row['id']?>" class="form-control" id="exampleFormControlSelect1" >
                            <option value="" disabled selected >------Select your answer------</option>
                            <option name="<?=$row['id']?>" value="<?=$ans_array[0]?>" required> <?=$ans_array[0]?></option>
                            <option name="<?=$row['id']?>" value="<?=$ans_array[1]?>"> <?=$ans_array[1]?></option>
                            <option name="<?=$row['id']?>" value="<?=$ans_array[2]?>"> <?=$ans_array[2]?></option>
                            <option name="<?=$row['id']?>" value="<?=$ans_array[3]?>"> <?=$ans_array[3]?></option>
                        </select>   
                        <?php  } ?>                           
                    <button type="submit" class="btn btn-primary" id="sbtn">Submit</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div> 
</body>
</html>


