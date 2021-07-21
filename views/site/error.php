<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error text-center" style="width:80%; margin:100px auto;">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>
    <hr>
    <div class="error-actions">                                
        <div class="row">
            <div class="col-md-6">
               <button class="btn btn-info btn-block " onClick="document.location.href = '/';"><?=Yii::t('app','Home')?><!-- Back to dashboard --></button>
            </div>
            <div class="col-md-6">
                <button class="btn btn-primary btn-block " onClick="history.back();"><?=Yii::t('app','Back')?><!-- Previous page --></button>
            </div>
        </div>                                                             
     </div>
</div>
