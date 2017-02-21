<?php
$collectionTitle = strip_formatting(metadata('collection', array('Dublin Core', 'Title')));
?>

<?php echo head(array('title'=> $collectionTitle, 'bodyclass' => 'collections show')); ?>

<h1><?php echo $collectionTitle; ?></h1>

<?php echo all_element_texts('collection'); ?>

<div id="collection-items">
    <h2><?php echo link_to_items_browse(__('Browse Items in the %s Collection', $collectionTitle), array('collection' => metadata('collection', 'id'))); ?></h2>

<!-- Collection items display removed to encourage users to follow the link above, 
which directs to the better-designed items/show?collection=x page. --> 

</div><!-- end collection-items -->

<?php fire_plugin_hook('public_collections_show', array('view' => $this, 'collection' => $collection)); ?>

<?php echo foot(); ?>
