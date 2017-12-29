

<link rel="stylesheet" href="<?php echo $root ?>/public/css/cookieDisclaimer.css">

<?php if(!isset($_SESSION)): ?>
<div class='cookieDis'>
    <div class="closebtn" onclick="this.parentElement.classList.toggle('hidden')">&times;</div>
        Ce site utilise des cookies pour vous permettre de vous connecter et de garder la session ouverte. Un autre cookie sera aussi placé pour vous permettre de ne pas avoir à fermer ce message plusieurs fois. Ces cookies resteront présent pendant 24 heures sur votre ordinateur.
</div>
<?php endif;
