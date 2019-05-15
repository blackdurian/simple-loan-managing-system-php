/* Account Table */
CREATE TABLE Borrower_Acct (
    ID INT(8) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Balance DECIMAL(13,2),
    Borrower_ID INT(8) UNSIGNED,
    Memo TEXT,
    Date_Created TIMESTAMP NULL DEFAULT NOW(),
    Date_Modified TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
    FOREIGN KEY (Borrower_ID) REFERENCES Borrower(ID)
)
ALTER TABLE Borrower_Acct AUTO_INCREMENT = 500000000;
	
                                        500000000
CREATE TABLE Lender_Acct (
    ID INT(8) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Balance DECIMAL(13,2),
    Lender_ID INT(8) UNSIGNED,
    Memo TEXT,
    Date_Created TIMESTAMP NULL DEFAULT NOW(),
    Date_Modified TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
    FOREIGN KEY (Lender_ID) REFERENCES Lender(ID)
)

ALTER TABLE Lender_Acct AUTO_INCREMENT = 2000000000;


CREATE TABLE Installment_Acct (
    ID INT(8) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Balance DECIMAL(13,2),
    Loan_Offer_ID INT(6) UNSIGNED NOT NULL,
    Memo TEXT,
    Date_Created TIMESTAMP NULL DEFAULT NOW(),
    Date_Modified TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
    FOREIGN KEY (Loan_Offer_ID) REFERENCES Loan_Offer(ID)
)

ALTER TABLE Installment_Acct AUTO_INCREMENT = 3000000000;

/* Account Table End */

CREATE TABLE Transaction (
    ID INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Payer_Account_Type VARCHAR(10) NOT NULL,
    Payer_Account_ID INT(8) UNSIGNED NOT NULL,   /* from borrower lender installment acount */
    Payee_Account_Type VARCHAR(10) NOT NULL,
    Payee_Account_ID INT(8) UNSIGNED,   /* from borrower lender installment acount */
    Debit DECIMAL(13,2), 
    Cebit DECIMAL(13,2), 
    Memo TEXT,
    Date_Created TIMESTAMP NULL DEFAULT NOW()
)

/* Transaction Table */
CREATE TABLE Trans_Record (
    ID INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Trans_ID INT UNSIGNED,
    Account_Type ENUM('Borrower', 'Lender', 'Installment') NOT NULL,
    Account_ID INT(8) UNSIGNED,   /* from borrower lender installment acount */
    Amount DECIMAL(13,2), 
    FOREIGN KEY (Trans_ID) REFERENCES Transaction(ID) 
)

CREATE TABLE Transaction (
    ID INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Memo TEXT,
    Date_Created TIMESTAMP NULL DEFAULT NOW(),
)

/* Transaction Table End*/


/* User Table */
CREATE TABLE Login (
    ID INT(8) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Username VARCHAR(20) NOT NULL,
    Password VARCHAR(64) NOT NULL,
    User_ID INT(8) UNSIGNED NOT NULL,
    FOREIGN KEY (User_ID) REFERENCES Admin(ID)
)


CREATE TABLE Borrower (
    ID INT(8) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Citizen_ID VARCHAR(40) NOT NULL,
    Phone VARCHAR(40) NOT NULL,
    Email TEXT NOT NULL,
    Credit_Rate TINYINT(1) UNSIGNED NOT NULL DEFAULT 5 ,
    Date_Created TIMESTAMP DEFAULT NOW(),
    Date_Modified TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW()
    
)
ALTER TABLE borrower MODIFY Email TEXT

CREATE TABLE Lender (
    ID INT(8) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Citizen_id VARCHAR(40) NOT NULL,
    Phone VARCHAR(40) NOT NULL,
    Email TEXT,
    Date_Created TIMESTAMP DEFAULT NOW(),
    Date_Modified TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW()
)
ALTER TABLE Lender MODIFY Date_Created TIMESTAMP DEFAULT NOW()

CREATE TABLE Admin (
    ID INT(5) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Name VARCHAR(255) NOT NULL,
    Citizen_ID VARCHAR(40) NOT NULL,
    Phone VARCHAR(40) NOT NULL,
    Role ENUM('Manager', 'Staff') NOT NULL,
    Date_Created TIMESTAMP NULL DEFAULT NOW(),
    Date_Modified TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW()
)
ALTER TABLE Lender MODIFY Date_Created TIMESTAMP DEFAULT NOW()
/* User Table End */

/* Loan Table */
CREATE TABLE Loan_Request (
    ID INT(6) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Borrower_ID INT(8) UNSIGNED NOT NULL,
    Amount DECIMAL(13,2) NOT NULL, 
    Loan_Start DATE NOT NULL,
    Loan_Term_Y INT(2) NOT NULL,
    Memo TEXT,
    Date_Created TIMESTAMP NULL DEFAULT NOW(),
    Date_Modified TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
    FOREIGN KEY (Borrower_ID) REFERENCES Borrower(ID)
)

ALTER TABLE Loan_Request AUTO_INCREMENT = 1000;
ALTER TABLE loan_request ADD is_expired BOOLEAN;

CREATE TABLE Loan_Offer (
    ID INT(6) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Loan_Request_ID INT(6) UNSIGNED NOT NULL,
    Borrower_ID INT(8) UNSIGNED NOT NULL,
    Lender_ID INT(8) UNSIGNED NOT NULL,
    Offer_Amount DECIMAL(13,2) NOT NULL, 
    Payment_Method VARCHAR(20) NOT NULL,
    Interest_Rate DECIMAL(2,2) NOT NULL,
    Loan_Start DATE NOT NULL,
    Loan_Term_Y INT(2) NOT NULL,
    Memo TEXT,
    IsAccepted BOOLEAN,
    IsApproved BOOLEAN,
    VerifyBy VARCHAR(50),
    Date_Created TIMESTAMP NULL DEFAULT NOW(),
    Date_Modified TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
    FOREIGN KEY (Loan_Request_ID) REFERENCES Loan_Request(ID),
    FOREIGN KEY (Borrower_ID) REFERENCES Borrower(ID),
    FOREIGN KEY (Lender_ID) REFERENCES Lender(ID)
)

ALTER TABLE loan_offer AUTO_INCREMENT = 5000;

CREATE Table Loan_Schedule (
    ID INT(6) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    Loan_Offer_ID INT(6) UNSIGNED NOT NULL,
    Principal DECIMAL(13,2) NOT NULL,
    Interest DECIMAL(13,2) NOT NULL,
    Installment_Amount DECIMAL(13,2) NOT NULL,
    Balance DECIMAL(13,2),
    Date_Created TIMESTAMP NULL DEFAULT NOW(),
    Date_Modified TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
    FOREIGN KEY (Loan_Offer_ID) REFERENCES Loan_Offer(ID)
)

ALTER TABLE loan_schedule ADD month_id INT NOT NULL;


CREATE Table overdue_charge (
    ID INT(6) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    loan_schedule_id INT(6) UNSIGNED NOT NULL,
    overdue_amount DECIMAL(13,2) NOT NULL,
    lated_term_by_month INT(8) UNSIGNED NOT NULL,
    charge_amount DECIMAL(13,2) NOT NULL,
    is_settled BOOLEAN,
    Date_Created TIMESTAMP NULL DEFAULT NOW(),
    Date_Modified TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW(),
    FOREIGN KEY (loan_schedule_id) REFERENCES loan_schedule(id)
)

ALTER TABLE loan_schedule ADD month_id INT NOT NULL;


CREATE TABLE balance_record (
    id INT(8) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    balance DECIMAL(13,2) NOT NULL,
    account_type VARCHAR(20) NOT NULL,
    account_id INT(10) UNSIGNED NOT NULL,
    Date_Created TIMESTAMP NULL DEFAULT NOW(),
    Date_Modified TIMESTAMP NOT NULL DEFAULT NOW() ON UPDATE NOW()
)