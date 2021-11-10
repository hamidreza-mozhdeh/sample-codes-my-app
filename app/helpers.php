<?php

function arrayForgetValue(array &$array, ...$parameters) {
    foreach ($parameters as $value) {
        unset($array[array_search($value, $array)]);
    }
}
