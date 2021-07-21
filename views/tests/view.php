<?php

use yii\widgets\DetailView;
use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $model app\models\Tests */

/* @var $this yii\web\View */
/* @var $model app\models\BlogCategory */
$this->title = Yii::t('app', 'View Test');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="blog-category-index">
   <div id="ajaxCrudDatatable">
      <div id="crud-datatable-pjax" data-pjax-container="" data-pjax-push-state="" data-pjax-timeout="1000">
         <div class="kv-loader-overlay">
            <div class="kv-loader"></div>
         </div>
         <div id="crud-datatable" class="grid-view is-bs3 hide-resize" data-krajee-grid="kvGridInit_180b965e" data-krajee-ps="ps_crud_datatable_container">
            <div class="panel panel-default">
               <div class="panel-heading">
                  <div class="pull-right">
                      <a href="/tests/update?id=<?=$model->id?>" class="btn btn-info"><?=Yii::t('app','Update')?></a>
                  </div>
                  <h3 class="panel-title"><i class="glyphicon glyphicon-list"></i>  <?= Html::encode($this->title) ?></h3>
                  <div class="clearfix"></div>
               </div>
               <div class="kv-panel-before">
                  <div class="btn-toolbar kv-grid-toolbar toolbar-container pull-right">
                    <div class="btn-group">
                        
                    </div>
                  </div>
                  <div class="clearfix"></div>
               </div>
               <div id="crud-datatable-container" class="table-responsive kv-grid-container" style="padding:30px;">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'name',
                            'description:ntext',
                            [
                                'attribute' => 'analyse',
                                'format' => 'html',
                                'value' => function($model){
                                    if($model->analyse){
                                        return "<a href='/".$model->analyse."' download>Yuklab olish</a>";
                                    }
                                }
                            ],
                            [
                                'attribute' => 'main_file',
                                'format' => 'html',
                                'value' => function($model){
                                    if($model->main_file){
                                        return "<a href='/".$model->main_file."' download>Yuklab olish</a>";
                                    }
                                }
                            ],
                            [
                                'attribute' => 'images',
                                'format' => 'html',
                                'value' => function($model){
                                    $imgs = explode(',', $model->images);
                                    $str = '';
                                    foreach($imgs as $image){
                                        $str .= "<img src='/".$image."' width='350px'/>";
                                    }
                                    return $str;
                                }
                            ],
                            [
                                'attribute'=>'category_id',
                                'value' => function($model){
                                    return $model->category->name;
                                }                            ],
                            [
                                'attribute'=>'user_id',
                                'value'=>function($model){
                                    return $model->user->fio;
                                }
                            ],
                        ],
                    ]) ?>
               </div>
               <div class="clearfix"></div>

            </div>
         </div>
      </div>
   </div>
</div>