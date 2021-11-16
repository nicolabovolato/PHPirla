<?php
    $root = realpath($_SERVER['DOCUMENT_ROOT']);
    require_once "$root/php/data-model/repo.php";
    require_once "$root/php/data-model/user.php";
    require_once "$root/php/data-model/transaction.php";

    $servername = 'mysql';
    $username = 'root';
    $password = 'example';
    $db = 'bank';
  
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
  
    class UserRepo implements Repository {
        private PDO $conn;

        function __construct(PDO $conn) {
            $this->conn = $conn;
        }

        public function get_all(): array {
            $stmt = $this->conn->prepare('SELECT * FROM users');
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User'); 
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function get_by_id($id): User {
            die('Method not implemented');
        }

        public function get_by_username($username) {
            $stmt = $this->conn->prepare('SELECT * FROM users WHERE username=?');
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User'); 
            $stmt->execute([$username]);
            return $stmt->fetch(); 
        }

        public function get_by_iban($iban) {
            $stmt = $this->conn->prepare('SELECT * FROM users WHERE iban=?');
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'User'); 
            $stmt->execute([$iban]);
            return $stmt->fetch(); 
        }

        public function create($user) {
            $stmt = $this->conn->prepare('INSERT INTO users (username, password, balance, iban) VALUES (?, ?, ?, ?)');
            return $stmt->execute([$user->username, $user->password, $user->balance, $user->iban]);
        }
        
        public function update($user) {
            $stmt = $this->conn->prepare('UPDATE users SET username=?, password=?, balance=?, iban=? WHERE id=?');
            return $stmt->execute([$user->username, $user->password, $user->balance, $user->iban, $user->id]);
        }

        public function delete($user) {
            die('Method not implemented');
        }
    }

    class TransactionRepo implements Repository {
        private PDO $conn;

        function __construct(PDO $conn) {
            $this->conn = $conn;
        }

        public function get_all(): array {
            $stmt = $this->conn->prepare('SELECT * FROM transactions');
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Transaction'); 
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function get_by_id($id): Transaction {
            die('Method not implemented');
        }

        public function get_by_iban($iban) {
            $stmt = $this->conn->prepare('SELECT * FROM transactions WHERE from_iban=? OR to_iban=? ORDER BY datetime DESC');
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Transaction'); 
            $stmt->execute([$iban, $iban]);
            return $stmt->fetchAll(); 
        }

        public function get_by_iban_and_text($iban, $text) {
            $stmt = $this->conn->prepare('SELECT * FROM transactions WHERE (from_iban=? OR to_iban=?) AND notes LIKE ? ORDER BY datetime DESC');
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Transaction'); 
            $stmt->execute([$iban, $iban, "%$text%"]);
            return $stmt->fetchAll(); 
        }

        public function create($transaction) {
            $stmt = $this->conn->prepare('INSERT INTO transactions (amount, from_iban, to_iban, notes) VALUES (?, ?, ?, ?)');
            return $stmt->execute([$transaction->amount, $transaction->from_iban, $transaction->to_iban, $transaction->notes]);
        }
        
        public function update($transaction) {
            die('Method not implemented');
        }

        public function delete($transaction) {
            die('Method not implemented');
        }
    }

    class ReviewsRepo implements Repository {
        private PDO $conn;

        function __construct(PDO $conn) {
            $this->conn = $conn;
        }

        public function get_all(): array {
            $stmt = $this->conn->prepare('SELECT * FROM reviews ORDER BY datetime DESC');
            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Review'); 
            $stmt->execute();
            return $stmt->fetchAll();
        }

        public function get_by_id($id): Transaction {
            die('Method not implemented');
        }

        public function create($review) {
            $stmt = $this->conn->prepare('INSERT INTO reviews (text, username) VALUES (?, ?)');
            return $stmt->execute([$review->text, $review->username]);
        }
        
        public function update($review) {
            die('Method not implemented');
        }

        public function delete($review) {
            die('Method not implemented');
        }
    }

    $user_repo = new UserRepo($conn);
    $transaction_repo = new TransactionRepo($conn);
    $review_repo = new ReviewsRepo($conn);
?>
