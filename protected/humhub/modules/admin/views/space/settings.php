<?php

use humhub\compat\CActiveForm;
use humhub\compat\CHtml;
use humhub\models\Setting;
use humhub\modules\space\models\Space;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
?>
<div class="panel panel-default">
    <div class="panel-heading"><?php echo Yii::t('AdminModule.views_space_settings', '<strong>Space</strong> Settings'); ?></div>
    <div class="panel-body">
        <ul class="nav nav-pills">
            <li><a
                    href="<?php echo Url::toRoute('index'); ?>"><?php echo Yii::t('AdminModule.views_space_index', 'Overview'); ?></a>
            </li>
            <li>
                <a href="<?php echo Url::toRoute('list-types'); ?>"><?php echo Yii::t('AdminModule.views_space_index', 'Types'); ?></a>
            </li>            
            <li class="active">
                <a href="<?php echo Url::toRoute('settings'); ?>"><?php echo Yii::t('AdminModule.views_space_index', 'Settings'); ?></a>
            </li>
        </ul>
        <p />

        <p>
            <?php echo Yii::t('AdminModule.views_space_index', 'Define here default settings for new spaces.'); ?>
        </p>

        <br />


        <?php $form = CActiveForm::begin(['id' => 'space-settings-form']); ?>

        <?php echo $form->errorSummary($model); ?>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'defaultJoinPolicy'); ?>
            <?php $joinPolicies = array(0 => Yii::t('SpaceModule.base', 'Only by invite'), 1 => Yii::t('SpaceModule.base', 'Invite and request'), 2 => Yii::t('SpaceModule.base', 'Everyone can enter')); ?>
            <?php echo $form->dropDownList($model, 'defaultJoinPolicy', $joinPolicies, array('class' => 'form-control', 'id' => 'join_policy_dropdown', 'hint' => Yii::t('SpaceModule.views_admin_edit', 'Choose the kind of membership you want to provide for this workspace.'))); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'defaultVisibility'); ?>
            <?php
            $visibilities = array(
                0 => Yii::t('SpaceModule.base', 'Private (Invisible)'),
                1 => Yii::t('SpaceModule.base', 'Public (Visible)')
                    /* 2 => Yii::t('SpaceModule.base', 'Visible for all') */
            );
            ?>
            <?php echo $form->dropDownList($model, 'defaultVisibility', $visibilities, array('class' => 'form-control', 'id' => 'join_visibility_dropdown', 'hint' => Yii::t('SpaceModule.views_admin_edit', 'Choose the security level for this workspace to define the visibleness.'))); ?>
            <?php echo $form->error($model, 'defaultVisibility'); ?>
        </div>
        <hr>

        <?php echo CHtml::submitButton(Yii::t('AdminModule.views_space_settings', 'Save'), array('class' => 'btn btn-primary')); ?>

        <?php \humhub\widgets\DataSaved::widget(); ?>
        <?php CActiveForm::end(); ?>

    </div>
</div>








