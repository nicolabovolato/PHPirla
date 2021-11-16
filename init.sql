CREATE TABLE users (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(64) unique NOT NULL,
    `password` VARCHAR(64) NOT NULL,
    `iban` CHAR(27) unique NOT NULL,
    `balance` DECIMAL DEFAULT 0 NOT NULL
);

CREATE TABLE transactions (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `datetime` DATETIME NOT NULL DEFAULT NOW(),
    `notes` VARCHAR(128) NOT NULL,
    `amount` DECIMAL NOT NULL,
    `from_iban` CHAR(27) NOT NULL,
    `to_iban` CHAR(27) NOT NULL
);

CREATE TABLE reviews (
    `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `datetime` DATETIME NOT NULL DEFAULT NOW(),
    `text` TEXT NOT NULL,
    `username` VARCHAR(64) REFERENCES users(`username`)
);

INSERT INTO users (username, password, iban, balance) 
VALUES
    ("Not Steve Jobs", "W1nd0ws5uck5!", "US1700200128000000120052760", 5922350434.97),
    ("admin", "admin", "US1523100000054000784030479", 2.99),
    ("/dev/zero", "' OR 1 --", "AA000000000000000000000000", 2147483648);

INSERT INTO transactions (datetime, from_iban, to_iban, amount, notes) 
VALUES
    ("2011-10-5 13:17:17", "US1700200128000000120052760", "SI1800200328000000120052760", 10000000, "Resurrection fees"),
    ("2013-6-10 18:20:00", "US0000200254723460120052762", "US1700200128000000120052760", 12043285.54, "Apple dividends"),
    ("2015-3-28 22:17:03", "US1700200128000000120052760", "US1800200328003460120052762", 49.99, "Windows 10 Home Edition"),
    ("2017-5-12 10:40:32", "US1700200128000000120052760", "AL5604200129373400112348734", 300, "Wannacry unlocker payment"),
    ("2009-1-1 14:18:56", "US1523100000054000784030479", "US1800200328000000120052760", 4999.97, "cPanel lifetime license"),
    ("2012-10-3 11:43:18", "US1523100000054000784030479", "US1237048195820398652034234", 32.99, "How to secure a PHP website and other hilarious jokes you can tell yourself (1997 Ultimate Edition)"),
    ("2016-4-18 17:26:01", "US1523100000054000784030479", "US1237048195820398652034234", 22.10, "Maintaining legacy codebases - O'Reilly"),
    ("2018-1-31 21:40:23", "US1523100000054000784030479", "US1237048195820398652034234", 19.99, "Perl for beginners"),
    ("2018-4-15 18:16:23", "AA000000000000000000000000", "US1800200328003460120052762", 699, "CompTIA PenTest+"),
    ("2019-11-25 23:35:06", "AA000000000000000000000000", "US1800200328003460120052762", 999, "Offensive Security Certified Professional OSCP"),
    ("2019-12-10 10:40:32", "AA000000000000000000000000", "AA000000000000000000000000", 9999, "Just generating some money"),
    ("465-8-10 12:08:22", "AA000000000000000000000000", "AA000000000000000000000000", 500, "Wait, dollars did not exist back then!"),
    ("2019-12-10 10:45:59", "AA000000000000000000000000", "AA000000000000000000000000", 9999999, "Just generating some more money");

INSERT INTO reviews (datetime, username, text) 
VALUES
    ("1835-6-10 21:40:20", "/dev/zero", "<b>POV: You are the admin</b><br/><img src=\"https://i.kym-cdn.com/entries/icons/original/000/031/021/cover2.jpg\" width=\"300px\"/>"),
    ("2020-3-29 08:15:56", "admin", "Not even the NSA is able to crack this website, and trust me I know what I'm talking about."),
    ("2021-7-10 00:24:54", "Not Steve Jobs", "Very reserved bank, ideal for people concerned about their privacy, Would use again 10/10");
