<h1 align="center">Quickblaze Encrypt 🔥</h1>

<p align="center">
  <img alt="GitHub release (latest by date)" src="https://img.shields.io/github/v/release/arizon-dev/quickblaze-encrypt?label=Version">
  <a href="https://github.com/arizon-dev/quickblaze-encrypt/blob/main/LICENSE" target="_blank">
    <img alt="License: MIT" src="https://img.shields.io/badge/License-MIT-yellow.svg" />
  </a>
  <a href="https://www.codacy.com/gh/arizon-dev/quickblaze-encrypt/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=arizon-dev/quickblaze-encrypt&amp;utm_campaign=Badge_Grade"><img src="https://app.codacy.com/project/badge/Grade/3d4571a7a1a34c548bce562c16ba1221"/></a>
  <a href="https://github.com/arizon-dev/quickblaze-encrypt/actions/workflows/codacy.yml"><img src="https://github.com/arizon-dev/quickblaze-encrypt/actions/workflows/codacy.yml/badge.svg"/></a>
  <a href="https://arizon.dev?discord" target="_blank">
    <img alt="Discord: axtonprice" src="https://discord.com/api/guilds/826239258590969897/widget.png?style=shield" />
  </a>
</p>

> An extremely simple, one-time view encryption system. Send links anywhere on the internet, and the encrypted message will automatically be destroyed after being viewed once!

### ✨ [Click to view Demo](https://quickblaze.arizon.dev)


## Requirements

- PHP v7 or higher.
- Accessible webserver with PHP support.
- MySQL server for database host.
- PHP [MBSTRING](http://php.net/manual/en/book.mbstring.php) module for full UTF-8 support.
- PHP [JSON](http://php.net/manual/en/book.json.php) module for JSON manipulation.

## Installation

1. Download the latest version of Quickblaze from the <a href="https://github.com/arizon-dev/quickblaze-encrypt/releases">releases page</a>. 
2. Upload and extract the contents to your web server. You can also pull the repo with `git pull`.
3. Visit your domain installation directory or subdomain https://example.com/quickblaze-encrypt/

**Don't** delete the `.version`, `.config`, or `.cache` files once the installation has completed! They contain necessary version and configuration data, and removing them will cause issues!

If using MYSQL as storage method:
* Update the database information in `Modules/Database_example.env`.
* Rename the database configuration file to `Database.env`.
* View example database configuration below.



## System Configurations
Example configuration of `Database.env`.
```json
{
    "HOSTNAME": "mysql.example.com", // Database Host
    "USERNAME": "admin", // Database Username
    "PASSWORD": "admin123", // Database Password
    "DATABASE": "quickblaze_db" // Database Name
}
```
Example configuration of `.config`.
```json
{ 
  "STORAGE_METHOD": "mysql", // options: 'mysql', 'filetree'
  "LANGUAGE": "auto", // options: 'auto', 'en', 'ru', 'is', etc.
  "INSTALLATION_PATH": "https://quickblaze.com" // No trailing slash
}
```

## What is Quickblaze?

This tool provides users with the ability to create private messages that are both secure and shareable, thanks to an encryption method that guarantees the message can only be decrypted once. In addition, the tool allows users to input a decryption password that they can share with the recipient to access the message. The message is then stored either locally or in the configured MySQL database allowing for customisation in how the messages are stored. 

In the event that you misplace your password or decryption key*, it will be impossible to access the encrypted message. Your decryption key serves to verify your password and to decrypt the message contents. It's important to keep in mind that the Arizon team will not provide any assistance in retrieving passwords for messages that were created on the Quickblaze project site.

> When you create a message, a decryption key is generated, and it can be viewed in the URL of your message. For instance, in the URL `https://quickblaze.com/view?key=fb304cb9b3d8d38d82`, the decryption key would be `fb304cb9b3d8d38d82`.

## Screenshots

<p align="center">
  <!-- Light Mode -->
  <img height="160" src=".github/images/screenshots/lightmode-1.png">
  <img height="160" src=".github/images/screenshots/lightmode-2.png">
  <img height="160" src=".github/images/screenshots/lightmode-3.png">
  <img height="160" src=".github/images/screenshots/lightmode-4.png">
</p>
  
## Authors and Contributors

👤 **axtonprice** - Main Author

* Discord: [discord.gg/dP3MuBATGc](https://discord.gg/dP3MuBATGc)
* Twitter: [@axtonprice](https://twitter.com/axtonprice)
* Github: [@axtonprice](https://github.com/axtonprice)

## Show your support

* If you like this project, give a star to support us! ⭐️
* If you LOVE this project, you can also [become a supporter](https://github.com/sponsorships/arizon-dev)! ❤️

## 📝 License

Copyright © 2023 [axtonprice](https://github.com/axtonprice) & [Arizon Software](https://github.com/arizon-dev).<br />
This project is [MIT](https://github.com/arizon-dev/quickblaze-encrypt/blob/main/LICENSE) licensed.

<hr>

<a href="https://discord.gg/dP3MuBATGc"><img src="https://discord.com/api/guilds/826239258590969897/widget.png?style=banner3"/></a>
<!-- end: README.md -->