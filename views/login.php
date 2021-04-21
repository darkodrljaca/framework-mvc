<?php 

/** @var $model User */

?>
<h1>Login</h1>

<?php $form = \app\machina\form\Form::begin('', "post"); ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'password')->passwordField() ?>    
    <button type="submit" class="btn btn-primary">Submit</button>
<?php echo \app\machina\form\Form::end(); ?>


