CREATE TABLE IF NOT EXISTS tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    icon VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=INNODB;

-- Insert some default tasks
INSERT INTO tasks (title, icon, description) VALUES
('Email', 'envelope', 'Get help with sending or reading emails.'),
('Internet', 'search', 'Get help with browsing the web.'),
('Video Call', 'video', 'Get help with making video calls to family and friends.'),
('Support', 'help-circle', 'Request technical support.');
