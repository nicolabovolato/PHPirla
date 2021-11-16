<?php 
    interface Repository {
        public function get_all(): array;
        public function get_by_id($id): object;
        public function create($obj);
        public function update($obj);
        public function delete($obj);
    }
?>