<h2><?php echo __('Owl Carousel','owlcarousel') ?></h2>
<br />
<?php if(Notification::get('success')) Alert::success(Notification::get('success')); ?>
<?php 
    echo(
        Html::anchor(__('Create New Item','owlcarousel'),'index.php?id=owlcarousel&action=add_item',array('title' => __('Create New Item','owlcarousel'), 'class' => 'btn default btn-small')).Html::nbsp(3)
    )
?>
<br />
<br />

<table class="table table-bordered">
    <thead>
        <th><?php echo __('Group','owlcarousel') ?></th>
        <th><?php echo __('Order','owlcarousel') ?></th>
        <th></th>
    </thead>
    <tbody>
        <?php foreach ($item_hash as $group => $item){ ?>
            <tr>
                <td><?= $group ?></td>
                <td><?= $item ?></td>
                <td>EDIT</td>
            </tr>
        <? } ?>
    </tbody>
</table>
