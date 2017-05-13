<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>

    <title><?= Html::encode($this->title) ?></title>

    <meta name="keywords" content="">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

    <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,700,800' rel='stylesheet' type='text/css'>

    <!-- Bootstrap and Font Awesome css -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

    <script src="/js/jquery.cookie.js"></script>
    <script src="/js/waypoints.min.js"></script>
    <script src="/js/jquery.counterup.min.js"></script>
    <script src="/js/jquery.parallax-1.1.3.js"></script>
    <script src="/js/front.js"></script>

    <!-- Css animations  -->
    <link href="/css/animate.css" rel="stylesheet">

    <!-- Theme stylesheet, if possible do not edit this stylesheet -->
    <link href="/css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- Custom stylesheet - for your changes -->
    <link href="/css/custom.css" rel="stylesheet">

    <!-- Responsivity for older IE -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

    <!-- Favicon and apple touch icons-->
    <link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="/img/apple-touch-icon.png" />
    <link rel="apple-touch-icon" sizes="57x57" href="/img/apple-touch-icon-57x57.png" />
    <link rel="apple-touch-icon" sizes="72x72" href="/img/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-touch-icon-76x76.png" />
    <link rel="apple-touch-icon" sizes="114x114" href="/img/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon" sizes="120x120" href="/img/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon" sizes="144x144" href="/img/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon" sizes="152x152" href="/img/apple-touch-icon-152x152.png" />

    <!-- owl carousel css -->

    <link href="/css/owl.carousel.css" rel="stylesheet">
    <link href="/css/owl.theme.css" rel="stylesheet">

    <meta name="google-site-verification" content="YPfLsY7wPaAg24j4p46zDNyQ7ib94xNy8ufvOQMTJFo" />

    <script type="application/ld+json">
    <?= json_encode($this->context->jsonld) ?>
    </script>

    <?php $this->head() ?>

</head>

<body>
    <?php $this->beginBody() ?>

    <div id="all">
        <header>

            <!-- *** TOP ***
_________________________________________________________ -->
            <?/*
            <div id="top">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-5 contact">
                        </div>
                        <div class="col-xs-7">

                            <div class="login">
                                <a href="<?= Url::to(['auth/login']) ?>"><i class="fa fa-sign-in"></i> <span class="hidden-xs text-uppercase">Sign in</span></a>
                                <a href="#"><i class="fa fa-user"></i> <span class="hidden-xs text-uppercase">Sign up</span></a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>*/?>

            <!-- *** TOP END *** -->

            <!-- *** NAVBAR ***
    _________________________________________________________ -->

            <div <?/* class="navbar-affixed-top" data-spy="affix" data-offset-top="200" */ ?>>

                <nav class="navbar navbar-default yamm" role="navigation" id="navbar">

                    <div class="container">
                        <div class="navbar-header">

                            <div class="navbar-buttons">
                                <button type="button" class="navbar-toggle btn-template-main" data-toggle="collapse" data-target="#navigation">
                                    <span class="sr-only">Toggle navigation</span>
                                    <i class="fa fa-align-justify"></i>
                                </button>
                            </div>
                        </div>
                        <!--/.navbar-header -->

                        <div class="navbar-collapse collapse" id="navigation">

                            <ul class="nav navbar-nav navbar-right">
                                <li class="">
                                    <a href="/">Home</a>
                                    <?/*
                                    <ul class="dropdown-menu">
                                        <li><a href="index.html">Option 1: Default Page</a>
                                        </li>
                                        <li><a href="index2.html">Option 2: Application</a>
                                        </li>
                                        <li><a href="index3.html">Option 3: Startup</a>
                                        </li>
                                        <li><a href="index4.html">Option 4: Agency</a>
                                        </li>
                                        <li><a href="index5.html">Option 5: Portfolio</a>
                                        </li>
                                    </ul>*/?>
                                </li>
                                <li class="dropdown use-yamm yamm-fw">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Контент<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <div class="yamm-content">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <img src="/img/template-easy-customize.png" class="img-responsive hidden-xs" alt="">
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <h5>Видео</h5>
                                                        <ul>
                                                            <li><a href="<?= Url::to(['site/index','cat_id' => 1]) ?>">Сериалы</a></li>
                                                            <li><a href="<?= Url::to(['site/index','cat_id' => 3]) ?>">Мультсериалы</a></li>
                                                            <li><a href="<?= Url::to(['site/index','cat_id' => 4]) ?>">Аниме</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <h5>Игры</h5>
                                                        <ul>
                                                            <li><a href="<?= Url::to(['site/index','cat_id' => 2]) ?>">PC</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>

                        </div>
                        <!--/.nav-collapse -->

                    </div>


                </nav>
                <!-- /#navbar -->

            </div>

            <!-- *** NAVBAR END *** -->

        </header>

        <div id="heading-breadcrumbs">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1><?= Html::encode($this->title) ?></h1>
                    </div>
                    <div class="col-md-5">
                        <form id="search-form" role="search" style="margin-top: 15px" action="<?= Url::to(['site/search']) ?>">
                            <div class="input-group">
                                <?/*
                                <input
                                    data-url="<?= Url::to(['site/search-typeahead']) ?>"
                                    id="search-input"
                                    type="text"
                                    class="form-control"
                                    placeholder="Search"
                                    name="q"
                                    value="<?= Yii::$app->request->get('q') ?>"
                                    autocomplete="off"
                                >*/?>
                                <?php $templ = '<p style="white-space: normal; padding-top: 5px; padding-bottom: 5px">{{value}}</p>'; ?>
                                <?= \kartik\widgets\Typeahead::widget([
                                    'name' => 'q',
                                    'options' => ['placeholder' => 'Search'],
                                    'dataset' => [
                                        [
                                            'datumTokenizer' => "Bloodhound.tokenizers.obj.whitespace('value')",
                                            'display' => 'value',
                                            'remote' => [
                                                'url' => Url::to(['site/search-typeahead']) . '?q=%QUERY',
                                                'wildcard' => '%QUERY'
                                            ],
                                            'templates' => [
                                                'suggestion' => new \yii\web\JsExpression("Handlebars.compile('{$templ}')"),
                                            ],
                                        ]
                                    ],
                                    'pluginOptions' => [
                                        'highlight' => true,
                                    ],
                                    'pluginEvents' => [
                                        'typeahead:select' => 'function(){ $("#search-form").submit(); }',
                                    ],
                                ]) ?>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-template-main"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">

            </div>
        </div>

        <div id="content">
            <?= $content ?>
        </div>
        <!-- /#content -->

        <!-- *** FOOTER ***
_________________________________________________________ -->
        <?/*

        <footer id="footer">
            <div class="container">

            </div>
            <!-- /.container -->
        </footer>
        <!-- /#footer -->

        <!-- *** FOOTER END *** -->*/?>

        <!-- *** COPYRIGHT ***
_________________________________________________________ -->

        <div id="copyright">
            <div class="container">
                <div class="col-md-12">
                    <?/*<p class="pull-left">&copy; <?= date('Y') ?>. Kurraz Soft</p> */?>
                    <p class="pull-right">Template by <a href="http://bootstrapious.com">Bootstrap 4 Themes</a> with support from <a href="http://kakusei.cz">Designové předměty</a>
                        <!-- Not removing these links is part of the licence conditions of the template. Thanks for understanding :) -->
                    </p>

                </div>
            </div>
        </div>
        <!-- /#copyright -->

        <!-- *** COPYRIGHT END *** -->

    </div>
    <!-- /#all -->

    <?php $this->endBody() ?>

    <!-- google analytics -->
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-90477473-1', 'auto');
      ga('send', 'pageview');

    </script>
    <!-- /google analytics -->
</body>

</html>
<?php $this->endPage() ?>