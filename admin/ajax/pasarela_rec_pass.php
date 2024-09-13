<?php
if(!empty($_GET['token']))
{
    echo $_GET['token'];
    ?>
    <script language="JavaScript">
        window.onload = function() 
        {
            document.getElementById("uno").submit();
        };
    </script>
    <form method="POST" action="../index.php" id="uno">
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">
    </form>
    <?php
}
?>