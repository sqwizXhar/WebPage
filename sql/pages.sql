CREATE TABLE pages(
	id SERIAL PRIMARY KEY NOT NULL,
	user_id INT NOT NULL, 
	title VARCHAR(255) NOT NULL,
	content TEXT NOT NULL,
	publish_date DATE,
	FOREIGN KEY (user_id) REFERENCES user_data(id)
)