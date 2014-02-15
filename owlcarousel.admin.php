<?php

Navigation::add(__('Owl Carousel','owlcarousel'),'content','owlcarousel',4);


class OwlCarouselAdmin extends Backend
{
    public static function main()
    {
        $owlcarousel_path = STORAGE . DS . 'owlcarousel' . DS;
        $items_list = array();
        $errors = array();

        if(Request::get('action')){
            switch(Request::get('action')){
                case "add_item":
                    
                    if(Request::post('add_item') ||  Request::post('add_item_and_exit')){
                        if(Security::check(Request::post('csrf'))){
                            if(trim(Request::post('order')) == '') 
                                $errors['item_empty_order'] = __('Required field', 'owlcarousel');
                            
                            $group = (trim(Request::post('group')) == ''?'default':Security::safeName(trim(Request::post('group'))));
                            $order = Security::safeName(trim(Request::post('order')));
                            $item_path = $owlcarousel_path.$group.DS.$order.'.owlitem.html';

                            if(file_exists($item_path)) 
                                $errors['item_exists'] = __('This item exists', 'owlcarousel');
                            
                            if (count($errors) == 0){
                                File::setContent($item_path,XML::safe(Request::post('editor')));
                                Notification::set('success', __('The item has been added.', 'owlcarousel'));
                                if (Request::post('add_item_and_exit')){
                                    Request::redirect('index.php?id=owlcarousel');
                                }else{
                                    Request::redirect('index.php?id=owlcarousel&action=edit_item&group='.$group.'&order='.$order);
                                }
                            }

                        }else{
                            die('Request was denied because it contained an invalid security token. Please refresh the page and try again.');
                        }
                    }
                    if (Request::post('order')) $order = Request::post('order'); else $order = '';
                    if (Request::post('group')) $group = Request::post('group'); else $group = 'default';
                    if (Request::post('editor')) $content = Request::post('editor'); else $content = '';

                    View::factory('owlcarousel/views/backend/add')
                        ->assign('content', $content)
                        ->assign('order', $order)
                        ->assign('group', $group)
                        ->assign('errors', $errors)
                        ->display();
                break;

                case "edit_item":
                    if (Request::post('edit_item') || Request::post('edit_item_and_exit') ){
                        if (Security::check(Request::post('csrf'))) {
                            if(trim(Request::post('order')) == '')
                                $errors['item_empty_order'] = __('Required field', 'owlcarousel');

                            $new_order = Security::safeName(trim(Request::post('order')));
                            $old_order = Security::safeName(trim(Request::post('old_item_order')));
                            $new_group = (trim(Request::post('group')) == ''?'default':Security::safeName(trim(Request::post('group'))));
                            $old_group = (trim(Request::post('old_item_group')) == ''?'default':Security::safeName(trim(Request::post('old_item_group'))));
                            $new_item_path = $owlcarousel_path.$new_group.DS.$new_order.'.owlitem.html';
                            $old_item_path = $owlcarousel_path.$old_group.DS.$old_order.'.owlitem.html';

                            if(file_exists($new_item_path) and $new_item_path !== $old_item_path)
                                $errors['item_exists'] = __('This item exists', 'owlcarousel');

                            if (count($errors) == 0){
                                if ($new_item_path !== $old_item_path and !empty($old_item_path))
                                    rename($old_item_path,$new_item_path);
                                File::setContent($new_item_path,XML::safe(Request::post('editor')));
                                Notification::set('success', __('The item has been edited.', 'owlcarousel'));

                                if (Request::post('edit_item_and_exit')){
                                    Request::redirect('index.php?id=owlcarousel');
                                }else{
                                    Request::redirect('index.php?id=owlcarousel&action=edit_item&group='.$group.'&order='.$order);
                                }
                            }
                        }else{
                            die('Request was denied because it contained an invalid security token. Please refresh the page and try again.');
                        }
                    }
                    if (Request::post('order')) $order = Request::post('order'); else $order = '';
                    if (Request::post('group')) $group = Request::post('group'); else $group = 'default';
                    if (Request::post('editor')) $content = Request::post('editor'); else $content = File::getContent($new_item_path);

                    View::factory('owlcarousel/views/backend/edit')
                        ->assign('content', $content)
                        ->assign('order', $order)
                        ->assign('group', $group)
                        ->assign('errors', $errors)
                        ->display();
                break;
                case "delete_item":
                    if (Security::check(Request::get('token'))) {
                        $group = (trim(Request::post('group')) == ''?'default':Security::safeName(trim(Request::post('group'))));
                        $order = Security::safeName(trim(Request::post('order')));
                        $item_path = $owlcarousel_path.$group.DS.$order.'.owlitem.html';
                        File::delete($item_path);
                        Notification::set('success',__('The item has been removed.', 'owlcarousel'));
                        Request::redirect('index.php?id=owlcarousel');
                    }else{
                        die('Request was denied because it contained an invalid security token. Please refresh the page and try again.');
                    }
                break;
            }
        }else{
            $group_list = File::scan($owlcarousel_path);
            $item_hash = array();
            foreach($group_list as $group){
                $item_hash[$group] = File::scan($owlcarousel_path.DS.$group,'.owlitem.html');
            }
            unset($group);
            View::factory('owlcarousel/views/backend/index')
                ->assign('group_list',$group_list)
                ->assign('item_hash',$item_hash)
                ->display();
        }
    }
}

?>
