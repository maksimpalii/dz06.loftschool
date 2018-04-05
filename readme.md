1. Console `composer install`
2. Create `core/config.php` as `core/config-sample.php`
3. Create table **users**

`CREATE TABLE users
(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    number VARCHAR(255),
    email VARCHAR(255)
);
CREATE UNIQUE INDEX users_email_uindex ON users (email);
`

4. Create table **orders**

`CREATE TABLE orders
(
    id_order INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    adress_order VARCHAR(255),
    detail_order VARCHAR(255),
    comment_order VARCHAR(255)
);`

Админ панель - **/admin**

Манипуляции с картинкой - **/image** ( используеться `claviska/simpleimage` )
