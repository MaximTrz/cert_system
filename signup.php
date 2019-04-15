<?php

require 'db.php';

$data = $_POST;
if( isset($data['do_signup']))
    {
    $errors = array();
    if(trim($data['login'])==''){
        $errors[] = 'Введите логин!';
    }
    if(trim($data['email'])==''){
        $errors[] = 'Введите email!';
    }
    if(trim($data['password'])==''){
        $errors[] = 'Введите пароль!';
    }
    if($data['password_2'] != $data['password']){
        $errors[] = 'Повторный пароль введен неверно!';
    }
    if( R::count('users', "login = ?", array($data['login']))){
    $errors[] = 'Пользователь с таким логином уже зарегистрирован!';
    }
    if( R::count('users', "email = ?", array($data['email']))){
    $errors[] = 'Пользователь с таким email-ом уже зарегистрирован!';
    }
    
    if( empty($errors)){
      
        $user = R::dispense('login');
        $user->login = $data['login'];
        $user->email = $data['email'];
        $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
        R::store($user);
        header('location: login.php');

    } else {
    
        echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
    }
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Регистрация</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://code.jquery.com/jquery-3.3.1.js"></script>
<!--        <script type="text/javascript" src="js/addcert.js"></script>-->
<!--	<link href="css/style.css" rel="stylesheet">-->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
        <script type="text/javascript">
        $(function(){
        $(".showpassword").each(function(index,input) {
            var $input = $(input);
            $("<p class="opt">").append(
                $("<input type="checkbox" class="showpasswordcheckbox" id="showPassword">").click(function() {
                    var change = $(this).is(":checked") ? "text" : "password";
                    var rep = $("<input placeholder="Password" type="" + change + "">")
                        .attr("id", $input.attr("id"))
                        .attr("name", $input.attr("name"))
                        .attr('class', $input.attr('class'))
                        .val($input.val())
                        .insertBefore($input);
                    $input.remove();
                    $input = rep;
                 })
            ).append($("<label for="showPassword">").text("Show password")).insertAfter($input.parent());
        });
    });
    $('#showPassword').click(function(){
    if($("#showPassword").is(":checked")) {
        $('.icon-lock').addClass('icon-unlock');
        $('.icon-unlock').removeClass('icon-lock');    
    } else {
        $('.icon-unlock').addClass('icon-lock');
        $('.icon-lock').removeClass('icon-unlock');
    }
});
    </script>
</head>
<body>
    <div class="container">
            <form class="form-2" role="form" action="" method="post">
                <h1><span class="log-in"><a href="/login.php">Вход</a></span> или <span class="sign-up"><a href="/signup.php">регистрация</a></span></h1>
            <p class="float">
                <label for="login"><i class="icon-user"></i>Введите ваш логин</label>
                <input type="text" name="login" placeholder="Логин" value="<?=@$data['login']?>" required>
            </p>
            <p class="float">
                <label for="login"><i class="icon-user"></i>Введите ваш email</label>
                <input type="email" name="email" placeholder="Email" value="<?=@$data['email']?>" required>
            </p>
            
            
            <p class="float">
                <label for="password"><i class="icon-lock"></i>Введите ваш пароль</label>
                <input type="password" name="password" placeholder="Пароль" class="showpassword" value="<?=@$data['password']?>" required> 
            </p>
            
           <p class="float">
                <label for="password"><i class="icon-lock"></i>Подтверждение</label>
                <input type="password" name="password_2" placeholder="Введите ваш пароль еще раз" class="showpassword" value="<?=@$data['password_2']?>" required> 
            </p>
            
            <p class="clearfix"> 
                <input type="submit" name="do_signup" value="Зарегистрироваться">
            </p>       
       
            </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <div class="row">
            <div class="col-md-12 block"><h3>  </h3></div>
        </div>
    </div> 
</body>
</html>