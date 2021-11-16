<?php 
    class Transaction {
        public int $id;
        public string $datetime;
        public float $amount;
        public string $from_iban;
        public string $to_iban;
        public string $notes;
    }
?>
