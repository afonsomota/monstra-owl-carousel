
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



//Add JS
Javascript::add('plugins/owlcarousel/assets/js/owl.carousel.js');

//Add CSS
Stylesheet::add('plugins/owlcarousel/assets/css/owl.carousel.css', 'frontend');
Stylesheet::add('plugins/owlcarousel/assets/css/owl.theme.css', 'frontend');
Stylesheet::add('plugins/owlcarousel/assets/css/owl.transitions.css', 'frontend');

class OwlCarousel
{
    public static $items = array();

    public static function _renderItems()
    {
        
    }
}

?>
