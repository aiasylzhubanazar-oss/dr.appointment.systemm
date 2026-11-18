-- Dr.tirkelu дерекқоры. phpMyAdmin → Import арқылы іске қосыңыз.
CREATE DATABASE IF NOT EXISTS dr_tirkelu CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE dr_tirkelu;

CREATE TABLE IF NOT EXISTS users (
  id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  full_name     VARCHAR(100) NOT NULL,
  phone         VARCHAR(20)  NOT NULL,
  email         VARCHAR(100) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  role          ENUM('user','admin') NOT NULL DEFAULT 'user',
  created_at    TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS specialties (
  id   INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(60) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS doctors (
  id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  full_name    VARCHAR(100) NOT NULL,
  specialty_id INT UNSIGNED NOT NULL,
  about        TEXT,
  FOREIGN KEY (specialty_id) REFERENCES specialties(id)
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS appointments (
  id               INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id          INT UNSIGNED NOT NULL,
  doctor_id        INT UNSIGNED NOT NULL,
  appointment_date DATE NOT NULL,
  appointment_time TIME NOT NULL,
  status           ENUM('booked','cancelled') NOT NULL DEFAULT 'booked',
  created_at       TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id)   REFERENCES users(id)   ON DELETE CASCADE,
  FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE,
  UNIQUE KEY uniq_slot (doctor_id, appointment_date, appointment_time)
) ENGINE=InnoDB;

INSERT IGNORE INTO specialties (id, name) VALUES (1,'Терапевт'),(2,'Кардиолог'),(3,'Педиатр'),(4,'Невролог');

INSERT INTO doctors (full_name, specialty_id, about)
SELECT * FROM (
  SELECT 'Айгерім Нұрланқызы' AS n, 1 AS s, '12 жыл тәжірибе. Жалпы қабылдау, тексеру, ем тағайындау.' AS a UNION ALL
  SELECT 'Ержан Сәрсенов', 2, 'Жүрек-қан тамыр аурулары, ЭКГ, қан қысымын бақылау.' UNION ALL
  SELECT 'Динара Қасымова', 3, 'Балалар денсаулығы, вакцинация, өсу мен дамуды бақылау.' UNION ALL
  SELECT 'Марат Жақсыбеков', 4, 'Бас ауруы, ұйқы бұзылуы, жүйке жүйесі.' UNION ALL
  SELECT 'Сәуле Ахметова', 1, 'Қайталама қабылдау, анализдерді талдау.' UNION ALL
  SELECT 'Нұрбол Тоқтаров', 2, 'Жүрек ырғағы, гипертония, профилактикалық қарау.'
) AS t
WHERE NOT EXISTS (SELECT 1 FROM doctors);
