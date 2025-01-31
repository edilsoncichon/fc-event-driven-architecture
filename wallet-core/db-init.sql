CREATE DATABASE IF NOT EXISTS wallet;
USE wallet;
CREATE TABLE IF NOT EXISTS clients
(
    id         varchar(255),
    name       varchar(255),
    email      varchar(255),
    created_at date
);
CREATE TABLE IF NOT EXISTS accounts
(
    id         varchar(255),
    client_id  varchar(255),
    balance    int,
    created_at date
);
CREATE TABLE IF NOT EXISTS transactions
(
    id              varchar(255),
    account_id_from varchar(255),
    account_id_to   varchar(255),
    amount          int,
    created_at      date
);

INSERT IGNORE INTO clients (id, name, email, created_at)
VALUES ('f55a15ca-f6f4-489b-9354-02b44223648a', 'Paula Tejando', 'paulatejando@gmail.com', NOW()),
       ('e9f845ff-a0e6-413e-9dd2-ba7c87f213e0', 'Kuka Beludo', 'Kukabeludo@gmail.com', NOW());

INSERT IGNORE INTO accounts (id, client_id, balance, created_at)
VALUES ('6fac5d8e-1429-4071-bee3-179585775f5a', 'f55a15ca-f6f4-489b-9354-02b44223648a', 1000, NOW()),
       ('d1c87aa6-ebf5-4f52-916f-1e17e7f5d1ab', 'e9f845ff-a0e6-413e-9dd2-ba7c87f213e0', 1000, NOW());
