<?php $title = "Billet simple pour l'Alaska"; ?>

<?php ob_start(); ?>
<div class="d-flex flex-column container-fluid ">
    <h6 class="align-self-center text-center">Le commentaire a été signaler à l'administrateur du site, il agira en conséquence, veuiller retourner à l'<a href="/">Accueil</a></h6>
    <div class="w-25 align-self-center"><img src="public/images/validation.png" alt="Signalement de commentaire"></div>

</div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>