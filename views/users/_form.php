<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Users;
/* @var $this yii\web\View */
/* @var $model app\models\Users */
/* @var $form yii\widgets\ActiveForm */
$model->avatar != null ? $path = '/'.$model->avatar : $path = '/images/user.png';
?>

<div class="users-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4" style = 'text-align:center;'>
            <div id="polls">
                <?= Html::img($path, [
                    'style' => 'width:100%;',
                ]) ?>
            </div>
            <br>
            <label for="users-file" style="cursor:pointer;" title="Измененить аватар" data-toggle = 'tooltip'>
                <i class="fa fa-pencil btn btn-default" ></i> Измененить
            </label>
            <?= $form->field($model, 'file', ['inputOptions' =>['value' => $model->file]])->fileInput(['accept' => 'image/*', 'class' => "poster_image", 'style' => 'display:none;'])->label(false); ?>
        </div>
        <div class="col-md-8">
            <h2>
                    Shaxsiy ma'lumotlar
            </h2>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'fio')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'phone')->widget(\yii\widgets\MaskedInput::className(), [
                            'mask' => "+\9\98##-###-##-##",
                            'options' => ['placeholder' => '+99800-000-00-00','class'=>'form-control']
                    ]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'new_password')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($model, 'status')->dropDownList(getStatus()) ?>
                </div>
                <div class="col-md-6">
                    <?= $form->field($model, 'permission')->dropDownList(Users::getPermission()) ?>
                </div>
            </div>
        </div>
    </div>
  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
<?php
$this->registerJs(<<<JS
    var fileCollection = new Array();
    $(document).on('change', '.poster_image', function(e){
        var files = e.target.files;
        $.each(files, function(i, file){
            fileCollection.push(file);
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(e){
                var template = '<img style="width:100%;" src="'+e.target.result+'"> ';
                $('#polls').html('');
                $('#polls').append(template);
            };
        });
    });
JS
);
?>