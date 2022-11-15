<?php

class TelegramCommunicator extends IncomingDataFormatter {

    public function getDataSource($data): DataSourceDefinerInterface {
        return new TelegramSource($data);
    }

}