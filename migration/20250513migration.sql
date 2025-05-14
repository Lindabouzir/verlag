-- Tabelle Author
CREATE TABLE Author (
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        fname VARCHAR(50),
                        lname VARCHAR(50),
                        bday DATE,
                        country VARCHAR(50)
);

-- Tabelle Book
CREATE TABLE Book (
                      id INT PRIMARY KEY AUTO_INCREMENT,
                      isbn VARCHAR(20),
                      publication_date DATE,
                      pages INT,
                      title VARCHAR(100),
                      price DOUBLE,
                      category VARCHAR(50),
                      hardcover BOOLEAN,
                      author_id INT,
                      FOREIGN KEY (author_id) REFERENCES Author(id)
);

-- Zwei Autoren einfügen
INSERT INTO Author (fname, lname, bday, country) VALUES
                                  ('George', 'Orwell', '1903-06-25', 'UK'),
                                  ('Harper', 'Lee', '1926-04-28', 'USA');

-- Zwei Bücher einfügen
INSERT INTO Book (isbn, publication_date, pages, title, price, category, hardcover, author_id) VALUES

      ('9780451524935', '1949-06-08', 328, '1984', 9.99, 'Dystopia', TRUE, 1),
      ('9780061120084', '1960-07-11', 281, 'To Kill a Mockingbird', 7.99, 'Fiction', FALSE, 2);
