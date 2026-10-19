# Gopweet 🚀

Gopweet is a lightweight, open-source microblogging web application built with **PHP**. It mimics core social media features like posting, following users, liking posts, hashtags, profile management, and content moderation tools (such as swear-word filtering).

## 📂 Project Structure

```text
PHP-Gopweet-main/
└── Source/
    ├── .htaccess          # URL rewriting and routing rules
    ├── favicon.ico        # Site favicon
    ├── following.php      # View for following/followers list
    ├── function.php       # Core helper functions and database utilities
    ├── hashtag.php        # Hashtag tracking and post filtering
    ├── home.php           # Main user feed / timeline
    ├── index.php          # Entry point / Landing or Login page
    ├── php.ini            # PHP configuration settings
    ├── policy.php         # Terms of service / Privacy policy
    ├── post.php           # Single post view page
    ├── pp.jpg             # Default profile picture / asset
    ├── register.php       # User registration page
    ├── scripts.js         # Frontend JavaScript interactions
    ├── swears.txt         # Blacklist/dictionary for swear-word filtering
    ├── user.php           # User profile management page
    └── tool_*.php         # Backend handler scripts (auth, delete, follow, like, publish, etc.)
```

## ✨ Features

- **User Authentication:** Secure registration, login, logout, and session management (`register.php`, `tool_auth.php`, `tool_logout.php`, `tool_reg.php`).
- **Microblogging Feed:** Publish short posts (`tool_publish.php`), view home timeline (`home.php`), and inspect individual posts (`post.php`, `tool_getpost.php`).
- **Social Interactions:** Follow/unfollow users (`tool_follow.php`), like posts (`tool_like.php`), and browse via hashtags (`hashtag.php`).
- **Profile Customization:** Manage settings, profile pictures, and passwords (`user.php`, `tool_set.php`, `tool_setpd.php`, `tool_setpp.php`).
- **Content Moderation:** Built-in automatic swear-word filtering utilizing `swears.txt` and moderation tools (`tool_disableswear.php`).
- **Clean URLs:** Handled via Apache `.htaccess` configuration.

## ⚙️ Requirements

- **PHP** (v7.4 or higher recommended)
- **MySQL / MariaDB** (for database management)
- **Apache Web Server** with `mod_rewrite` enabled

## 🚀 Getting Started

1. **Clone or Download the Repository:**
   ```bash
   git clone https://github.com/your-username/PHP-Gopweet.git
   ```

2. **Deploy to your Web Server:**
   Move the contents of the `Source/` directory to your web server root directory (e.g., `htdocs` for XAMPP or `/var/www/html/` for Apache).

3. **Configure Database Connection:**
   Open `function.php` to configure your database credentials (Host, Database Name, Username, Password).

4. **Run the Application:**
   Open your browser and navigate to your local server URL (e.g., `http://localhost/PHP-Gopweet/`).

## 🤝 Contributing

Contributions, issues, and feature requests are welcome! Feel free to check issues page.

## 📝 License

This project is open-source and available under the [MIT License](LICENSE).
