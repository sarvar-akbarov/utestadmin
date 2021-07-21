<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use johnitvn\ajaxcrud\CrudAsset; 
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AboutCompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app','About Companies');
$this->params['breadcrumbs'][] = $this->title;
CrudAsset::register($this);
?>
<div class="language-index">
   <div id="ajaxCrudDatatable">
      <div id="crud-datatable-pjax" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000">
         <div class="kv-loader-overlay">
            <div class="kv-loader"></div>
         </div>
         <div id="crud-datatable" class="grid-view is-bs3 hide-resize" data-krajee-grid="kvGridInit_180b965e" data-krajee-ps="ps_crud_datatable_container">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <div class="pull-right"></div>
                  <h3 class="panel-title"><i class="glyphicon glyphicon-list"></i>  <?=$this->title?></h3>
                  <div class="clearfix"></div
                     >
               </div>
               <div class="kv-panel-before">
                  <div class="btn-toolbar kv-grid-toolbar toolbar-container pull-right">
                    <div class="btn-group">
                        <?=Html::a(Yii::t('app','Edit'), ['update', 'id' => 1], ['class' => 'btn btn-success']) ?> 
                    </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div id="crud-datatable-container" class="table-responsive kv-grid-container" style="padding:30px;">
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        [
                            'attribute' => 'logo',
                            'format' => 'raw',
                            'value' => function($model){
                                return $model->getLogo();
                            }
                        ],
                        'address:ntext',
                        'phone',
                        'email:email',
                    ],
                    ]) ?>
               </div>
               <div class="clearfix"></div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>

