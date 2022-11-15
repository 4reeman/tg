<?php

abstract class IncomingDataFormatter {

    abstract public function getDataSource($data): DataSourceDefinerInterface;

    private function getDecodedBody() {
        $http_body = file_get_contents("php://input");
        $data = json_decode($http_body,true, 25, JSON_OBJECT_AS_ARRAY);
        return $data;
    }

    public function sendMessage() {
        $incomingData = $this->getDecodedBody();
        $source = $this->getDataSource($incomingData);
        $source->sendMessage();
    }
}
