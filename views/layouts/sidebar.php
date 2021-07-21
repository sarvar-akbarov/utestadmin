<?php
use yii\helpers\Html;
?>
<div class="col-md-3 left_col">

    <div class="left_col scroll-view">

        <div class="navbar nav_title" style="border: 0;">
            <a href="/" class="site_title"><i class="fa fa-graduation-cap"></i> <span><?=\Yii::$app->name?></span></a>
        </div>
        <div class="clearfix"></div>

        <!-- menu prile quick info -->
        <div class="profile">
            <div class="profile_pic">
                <?= Html::img($user->getImage(),['alt' => Yii::t('app','User Avatar'), 'class' => 'img-circle profile_img'])?>
            </div>
            <div class="profile_info">
                <span><?=Yii::t('app','Xush kelibsiz')?>,</span>
                <h2><?= $user->fio?></h2>
            </div>
        </div>
        <div class="clearfix"></div>

        <!-- /menu prile quick info -->

        <br />

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3><?= \app\models\Users::getPermission()[$user->permission]?></h3>
                <?=$this->render('right-menu',[
                    'user' => $user
                ])?>
            </div>
        </div>
        <!-- /sidebar menu -->
    </div>
</div>