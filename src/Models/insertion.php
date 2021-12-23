<?php
    /**
     * This is a library used to instantiate an insertion.
     * Author: Samuel Banfi
     * Version: 23.12.2021
     */

    /**
     * This function set the class of the insertion based on product id, the district and the type.
     * @param id the product id
     * @param district the district id
     * @param type the type of the insertion
     */
    function setClass($id, $district, $type) {
        switch ($id) {
            case 0:
                echo "<div class='offer-container bee-family $district $type'>";       
                break;
            case 1:
                echo "<div class='offer-container core-of-bees $district $type'>";
                break;
            case 2:
                echo "<div class='offer-container queen-bees $district $type'>";
                break;
            default:
                echo "<div class='offer-container bee-family $district $type'>";
                break;
        }
    }

    /**
     * This function is used to instantiate an insertion.
     * @param product_id the product id
     * @param district the district id
     * @param type the type of the insertion
     * @param image the image used for preview of the product
     * @param name the title of the insertion
     * @param description the description of the insertion
     */
    function createInsertion($product_id, $district, $type, $image, $name, $description) {
        setClass($product_id, $district, $type);

        echo "<div class='image-container'>";
        echo "<img src='$image' alt='$name'></div>";
        echo "<div class='description-container'>";
        echo "<h3>$name</h3>";
        echo "<p>$description</p></div></div>";
    }
?>