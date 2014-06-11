<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>INTELPHONE | ログイン</title>
  <link href="/css/intelphone.css" rel="stylesheet">
  <style>
    html {
      height : 100%;
      background-size: curtain;
      background-image: url('/img/main_visual.png');
    }

    body {
      padding: 0;
    }

    .container {
      position: fixed;
      top: 100px;
    }
  </style>
  <!--[if lt IE 9]><script src="/js/ie8-responsive-file-warning.js"></script><![endif]-->
  <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
  </head>

  <body>

    <div class="container">
    <?php echo $this->Form->create('User', Array('url' => '/login','class' => 'form-signin')); ?>
        <?php echo $this->Session->flash('auth'); ?>
        <h2 class="form-signin-heading arkitech" style="color:#FFF;">
           <span class="icon-logo">&nbsp;</span>INTELPHONE
        </h2>
        <?php echo $this->Form->input('phoneno', Array('label' => false , 'class'=>'form-control', 'placeholder'=>'電話番号')); ?>
        <?php echo $this->Form->input('password', Array('label' => false , 'class'=>'form-control', 'placeholder'=>'パスワード')); ?>
        <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
    <?php echo $this->Form->end(); ?>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
