<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
?>
<div class="top_nav">
    <div class="nav_menu">
        <nav class="" role="navigation">
            <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="">
                    <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                        <?= Html::img($user->getImage(),['alt' => Yii::t('app','User Avatar'), 'class' => 'img-circle'])?>
                        <?= $user->fio ?>
                        <span class=" fa fa-angle-down"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li>
                            <?= Html::a('<i class="fa fa-sign-out pull-right"></i> ' . Yii::t('app','Logout'), '/site/logout', $options = ['data-method' => 'post'])?>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>