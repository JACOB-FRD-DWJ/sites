<?php

class Session_message_flash{

    public function set_flash($message, $type = 'danger'){
        $_SESSION['flash'] = array(
            'message' => $message,
            'type' => $type
        );
    }

    public function flash(){
        if(isset($_SESSION['flash'])){
            ?>
            <div id="alert" style="width: 50%; margin:auto;" class="alert alert-<?php echo $_SESSION['flash']['type']; ?>">
                <a href="" class="close">x</a>
                <?php echo $_SESSION['flash']['message']; ?>
            </div>
            <?php
            unset($_SESSION['flash']);
        }else{
            unset($_SESSION['flash']);
        }
    }

}
