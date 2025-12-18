CREATE TABLE client(
    client_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    cin VARCHAR (20) UNIQUE NOT NULL,
    telephone VARCHAR(50) UNIQUE NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE utilisateur(
    user_id INT  AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(100),
    create_at DATETIME DEFAULT CURRENT_TIMESTAMP 
);
CREATE TABLE compte(
    compte_id INT PRIMARY KEY AUTO_INCREMENT,
    account_number VARCHAR(100) UNIQUE,
    type_compte VARCHAR(100),
    balance decimal(12,2) DEFAULT 0,
    status VARCHAR(100),
    client_id INT NOT NULL,
    Created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_compte_client
    FOREIGN KEY(client_id)
    REFERENCES client(client_id)
    ON DELETE CASCADE
);
CREATE TABLE transactions(
    transaction_id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('depot','retrait') NOT NULL,
    montant decimal(12,2) NOT NULL,
    date_transaction DATETIME DEFAULT CURRENT_TIMESTAMP,
    compte_id INT NOT NULL,
    user_id INT NOT NULL,
    CONSTRAINT fk_transaction_client
    FOREIGN KEY (compte_id)
    REFERENCES compte(compte_id)
    ON DELETE CASCADE,
    CONSTRAINT fk_transaction_user
    FOREIGN KEY (user_id)
    REFERENCES utilisateur(user_id)
    ON DELETE CASCADE
);