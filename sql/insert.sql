INSERT INTO admin (Name, Citizen_ID, Phone, Role)
VALUES ('Alexander',991012152003,60131154662,'Manager');

INSERT INTO borrower (Name, Citizen_ID, Phone,Email)
VALUES('Socrates',54656222122,60321254545,'socatesa@email.com' );


INSERT INTO borrower (Name, Citizen_ID, Phone,Email)
VALUES('borrower2',54232122,60324254545,'borroweresa@email.com' );



INSERT INTO lender (Name, Citizen_ID, Phone,Email)
VALUES('John Forbes Nash',54233232122,603232354545,'Nash@email.com' );

INSERT INTO borrower_acct (Balance,Borrower_ID,Memo)
VALUES(33300,3,'demo1');




INSERT INTO lender_acct (Balance, Lender_ID, Memo)
VALUES (340122, 1, 'Demo1');


INSERT INTO loan_request (Borrower_ID, Amount, Loan_Start, Loan_Term_Y, Memo)
VALUES (1, 581111.22, '2020-8-21', 5, 'DemoRequest1');

INSERT INTO loan_request (Borrower_ID, Amount, Loan_Start, Loan_Term_Y, Memo)
VALUES (3, 33111.22, '2019-8-21', 10, 'DemoRequest2');



INSERT INTO loan_offer 
(Loan_Request_ID, Borrower_ID, Lender_ID, 
 Offer_Amount, Payment_Method, Interest_Rate,
 Loan_Start, Loan_Term_Y, Memo)
 VALUES
 (1000, 1, 2,
  50000,'Equal Principal', 4.85,
 '2020-10-30', 6, 'demo1');

 INSERT INTO loan_offer 
(Loan_Request_ID, Borrower_ID, Lender_ID, 
 Offer_Amount, Payment_Method, Interest_Rate,
 Loan_Start, Loan_Term_Y, Memo)
 VALUES
 (1000, 1, 1,
  60000,'Equal Loan', 4.05,
 '2020-10-30', 7, 'demo2');

 INSERT INTO installment_acct (Balance, Loan_Offer_ID, Memo)
VALUES (5000000, 5002, 'demoAcct 1');

INSERT INTO transaction (Memo)
VALUES ('demo transaction 1');

INSERT INTO trans_record (Trans_ID, Account_Type, Account_ID, Amount)
VALUES (1, 'Borrower', 3, -300.01),
(1, 'Lender', 1, 300.01);

SELECT * FROM transaction WHERE Payee_Acct_Type = 'Lender' AND Payee_Acct_ID = '1'



INSERT INTO transaction (Payer_Acct_Type, Payer_Acct_ID, Cr_Amount,
                         Payee_Acct_Type, Payee_Acct_ID, Dr_Amount,
                         Memo)
VALUES ('Borrower', 3, 300.01,
        'Lender', 1, 300.01,
        'demoTrans')


INSERT INTO transaction (Payer_Acct_Type, Payer_Acct_ID, Cr_Amount,
                         Payee_Acct_Type, Payee_Acct_ID, Dr_Amount,
                         Memo)
VALUES ('Lender', 2, 100.01,
        'Installment', 1, 100.01,
        'demoTrans1'),
          ('Lender', 2, 400.01,
        'Borrower', 3, 400.01,
        'demoTrans5')



SELECT * FROM `transaction` 
WHERE Payee_Acct_Type = 'Borrower' AND Payee_Acct_ID = '3' 
UNION 
SELECT * FROM `transaction` 
WHERE Payer_Acct_Type = 'Borrower' AND Payer_Acct_ID = '3'


SELECT Date(date_created) AS 'date', loan_offer_id AS 'offer_id', balance, memo
FROM installment_acct 
WHERE id 
IN(
    SELECT MAX(id)
    FROM installment_acct 
    GROUP BY loan_offer_id
    );

    SELECT Date(date_created) AS 'date', loan_offer_id, balance, memo
                        FROM installment_acct WHERE id 
                        IN(
                        SELECT MAX(id)
                        FROM installment_acct 
                        GROUP BY loan_offer_id
                        )
                        ORDER BY loan_offer_id ASC
                        ;


 SELECT * FROM loan_offer WHERE borrower_id = 1 AND is_expired IS NULL AND is_accepted IS NULL;

 INSERT INTO balance_record (balance, account_type, account_id)
                        VALUES (?, ?, ?)
INSERT INTO balance_record (balance, account_type, account_id)
VALUES (222212.22, 'installment', 3000000004)

INSERT INTO balance_record (balance, account_type, account_id)
                        VALUES (22333.22, 'borrower', 500000000)

                        INSERT INTO balance_record (balance, account_type, account_id)
                        VALUES (22333.22, 'lender', 2000000001)

SELECT t1.id, t2.balance, t1.memo FROM
(SELECT * FROM `borrower_acct` WHERE borrower_id = 3) t1
INNER JOIN 
(SELECT * FROM balance_record WHERE id 
                        IN(
                            SELECT MAX(id)
                            FROM balance_record 
                            GROUP BY account_id ,account_type
                        )
                        ) t2

ON t1.id = t2.account_id


                        