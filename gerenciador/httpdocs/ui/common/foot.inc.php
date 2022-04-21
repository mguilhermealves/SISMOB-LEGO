<script>
    <?php
    if (isset($_SESSION["action_js"])) {
        foreach ($_SESSION["action_js"] as $v) {
            print($v . "\n");
        }
        unset($_SESSION["action_js"]);
    }
    ?>
</script>
</body>

</html>