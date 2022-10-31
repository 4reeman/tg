<?php

abstract class Communication {
    abstract public function getCommunicator(): Hook;

    public function someOperations() {
        $product = $this->getCommunicator();
        $result = $product->getData();
        return $result;
    }
}