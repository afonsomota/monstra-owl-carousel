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
        <?php foreach ($item_hash as $group => $items){ ?>
            <?php foreach($items as $item){ ?>
                <tr>
                    <td><?= $group ?></td>
                    <td><?= $item ?></td>
                    <td>
                        <div class="pull-right">
                            <div class="btn-toolbar">
                                <div class="btn-group">
                                    <?php echo Html::anchor(__('Edit', 'owlcarousel'), 
                                        'index.php?id=owlcarousel&action=edit_item&group='.$group.'&order='.$item, 
                                        array('class' => 'btn btn-actions btn-small')); ?>
                                    <?php echo Html::anchor(__('Delete', 'owlcarousel'),
                                        'index.php?id=owlcarousel&action=delete_item&group='.$group.'&order='.$item.'&token='.Security::token(),
                                        array('class' => 'btn btn-actions btn-small btn-actions-default', 
                                        'onclick' => "return confirmDelete('".__('Delete item', 'owlcarousel')."')"));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            <? } ?>
        <? } ?>
    </tbody>
</table>
