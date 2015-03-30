<?php

trait ConnetionMethodsTrait {

    function auth($password) {
        //  password Authenticate to the server
    }

    function echo($message) {
        //  message Echo the given string
    }

    function ping() {
        //  Ping the server
    }

    function quit() {
        //  Close the connection
    }

    function select($index) {
        //  index Change the selected database for the current connection
    }


}