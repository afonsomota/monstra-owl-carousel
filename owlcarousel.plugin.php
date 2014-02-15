
<?php

//Register Plugin
Plugin::register(__FILE__,
    __('Owl Carousel','owlcarousel'),
    __('Owl Carousel plugin for Monstra','owlcarousel'),
    '0.0.1',
    'afonsomota',
    'https://github.com/afonsomota',
    'owlcarousel');

if (Session::exists('user_role') && in_array(Session::get('user_role'), array('admin', 'editor'))) {
    Plugin::admin('owlcarousel');
}

//Add Shortcodes
Shortcode::add('owlcaroucel', 'OwlCarousel::_renderItems');
Shortcode::add('owlcaroucelinit', 'OwlCarousel::_renderScript');

//Add JS
Javascript::add('plugins/owlcarousel/assets/js/owl.carousel.js');

//Add CSS
Stylesheet::add('plugins/owlcarousel/assets/css/owl.carousel.css', 'frontend');
Stylesheet::add('plugins/owlcarousel/assets/css/owl.theme.css', 'frontend');
Stylesheet::add('plugins/owlcarousel/assets/css/owl.transitions.css', 'frontend');

class OwlCarousel
{
    public static $class_options = array();

    public static function _renderItems($attributes, $content)
    {
        $class = "owl-carousel";
        if(isset($attributes['class'])) $class = $attributes['class']; 
        $html = "<div class=\"".$class."\">";
        $owlcarousel_path = STORAGE.DS.'owlcarousel'.DS;
        $item_hash = array();
        if(isset($attributes['group'])){
            $groups = array($attributes['group']);
        }else{
            $groups = OwlCarousel::getGroups();
        }
        foreach($groups as $group){
            $item_hash[$group] = File::scan($owlcarousel_path.$group,'.owlitem.html');
        }
        foreach($item_hash as $group=>$items){
            foreach($items as $item){
                $html = $html."\n<div>".File::getContent($owlcarousel_path.$group.DS.$item)."</div>\n";
            }
        }
        OwlCarousel::$class_options[$class] = $content;
        $html = $html."</div>";
        return Filter::apply('content',$html);
    }

    public static function _renderScript($attributes, $content)
    {
       $class = "owl-carousel";
       if(isset($attributes['class'])) $class = $attributes['class'];
       if(isset(OwlCarousel::$class_options[$class])){
           $html = "<script>$(\".".$class."\").owlCarousel(".OwlCarousel::$class_options[$class].");</script>";
       }else{
           $html = "";
       }
       return $html;
    }

    public static function getGroups()
    {
        $group_list = array();
        $owlcarousel_path = STORAGE . DS . 'owlcarousel' . DS;
        $dir = opendir($owlcarousel_path);
        while(false !== ($d = readdir($dir))){
            if($d != '.' and $d != '..' and is_dir($owlcarousel_path.$d)) $group_list[] = $d;
        }
        return $group_list;
    }
}

?>
