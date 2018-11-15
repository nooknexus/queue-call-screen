<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="./assets/css/style.css">
    </head>
    <body>
        <div class="contrainer">
            <code><?= __FILE__ ?></code>
            <div class="barcode-input">
                <h1>โปรดสแกนบาร์โค้ด</h1>
                <form method="POST">
                    <input id='barcode' name="barcode" autocomplete="off" placeholder="รหัสบาร์โค้ด"/>
                </form>
            </div>

            <div class="queue-info">

                <?php
                if (!empty($_POST['barcode'])) {
                    $barcode = $_POST['barcode'];
                    echo "<p>VN = $barcode</p>";
                    //  database exceute  here.
                }
                ?>
            </div>

        </div>
        <audio id="beep" src="./assets/beep-07.wav" autostart="false" ></audio>

        <!--javascript section-->
        <script src="./assets/jquery/jquery-3.3.1.min.js"></script>
        <script>

            $(function () {
                //barcode prompt
                $('#barcode').focus();

                //play beep
                var sound = document.getElementById("beep");
                sound.play()

            });

        </script>
        <!--javascript section-->

    </body>
</html>

