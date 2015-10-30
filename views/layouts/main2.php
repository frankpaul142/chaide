<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\web\View;
use yii\helpers\Url;
use app\models\Line;
use app\models\City;
/* @var $this \yii\web\View */
/* @var $content string */
$lines= Line::find()->where(['status'=>'ACTIVE'])->all();
$cities=City::find()->all();
$script='$(document).ready(function() {
$("#menu-chaide").click(function(){
        $(this).toggleClass("active");
        $("#menu-mobile").toggleClass("menu-active");
        $("#general").toggleClass("general-active");
    });  
});';
$this->registerJs($script,View::POS_END);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
<div id="general">
<!-- MENU CHAIDE -->
<div class="header-int">
    <header>
        <nav>
            <ul>
                 <li class="m-menu"><a href="<?= Url::to(['site/asesor']) ?>" class="hvr-bounce-to-top">ASESOR DE COMPRAS</a></li>
                                <li class="m-menu"><a href="<?= Url::to(['line/index']) ?>" class="hvr-bounce-to-top">PRODUCTOS</a>
                    <!-- -->
                    <ul id="submenu-chaide">
                        <?php foreach($lines as $line): ?>
                        <li>
                            <a href="#" class="hvr-bounce-to-top"><?= mb_strtoupper($line->description) ?></a>
                            <ul id="productos-submenu">
                                <?php foreach($line->products as $k => $product): ?>
                                    <li><a href="<?= Url::to(['product/view','id'=>$product->id,'#'=>strtoupper($product->title)]) ?>"><?= $product->title ?></a></li>
                                <?php endforeach; ?>
                                <!--<li><a href="<?= Url::to(['line/view','id'=>$line->id,'#'=>strtoupper($line->description)]) ?>" class="btn-vermas-m">Ver más +</a></li>-->
                            </ul>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                    <!-- -->
                </li>
                <li class="m-menu"><a href="<?= Url::to(['locale/index']) ?>" class="hvr-bounce-to-top">LOCALES</a></li>
                <li><a href="<?= Url::home() ?>"><img src="<?= URL::base() ?>/images/logo-chaide.svg" alt="logotipo chaide"/></a></li>
                <li class="m-menu"><a href="<?= Url::to(['article/index']) ?>" class="hvr-bounce-to-top">NOTICIAS</a></li>
                <li class="m-menu"><a href="#" class="hvr-bounce-to-top">INNOVACIÓN</a></li>
                <?php if(Yii::$app->user->isGuest){ ?>
                <li class="m-menu"><a href="<?= Url::to(['user/create']) ?>" class="hvr-bounce-to-top"><img src="<?= URL::base() ?>/images/ico-compras.svg"/> COMPRAS</a></li>
                <?php }else{ ?>
                 <li class="m-menu menu-imagen"><a href="<?= Url::to(['user/index']) ?>" class="hvr-bounce-to-top"><img src="<?= URL::base() ?>/images/ico-compras.svg"/> COMPRAS</a></li>
                <?php } ?>
            </ul>
            <div id="barra-mobile">
                <a id="menu-chaide"><span></span></a>
            </div>
        </nav>
    </header>
</div>
            <?= $content ?>

<footer>
    <div class="cont-footer">
        <div class="secc-footer">
            <h1>COMPRA</h1>
            <h2>NUESTROS PRODUCTOS</h2>  
            <ul>
                <?php foreach($lines as $line): ?>
                <li><a href="<?= Url::to(['line/view','id'=>$line->id,'#'=>strtoupper($line->description)]) ?>"><?= mb_strtoupper($line->description) ?></a></li>
                <?php endforeach; ?>
            </ul>  
        </div>
        <div class="secc-footer">
            <h1>VISITA</h1>
            <h2>NUESTROS LOCALES</h2> 
            <div class="footer-con2">
                <?php foreach($cities as $city): ?>
                <h2><?= mb_strtoupper($city->description) ?></h2>
                <ul>
                    <?php foreach($city->locales as $locale): ?>
                    <li><a href="#"><?= $locale->address ?></a></li>
                    <?php endforeach; ?>               
                </ul>
                <?php break; 
                endforeach; ?>
            </div>
            <div class="footer-con2">
                <?php foreach($cities as $z => $city): if($z==0) continue; ?>
                <h2><?= mb_strtoupper($city->description) ?></h2>
                <ul>
                    <?php foreach($city->locales as $locale): ?>
                    <li><a href="<?= Url::to(['locale/index']) ?>"><?= $locale->address ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
            </div>   
        </div>
        <div class="secc-footer">
            <h1>CONOCE</h1>
            <h2>SERVICIOS ON-LINE</h2> 
            <ul>
                <li><a href="#">Faq's</a></li>
                <li><a href="#">Trabaja con Nosotros</a></li>
                <li><a href="#">B2B</a></li>
                <li><a href="#">Intranet</a></li>
                <li><a href="#">Proveedores</a></li>
            </ul>
            <h1 class="h1-footer">NOSOTROS</h1> 
            <ul class="n-footer">
               <li><a href="<?= Url::to(['site/about']) ?>">La Empresa</a></li>
            </ul>  
            
        </div>
    </div>
    <div class="footer-cierre">
        <ul>
            <li><a href="https://www.facebook.com/Chaide-y-Chaide-152254991498995/?ref=ts"><img src="<?= URL::base() ?>/images/ico-facebook.svg" alt="facebook"/></a></li>
          <!--   <li><img src="<?= URL::base() ?>/images/ico-twitter.svg" alt="twitter"/></li> -->
            <li><a href="https://www.youtube.com/user/ChaideyChaide"><img src="<?= URL::base() ?>/images/ico-youtube.svg" alt="youtube"/></a></li>
        </ul>
        ® 2015 CHAIDE, Todos los Derechos Reservados.   Desarrollado por <a href="http://share.com.ec/" target="_blank">SHARE DIGITAL AGENCY.</a>  
    </div>
</footer>
<!-- -->
</div>
<div id="asesor-compra">
	<!--<img src="<?= URL::base() ?>/images/asesor-compra.png"/>-->
	<ul>
    	<li><a href="#" id="b-contacto"><img src="<?= URL::base() ?>/images/ico-contacto.svg"/></a></li>
        <li><a href="https://www.facebook.com/ChaideOficial?fref=ts" target="_blank"  id="b-facebook"><img src="<?= URL::base() ?>/images/ico-facebook2.svg"/></a></li>
        <li><a href="#"  id="b-twitter"><img src="<?= URL::base() ?>/images/ico-twitter2.svg"/></a></li>
        <li><a href="#"  id="b-youtube"><img src="<?= URL::base() ?>/images/ico-youtube2.svg"/></a></li>
    </ul>
</div>
<!-- menu mobile -->
<div id="menu-mobile">
    <ul>
       <li><a href="#">ASESOR DE COMPRA</a></li>
        <li><a href="<?= Url::to(['product/index']) ?>">PRODUCTOS</a></li>
        <li><a href="<?= Url::to(['site/about']) ?>">NOSOTROS</a></li>
        <li><a href="<?= Url::to(['news/index']) ?>">NOTICIAS</a></li>
        <li><a href="<?= Url::to(['locale/index']) ?>">LOCALES</a></li>
        <li><a href="#">INNOVACIÓN</a></li>
        <li><a href="registro.html">COMPRAS</a></li>
   </ul>
</div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>