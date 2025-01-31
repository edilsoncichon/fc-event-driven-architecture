CREATE DATABASE IF NOT EXISTS balances;
USE balances;

CREATE TABLE IF NOT EXISTS accounts (
    id varchar(255) PRIMARY KEY,
    client_id varchar(255), 
    balance int, 
    created_at date
);

INSERT IGNORE INTO accounts (id, client_id, balance, created_at) VALUES
('6fac5d8e-1429-4071-bee3-179585775f5a', 'f55a15ca-f6f4-489b-9354-02b44223648a', 1000, NOW()),
('d1c87aa6-ebf5-4f52-916f-1e17e7f5d1ab', 'e9f845ff-a0e6-413e-9dd2-ba7c87f213e0', 1000, NOW());
