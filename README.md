# Brex-id

### In a nutshell...

*brex_id is a PHP/MySQL admin panel project that manages articles, events, and user profiles with secure authentication.*

Work-in-progress project for the philology department at a University in Madrid.  
It works as a repository for their work (mainly lectures and papers). The admin team can upload,  
edit and delete info via the backside CRUD and users will be able to learn about the project,  
be informed of the latest events and search through content for what they're interested in.

### Screenshots
- Home page: screenShots/home.png
- Login: screenShots/login.png
- New article: screenShots/new-article.png

### Features

- User registration & login with password hashing  
- CRUD operations for articles, events, and profiles  
- Responsive and clean UI design  
- Secure access control with user roles (e.g., admin)  
- Full database dump included

### Technologies used
- HTML
- CSS
- JS
- MySQL
- PHP

### Installation

#### Prerequisites

- PHP 7.x or higher  
- MySQL 8.x or higher  
- Web server like Apache or Nginx  

#### Setup Steps

1. **Clone the repository**

   ```bash
   git clone https://github.com/your-username/brex_id.git
   cd brex_id

2. **Import the database dump**
   ```bash
   mysql -u your_db_user -p < database/brex_id.sql

3. **Configure your database connection** in config.php or other applicable with your MySQL credentials.
4. **Run the project locally with your preferred web server.**

### Security
- Passwords are securely hashed using bcrypt (via PHP password_hash)
- User roles control access to admin features

### Usage
- Login with existing credentials:
  - user: jane; password: admin123
- or register a new user
- Manage articles and events via the admin panel
- Check user roles for permission-based content

### Contributing
- Feel free to open issues or submit pull requests!
- Make sure to write clear commit messages and follow code style guidelines.

### License
- This project is licensed under the MIT License — see the LICENSE file for details.

### Contact
- Pablo Vecilla — pablovecilla8@gmail.com
- Project Link: https://github.com/PabloVecilla/brex_id
