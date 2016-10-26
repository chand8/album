<?php

namespace Practice\Service;

use Practice\Gateway\PracticeGateway;

class PracticeService implements PracticeServiceInterface {

    protected $gateway;

    public function __construct(PracticeGateway $gateway) {
        $this->gateway = $gateway;
    }

    public function fetchOne($id) {
        return $this->gateway->fetch($id);
    }

    public function fetchAll() {
        return $this->gateway->fetchAll($id);
    }

}
