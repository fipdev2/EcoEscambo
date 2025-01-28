CREATE TABLE users
(
    id           INT AUTO_INCREMENT PRIMARY KEY,
    name         VARCHAR(255) NOT NULL,
    email        VARCHAR(255) NOT NULL UNIQUE,
    password     TEXT         NOT NULL,
    salt         TEXT         NOT NULL,
    neighborhood VARCHAR(255) NOT NULL
);

CREATE TABLE products
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    title       VARCHAR(255) NOT NULL,
    description TEXT,
    owner_id    INT          NOT NULL,
    photo_id    INT          NOT NULL,
    FOREIGN KEY (owner_id) REFERENCES users (id),
    FOREIGN KEY (photo_id) REFERENCES photos (id)
);

CREATE TABLE photos
(
    id          INT AUTO_INCREMENT PRIMARY KEY,
    path        TEXT NOT NULL,
    client_path TEXT NOT NULL
);

CREATE TABLE favourites
(
    user_id    INT NOT NULL,
    product_id INT NOT NULL,
    PRIMARY KEY (user_id, product_id),
    FOREIGN KEY (user_id) REFERENCES users (id),
    FOREIGN KEY (product_id) REFERENCES products (id)
);

CREATE TABLE trades
(
    id                 INT AUTO_INCREMENT PRIMARY KEY,
    product_id         INT     NOT NULL,
    interested_user_id INT     NOT NULL,
    concluded          BOOLEAN NOT NULL DEFAULT FALSE,
    FOREIGN KEY (product_id) REFERENCES products (id),
    FOREIGN KEY (interested_user_id) REFERENCES users (id)
);

