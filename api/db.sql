
CREATE TABLE todos (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  title NOT NULL VARCHAR(255),
  completed NOT NULL BOOLEAN DEFAULT 0
);

INSERT INTO todos ('title', 'completed') VALUES (
  'task1',
  0
);