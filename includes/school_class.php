
<?php


    class School {
        public $school_name;
        public $cert_num;
        public $user_id;
        
        function set_cert_num($cert_num) {
            $this->cert_num = $cert_num;
        }
        
        function set_school_name($school_name) {
            $this->school_name = $school_name;
        }
        
    }

?>