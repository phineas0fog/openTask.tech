<?php if (isset($_SESSION['error'])): ?>

    <link rel="stylesheet" href="<?php echo $root ?>/public/css/error.css">

    <div id="dom-target" style="display: none;">
        <?php echo htmlspecialchars($_SESSION['error']); ?>
    </div>

    <div class='errorNotifContainer'>
        <div class='errorNotif'>
            <div class="closebtn" onclick="this.parentElement.classList.add('hidden')">&times;</div>
            <?php echo htmlspecialchars($_SESSION['error']); ?>
        </div>
    </div>


    <script type="text/javascript">
    var div = document.getElementById("dom-target");
    var data = div.textContent;
    notify(data);
    </script>
<?php endif;
unset($_SESSION['error']) ;
