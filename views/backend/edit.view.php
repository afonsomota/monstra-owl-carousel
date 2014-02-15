<h2><?php echo __('Edit Item', 'owlcarousel'); ?></h2>
<br />

<?php if (Notification::get('success')) Alert::success(Notification::get('success')); ?>

<?php
    if ($content !== null) {

        if (isset($errors['item_exists'])) $error_class = 'error'; else $error_class = '';

        echo (Form::open());

        echo (Form::hidden('csrf', Security::token()));

        echo (Form::hidden('old_item_order', Request::get('order')));
        echo (Form::hidden('old_item_group', Request::get('group')));

?>

<?php echo (Form::label('group', __('Group', 'owlcarousel'))); ?>
<?php echo (Form::input('group', $group, array(
        'placeholder' => 'default'
    ))); ?>
<?php echo (Form::label('order', __('Order', 'owlcarousel'))); ?>
<?php echo (Form::input('order', $order, array(
      'placeholder' => '0'
          ))); ?>

<br /><br />
<?php

        Action::run('admin_editor', array(Html::toText($content)));

        echo (
           Html::br().
           Form::submit('edit_item_and_exit', __('Save and Exit', 'owlcarousel'), array('class' => 'btn default')).Html::nbsp(2).
           Form::submit('edit_item', __('Save', 'owlcarousel'), array('class' => 'btn default')). Html::nbsp().
           Form::close()
        );

    } else {
        echo '<div class="message-error">'.__('This item does not exist.', 'owlcarousel').'</div>';
    }
?>