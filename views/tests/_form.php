<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use wbraganca\dynamicform\DynamicFormWidget;
use app\models\Categories;

/* @var $this yii\web\View */
/* @var $modelTest app\models\Tests */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tests-form">

    <?php $form = ActiveForm::begin([
        'id' => 'test-dynamic-form',
        'options' => [
            'enctype' => 'multipart/form-data'
            ]
        ]); ?>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <?=$form->field($modelTest, 'category_id')->widget(Select2::classname(), [
                'data' => Categories::list(),
                'options' => ['placeholder' => 'Select a state ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);?>
        </div>
        <div class="col-md-3 col-sm-12">
            <?= $form->field($modelTest, 'is_premium')->dropDownList(getYesOrNot()) ?>
        </div>
        <div class="col-md-3 col-sm-12">
            <?= $form->field($modelTest, 'has_gift')->dropDownList(getYesOrNot()) ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($modelTest, 'name')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($modelTest, 'description')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <?php 
                if($modelTest->images){
                    $imgs = explode(',', $modelTest->images);
                    foreach($imgs as $image){
                        echo "<img src='/".$image."' width='30%'/>";
                    }
                }
            ?>
            <?= $form->field($modelTest, 'images_file[]')->fileInput(['accept' => 'image/*', 'multiple' => true ]) ?>
        </div>
        <div class="col-md-6">
            <?php 
                if($modelTest->main_file){
                    echo "<a href='/".$modelTest->main_file."' download>Yuklab olish</a>";
                }
            ?>
            <?= $form->field($modelTest, 'main_file_file')->fileInput(['maxlength' => true, 'accept' => ".pdf,.doc,.docx"]) ?>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-md-6">
            <?php 
                if($modelTest->analyse){
                    echo "<a href='/".$modelTest->analyse."' download>Yuklab olish</a>";
                }
            ?>
            <?= $form->field($modelTest, 'analyse_file')->fileInput(['maxlength' => true]) ?>
        </div>
    </div>
    
    <hr>
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 5, // the maximum times, an element can be added (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsTestItem[0],
        'formId' => 'test-dynamic-form',
        'formFields' => [
            'name',
            'count',
            'answers',
            'ball',
        ],
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>
                <i class="glyphicon glyphicon-envelope"></i> <?= Yii::t('app','Test Items')?>
                <button type="button" class="add-item btn btn-success btn-sm pull-right"><i class="glyphicon glyphicon-plus"></i> Add</button>
            </h4>
        </div>
        <div class="panel-body">
            <div class="container-items"><!-- widgetBody -->
            <?php foreach ($modelsTestItem as $i => $modelTestItem): ?>
                <div class="item panel panel-default"><!-- widgetItem -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left"><?= Yii::t('app','Test Item')?></h3>
                        <div class="pull-right">
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelTestItem->isNewRecord) {
                                echo Html::activeHiddenInput($modelTestItem, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-4 col-md-4">
                                <?= $form->field($modelTestItem, "[{$i}]name")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <?= $form->field($modelTestItem, "[{$i}]count")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-4 col-md-4">
                                <?= $form->field($modelTestItem, "[{$i}]answers")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-2 col-md-2">
                                <?= $form->field($modelTestItem, "[{$i}]ball")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div><!-- .panel -->
    <?php DynamicFormWidget::end(); ?>
    <hr>
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($modelTest->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $modelTest->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
