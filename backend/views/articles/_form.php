<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
/*use mihaildev\ckeditor\CKEditor;
use mihaildev\elfinder\ElFinder;
use mihaildev\elfinder\InputFile;*/
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\Articles */
/* @var $form yii\widgets\ActiveForm */
?>

    <div class="blog-articles-form">

        <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'mb-2 mr-2 btn btn-light btn-block btn-lg']) ?>
        </div>

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'id_category')->widget(Select2::classname(), [
            'data' => $items_categories,
            'language' => 'en',
            'options' => [
                'placeholder' => 'Select a category ...',
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],
        ]) ?>

        <?php /*= $form->field($model, 'tags')->widget(Select2::classname(), [
            'value' => ['1'],
            'data' => $items_tags,
            'language' => 'en',
            'options' => [
                'placeholder' => 'Select a tags ...',
                'multiple' => true,
            ],
            'pluginOptions' => [
                'allowClear' => true,
                'tags' => true,
                'tokenSeparators' => [',', ' '],
                'maximumInputLength' => 25
            ],
        ]) */?>

        <?= $form->field($model, 'alias', ['template' => "{label}\n{hint}\n<div class='input-group'>{input}<div class='input-group-append'><button id='generate-alias' type='button' class='btn btn-light'>Generate alias</button></div></div>\n{error}"])->textInput(['maxlength' => true]) ?>

        <?php /*= $form->field($model, 'image')->widget(InputFile::className(), [
            'language'      => 'ru',
            'controller'    => 'elfinder', // вставляем название контроллера, по умолчанию равен elfinder
            'path' => 'image', // будет открыта папка из настроек контроллера с добавлением указанной под деритории
            'filter'        => 'image',    // фильтр файлов, можно задать массив фильтров https://github.com/Studio-42/elFinder/wiki/Client-configuration-options#wiki-onlyMimes
            'template'      => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
            'options'       => ['class' => 'form-control'],
            'buttonOptions' => ['class' => 'btn btn-default'],
            'multiple'      => false       // возможность выбора нескольких файлов
        ]) */?>

        <?= $form->field($model, 'text') ?>

        <?php /*= $form->field($model, 'text')->widget(CKEditor::className(),[
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
                'preset' => 'standard', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'height' => '600px'
            ]),
        ]) */?>

        <?php /*= $form->field($model, 'excerpt')->widget(CKEditor::className(),[
            'editorOptions' => ElFinder::ckeditorOptions('elfinder',[
                'preset' => 'basic', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                'height' => '300px'
            ]),
        ]) */?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'mb-2 mr-2 btn btn-light btn-block btn-lg']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

<?php
$script =  <<< JS
    $('#generate-alias').on( 'click', function( event ){
        title = document.getElementById('articles-title').value;
        $.ajax({
            url         : generate_alias,
            type        : 'POST',
            data        : {
                url:  title,
                article:  article,
            },
            success: function (data) {
                console.log(data);
                document.getElementById('articles-alias').value = data;
            }    
        });    
    });
JS;
$this->registerJsVar('generate_alias',  Url::toRoute('/articles/generate-alias', true));
$this->registerJsVar('article',  $model->id);
$this->registerJs($script);
?>