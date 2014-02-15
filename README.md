monstra-owl-carousel
====================

Owl Carousel Plugin for Monstra CMS

* Offers a backoffice menu where you can add items to add to your owl carousel. 
* You can specify a group so you can have different carousels associated with different sets of items

<h2>How to use on template:</h2>

```
<?php echo OwlCarousel::_renderItems(array(),"{items : 1}"); ?>
```
Uses default class and all groups

```
<?php echo OwlCarousel::_renderItems(array("class" => "owl-example"),"{items : 5,autoPlay : false}"); ?>
```
Sets a class associated to the owl carousel object

```
<?php echo OwlCarousel::_renderItems(array("class" => "owl-example", "group" => "landing"),"{items : 2}"); ?>
```
Only loads group: "landing"

Second argument refers to owl carousel options: http://owlgraphic.com/owlcarousel/#customizing


<h2>And after loading jQuery:</h2>

```
<?php echo OwlCarousel::_renderScript(array("class" => "owl-example")); ?>
```
or
```
<?php echo OwlCarousel::_renderScript(); ?>
```
if you want to associate to a default class.
