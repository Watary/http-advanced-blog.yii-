<?php
use yii\grid\GridView;
use yii\helpers\Html;
use backend\models\Categories;
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'formatter' => [
        'class' => '\yii\i18n\Formatter',
        'dateFormat' => 'MM/dd/yyyy',
        'datetimeFormat' => 'dd-MM-yyyy HH:mm:ss',
    ],
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        'title',
        [
            'attribute' => 'id_author',
            'label'=>'Author',
            'format' => 'raw',
            'value' => function($data){
                return $data->author->username;
            }
        ],
        [
            'attribute' => 'id_category',
            'label'=>'Category',
            'format' => 'raw',
            'value' => function($data){
                return Html::a($data->category->title, ['categories/view/'.$data->id]);
            }
        ],
        [
            'attribute' => 'status',
            'label'=>'Status',
            'format' => 'raw',
            'value' => function($data){
                if($data->status == Categories::STATUS_ACTIVE){
                    return 'Active';
                }else{
                    return 'Inactive';
                }
            }
        ],
        'created_at:datetime',
        'updated_at:datetime',

        [
            'label'=>'Actions',
            'format' => 'raw',
            'value' => function($data){
                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['articles/view/'.$data->id])
                    .' '.Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['articles/update/'.$data->id])
                    .' '.Html::a('<span class="glyphicon glyphicon-trash"></span>', ['articles/delete/'.$data->id], [
                        'title' => 'Delete',
                        'aria-label' => 'Delete',
                        'data-pjax' => '0',
                        'data-confirm' => 'Are you sure you want to delete this item?',
                        'data-method' => 'post']);
            }

        ],
    ],
]); ?>