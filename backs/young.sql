DROP TABLE IF EXISTS animals.young_animals;
CREATE TABLE animals.young_animals (
  id INT NOT NULL AUTO_INCREMENT,
  animals_id INT NOT NULL,
  age INT NOT NULL,
  PRIMARY KEY (id),
  INDEX id_idx (animals_id ASC) VISIBLE,
  CONSTRAINT id
    FOREIGN KEY (animals_id)
    REFERENCES animals.animals (id)
    ON DELETE CASCADE
    ON UPDATE CASCADE);
    
SELECT * FROM animals.young_animals;

# INSERT INTO animals.young_animals (animals_id, age)
# SELECT id, TIMESTAMPDIFF(MONTH, date_of_birth, CURDATE()) AS age
# FROM animals
# WHERE date_of_birth BETWEEN DATE_SUB(CURDATE(), INTERVAL 3 YEAR) AND DATE_SUB(CURDATE(), INTERVAL 1 YEAR);

INSERT INTO animals.young_animals (animals_id, age)
SELECT id, TIMESTAMPDIFF(MONTH, date_of_birth, CURDATE()) AS age
FROM animals;

SELECT * FROM animals.young_animals
WHERE age BETWEEN 12 AND 36;