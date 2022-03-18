

<div class="row">
    <?php 

foreach($tableau as $value){
    $dt_debut=date_create_from_format('Y-m-d H:i:s',
    $value->getDate());


?>
<article class="col-sm-10 maincontent"> 
    <header class="page-header">
        <h1 class="page-title"><?= $value->getTitre(); ?></h1>
    </header>
    <h3><?= $value->getTitre();?></h3>
    <?php
    if($value->getPhoto() !=""){
        $lien=URL."public/assets/images/".$value->getPhoto();?>
        <p><img src= "<?= $lien; ?>"class="img.pull-right" width="300"></p>;
<?php 
   }
   ?>
   <p><?= $value->getCommentaire() ?></p>
     <p> <?= $dt_debut->format('d/m/Y H:i:s') ?></p>
     <a href="<?=URL ?>article/delete/<?= $value->getId()?>">Supprimer</a>
     <a href="<?=URL ?>article/update/<?= $value->getId()?>">Modifier</a>

</article>
<?php
}
?>
</div>
