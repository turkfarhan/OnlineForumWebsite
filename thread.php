<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">


    <title>Welcome to iDiscussion-Coding Forum</title>
</head>

<body>

    <?php include 'partials/_header.php' ?>
    <?php include 'partials/_dbconnect.php' ?>


    <?php
    $id = $_GET['thread_id'];
    $sql ="SELECT * FROM `threads` WHERE thread_id = $id";
    $result = mysqli_query($conn , $sql);
    while($row = mysqli_fetch_assoc($result))
    {
        $title = $row['thread_title'];
        $desc = $row['thread_desc'];
        
    }
    ?>

    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method=='POST')
    {
        //insert into comments db
        $comment= $_POST['comment'];
        $sql = "INSERT INTO `comments` (`comment_content`, `thread_id`, `comment_by`, `comment_time`)
                VALUES ('$comment', '$id', '0', current_timestamp());";
        $result = mysqli_query($conn , $sql);  
        $showAlert = true;
        if($showAlert)
        {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                   <strong>Success!</strong> Your comment has been added!! 
                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
                  </div>';
        }
    }

    ?>

    <!-- Category container start here -->

    <div class="container my-3">
        <div class="jumbotron">
            <h1 class="display-4"><?php echo $title ;?></h1>
            <p class="lead"> <?php echo $desc ;?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum is for sharing kmowledge with each other</p>
            <p>Posted by: <b> Farhan Pasha </b></p>
        </div>
    </div>


    <div class="container">
        <h1 class="py-2">Post A comment</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI']?> " method="post">
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Type your comments</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Post comment</button>
        </form>

    </div>

    <div class="container">
        <h1 class="py-2">Discussions</h1>

        <?php
    $id = $_GET['thread_id'];
    $sql ="SELECT * FROM `comments` WHERE thread_id= $id";
    $result = mysqli_query($conn , $sql);
    $noResult = true;
    while($row = mysqli_fetch_assoc($result))
    {
        $noResult = false;

        $id = $row['comment_id'];
        $content= $row['comment_content'];
        $comment_time = $row['comment_time'];

        echo '<div class="media my-3">
            <img src="img/userdefault.png" width="54px" class="mr-3" alt="...">
            <div class="media-body">
            <p class="font-weight-bold my-0">Anonymous User at ' .$comment_time. ' </p>
             '.$content.'
            </div>
        </div>';
    }
          
    
    if($noResult)
    {
            echo '<div class="jumbotron jumbotron-fluid">
            <div class="container">
              <p class="display-4">No ThreadsFound</p>
              <p class="lead"> <b>Be the first Person to ask the question </b></p>
            </div>
          </div>';
    }


    ?>
    </div>

    <?php include 'partials/_footer.php' ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->

</body>

</html>