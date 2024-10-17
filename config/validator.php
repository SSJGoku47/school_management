<?php

class Validate {

    public function notEmpty($value) {
        return !empty(trim($value));
    }

    public function email($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function numeric($value) {
        return is_numeric($value);
    }

    public function regex($value, $pattern) {
        return preg_match($pattern, $value);
    }

    public function match($value1, $value2) {
        return $value1 === $value2;
    }

}

?>
