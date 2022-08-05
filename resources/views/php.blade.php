<?php
 
    class Customer{
        public $id;
        private $name;
        protected $email;
        public $balance;

        public function __construct($id, $name, $email, $balance){
            $this ->id =$id;
            $this->name = $name;
            $this->email = $email;
            $this->balance = $balance;
        }

        
    }
    //$customer = new Customer(1, 'arif', 'arif@gmail.com', 20);

    class Subscriber extends Customer{
        public $plan;

        public function __construct($id, $name, $email, $balance, $plan){
            parent::__construct($id, $name, $email, $balance);
            $this->plan = $plan;
        }

        public function getEmail(){
            return $this->email;
        }
    }

    $subscriber = new Subscriber(1, 'arif', 'arif@gmail.com', 20, 'Pro');

    echo $subscriber->getEmail();

?>