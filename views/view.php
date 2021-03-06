<?php

/**
 * Image upload view.
 *
 * @var \yii\web\View $this
 * @var string $selector Widget ID selector
 * @var \yii\db\ActiveRecord $model
 * @var string $attribute
 * @var boolean $crop enable/disable crop
 * @var array $jcropSettings
 */

use yii\bootstrap\Button;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Json;
?>

<?php if ($crop): ?>
    <?php Modal::begin([
        'id' => $selector . '-modal',
        'closeButton' => ['onclick' => 'descroyJcrop("' . $selector . '-image");', 'id' => $selector . '-image-close'],
        'header' => '<h2>' . Yii::t('maxmirazh33/image', 'Crop image') . '</h2>',
        'footer' => Button::widget(['label' => 'ОК',
            'options' => [
                'class' => 'btn btn-primary',
                'onclick' => '$("#' . $selector . '-image-close").click(); return false;'
            ]
        ]),
    ]); ?>

    <img src="" id="<?= $selector ?>-image">

    <?php \yii\bootstrap\Modal::end(); ?>
<?php endif; ?>

<div id="<?= $selector ?>" class="form-group uploader">
    <?= Html::activeLabel($model, $attribute) ?>
    <div class="btn btn-default fullinput">
        <div class="uploader-browse" onclick='$("#<?= $selector ?>-input").click(); return false;'>
            <span class="glyphicon glyphicon-picture"></span>
                <span class="browse-text" id="test-text1">
                    <?= Yii::t('maxmirazh33\image', 'Select') ?>
                </span>
            <?= Html::activeFileInput(
                $model,
                $attribute,
                ['id' => $selector . '-input', 'onchange' => 'readFile(this, ' . $selector . ', ' . Json::encode($jcropSettings) . ', ' . $crop . ')']
            ) ?>
        </div>
    </div>
    <?= Html::activeHiddenInput($model, $attribute) ?>
    <?php if ($crop): ?>
        <?= Html::activeHiddenInput($model, 'image[x]') ?>
        <?= Html::activeHiddenInput($model, 'image[x2]') ?>
        <?= Html::activeHiddenInput($model, 'image[y]') ?>
        <?= Html::activeHiddenInput($model, 'image[y2]') ?>
    <?php endif; ?>
</div>
