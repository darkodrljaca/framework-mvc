<?php
/** @var $this \app\machina\View  */
/** @var $model \app\models\ContactForm  */

use app\machina\form\Form;
use app\machina\form\TextareaField;

$this->title = 'Contact';

?>

<h1>Contact</h1>

<?php $form = Form::begin('/contact', 'post'); ?>
<?= $form->field($model, 'subject') ?>
<?= $form->field($model, 'email') ?>
<?= new TextareaField($model, 'body') ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>

