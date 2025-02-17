<?php

function animalType($animal) {
    switch ($animal) {
        case "cat":
            return "./media/icons/cat-svgrepo-com.svg";
        case "rabbit":
            return "./media/icons/rabbit-svgrepo-com.svg";
        case "bird":
            return "./media/icons/bird-svgrepo-com.svg";
        default:
            return "./media/icons/dog-svgrepo-com.svg"; // A fallback icon if animal type is unknown
    }
}

?>
