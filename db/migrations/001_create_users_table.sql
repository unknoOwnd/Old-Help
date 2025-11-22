CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `role` VARCHAR(50) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert some dummy data
INSERT INTO `users` (`name`, `email`, `role`) VALUES
('John Doe', 'john.doe@example.com', 'admin'),
('Jane Smith', 'jane.smith@example.com', 'caregiver'),
('Peter Jones', 'peter.jones@example.com', 'elderly');
