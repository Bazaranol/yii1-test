<h1>Вход</h1>

<?php echo CHtml::beginForm(); ?>

<div>
    <?php echo CHtml::activeLabel($model, 'username'); ?><br>
    <?php echo CHtml::activeTextField($model, 'username'); ?>
</div>

<div>
    <?php echo CHtml::activeLabel($model, 'password'); ?><br>
    <?php echo CHtml::activePasswordField($model, 'password'); ?>
</div>

<div>
    <button type="submit">Войти</button>
</div>

<?php echo CHtml::endForm(); ?>