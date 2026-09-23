# Borrow and Trust

An individual PHP and MySQL prototype by Zannaty Aziza for lending items within a community. Users can create accounts, browse and search available items, request to borrow an item, return it, and view trust scores and a leaderboard. The project also includes an admin view and a simulated OTP flow.

## Stack

- PHP with MySQLi
- MySQL
- HTML and CSS

## Run locally

1. Create a MySQL database named `Borrow_and_Trust`.
2. Import `schema.sql` into that database. It creates the three tables without importing any account records.
3. Copy `config.example.php` to `config.php`, then set the database connection values using the `DB_HOST`, `DB_USER`, `DB_PASSWORD`, and `DB_NAME` environment variables or edit your local `config.php`.
4. Serve this directory with a PHP web server that has the MySQLi extension, and open `register.php`.

The original local `config.php` and `borrow_and_trust_full.sql` are excluded from Git. The latter contains sample account records and is intentionally not part of this repository.

## Project status

This is a prototype. Its OTP is simulated, and several database queries use string interpolation. It needs prepared statements, output escaping, authorization checks, and broader testing before use with real accounts or personal information. It has not been run as part of this repository setup because a PHP/MySQL runtime was not available on this computer.
