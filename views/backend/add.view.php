<h2><?= __('New Item','owlcarousel') ?></h2>
<br />
<?php if (Notification::get('success')) Alert::success(Notification::get('success')); ?>
<?php
    if (isset($errors['item_exists'])) echo '&nbsp;&nbsp;&nbsp;<span style="color:red">'.$errors['blocks_exists'].'</span>';
?>
<?php echo (Form::open()); ?>
<?php echo (Form::hidden('csrf', Security::token())); ?>

<?php echo (Form::label('group', __('Group', 'owlcarousel'))); ?>
<?php echo (Form::input('group', $name, array(
        'placeholder' => 'default'
    ))); ?>
<?php echo (Form::label('order', __('Order', 'owlcarousel'))); ?>
<?php echo (Form::input('order', $name, array(
      'placeholder' => '0'
          ))); ?>
<br /><br />
<?php
    Action::run('admin_editor', array(Html::toText($content)));

    echo (
        Html::br().
            Form::submit('add_item_and_exit', __('Save and Exit', 'blocks'), array('class' => 'btn')).Html::nbsp(2).
            Form::submit('add_item', __('Save', 'blocks'), array('class' => 'btn')).
            Form::close()
    );
?>
