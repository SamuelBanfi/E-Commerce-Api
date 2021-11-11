<?php
    function setClass($id, $district) {
        switch ($id) {
            case 0:
                echo "<div class='offer-container bee-family $district'>";       
                break;
            case 1:
                echo "<div class='offer-container core-of-bees $district'>";
                break;
            case 2:
                echo "<div class='offer-container queen-bees $district'>";
                break;
            default:
                echo "<div class='offer-container bee-family $district'>";
                break;
        }
    }

    function createInsertion($product_id, $district, $image, $name, $description) {
        setClass($product_id, $district);

        echo "<div class='image-container'>";
        echo "<img src='$image' alt='$name'></div>";
        echo "<div class='description-container'>";
        echo "<h3>$name</h3>";
        echo "<p>$description</p></div></div>";
    }
?>