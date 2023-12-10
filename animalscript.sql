USE animals;
SHOW TABLES;

SELECT * FROM animals;
          
DELETE FROM kinds WHERE id = 2;

SELECT * FROM animals;

SELECT animals.name, animals.date_of_birth, young_animals.age
FROM animals
LEFT JOIN young_animals ON animals.id = young_animals.animals_id
WHERE age is not null;

SELECT animals.name, kinds.kind, animals.date_of_birth, young_animals.age
FROM animals
LEFT JOIN young_animals ON animals.id = young_animals.animals_id
LEFT JOIN kinds ON animals.kinds_id = kinds.id;

SELECT animals.name, animals.date_of_birth, GROUP_CONCAT(commands.command SEPARATOR ', ') AS commands 
FROM animals
LEFT JOIN animal_command ON animals.id = animal_command.animals_id
LEFT JOIN commands ON animal_command.commands_id = commands.id
GROUP BY animals.id;

SELECT animals.name, kinds.kind, animals.date_of_birth, young_animals.age, commands.command
FROM animals
LEFT JOIN young_animals ON animals.id = young_animals.animals_id
LEFT JOIN kinds ON animals.kinds_id = kinds.id
LEFT JOIN animal_command ON animals.id = animal_command.animals_id
LEFT JOIN commands ON animal_command.commands_id = commands.id;

CREATE TABLE itogo AS
SELECT 
  animals.id,
  animals.name AS "имя", 
  kinds.kind AS "вид", 
  MAX(types.type) AS "тип",
  animals.date_of_birth AS "дата рождения", 
  GROUP_CONCAT(DISTINCT commands.command ORDER BY commands.command SEPARATOR ', ') AS "команды",
  MAX(young_animals.age) AS "возраст" 
FROM animals
LEFT JOIN animal_command ON animals.id = animal_command.animals_id
LEFT JOIN commands ON animal_command.commands_id = commands.id
LEFT JOIN kinds ON animals.kinds_id = kinds.id
LEFT JOIN types ON kinds.types_id = types.id
LEFT JOIN young_animals ON animals.id = young_animals.animals_id
GROUP BY animals.id
;

SELECT * FROM itogo;