<?php
$all_messages = file_get_contents('messages.json');
$all_messages = json_decode($all_messages, true);
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Contacts message</title>

    <style>
        .contact-box{
            border: 1px solid gray;
            padding: 15px 15px 15px 15px;
            border-radius: 5px;
            background-color:rgba(245, 245, 245, 1);
            box-shadow: 5px 10px 20px gray inset;
        }
        .content{
            height:100%;
            width:300px;
            border: 1px solid gray;
            border-radius:5px;
            padding:3px 3px;
            background-color:rgba(245, 245, 245, 1);
            box-shadow: 5px 10px 20px gray inset;
        }


    </style>
</head>
<body>

<div class="container">
    <div class="alert alert-danger alert-dismissible d-none">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <div class="contact-box mt-4">
        <form method="post" action="" id="form">
            <div class="form-group">
                <label for="name">Your name</label>
                <input type="text" name="name" class="form-control" id="name" placeholder="John Doe">
            </div>

            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
            </div>

            <div class="form-group">
                <label for="message">Your message</label>
                <textarea name="message" class="form-control" id="message" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success" id="send">Send</button>
        </form>
    </div>

    <?php foreach ($all_messages as $message) : ?>
       <div class="content mt-4">
           <div class="d-inline">
              <p>
                  <img src="profile.jpg" style="width:30px; height: 30px; border-radius: 50%">
                  <strong><?=$message['name']?></strong><br/>
                  <span><?=$message['message']?></span><br/>
                  <i class="text-primary"><?=$message['date']?></i>
              </p>
           </div>
       </div>
    <?php endforeach;?>


</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(function(){

        const textarea = $('#form').find('#message');
        textarea.keypress(function (event) {
           if(event.which === 13){
               $('#send').click();
           }
        });


        $(document).on('submit', '#form', function (e) {

            const form = $(this);
            const name = form.find('#name').val();
            const email = form.find('#email').val();
            const message = form.find('#message').val();

           let fData = {
               name: name,
               email: email,
               message: message
           };
            $.ajax({
                url: 'treatment.php',
                method: 'POST',
                dataType: 'json',
                async: true,
                cache: false,
                data: fData,
                success: function(response) {
                    if(response.error){
                        $('.alert-danger').html(response.error).removeClass('d-none');

                    }else{
                        window.location.href = './';
                    }
                }
            });
            return false;
        });
    });
</script>
</body>
</html>