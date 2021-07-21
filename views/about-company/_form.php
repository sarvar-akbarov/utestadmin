<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use katzz0\yandexmaps\Canvas as YandexMaps;
use katzz0\yandexmaps\Map;
use katzz0\yandexmaps\Point;
use katzz0\yandexmaps\objects\Placemark;
/* @var $this yii\web\View */
/* @var $model app\models\AboutCompany */
/* @var $form yii\widgets\ActiveForm */
$model->logo != null ? $path = '/'.$model->logo : $path = '/images/logo.png';

?>

<div class="about-company-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6 col-xs-6">
            <div id="polls">
                <?= Html::img($path, [
                    'style' => 'width:180px;',
                ]) ?>
            </div>
            <br>
            <label for="aboutcompany-file" style="cursor:pointer;" title="Измененить Логотип" data-toggle = 'tooltip'>
                <i class="fa fa-pencil btn btn-default" ></i> Измененить
            </label>
            <?= $form->field($model, 'file', ['inputOptions' =>['value' => $model->file]])->fileInput(['accept' => 'image/*', 'class' => "poster_image", 'style' => 'display:none;'])->label(false); ?>
        </div>
    </div>
    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'coor_x')->hiddenInput(['maxlength' => true])->label(false) ?>

    <?= $form->field($model, 'coor_y')->hiddenInput(['maxlength' => true])->label(false) ?>
    
    <br>
    <div class="row">
        <div class="col-md-12">
            <?= YandexMaps::widget([
                'htmlOptions' => [
                    'style' => 'height: 600px;',
                ],
                'map' => new Map('yandex_map', [
                    'center' => [$model->coor_x, $model->coor_y],
                    'zoom' => 13,
                    'controls' => [Map::CONTROL_ZOOM],
                    'behaviors' => [Map::BEHAVIOR_DRAG],
                    'type' => "yandex#map",
                ],

                [
                    'objects' => [new Placemark(new Point($model->coor_x, $model->coor_y), [], [
                        'draggable' => true,
                        'preset' => 'islands#dotIcon',
                        'iconColor' => '#2E9BB9',
                        'events' => [
                            'dragend' => 'js:function (e) {
                                $("#aboutcompany-coor_x").val(e.get(\'target\').geometry.getCoordinates()[0]);
                                $("#aboutcompany-coor_y").val(e.get(\'target\').geometry.getCoordinates()[1]);
                            }'
                        ]
                    ])]
                ])
            ]) ?>
        </div>
    </div>     
    <br>           
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton(Yii::t('app','Save'), ['class' => 'btn btn-success' ]) ?>
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
                var template = '<img style="width:180px;" src="'+e.target.result+'"> ';
                $('#polls').html('');
                $('#polls').append(template);
            };
        });
    });
JS
);
?>