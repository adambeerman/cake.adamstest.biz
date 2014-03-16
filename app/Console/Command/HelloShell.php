<?php
/**
 * Created by JetBrains PhpStorm.
 * User: adam
 * Date: 3/11/14
 * Time: 11:13 AM
 * To change this template use File | Settings | File Templates.
 */

class HelloShell extends AppShell {
    public function main() {
        $this->out('Hello world.');
    }

    public function hey_there() {
        $this->out('Hey there ' . $this->args[0]);
    }
}