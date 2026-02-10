<?php
    // 消費税計算関数
    function get_price($price = 100){
        $result = round($price * 1.1);
        return $result;
    }


    ?>
    