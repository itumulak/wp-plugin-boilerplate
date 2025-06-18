# WP Plugin Boilerplate

This is a modern approach (I think) built in the concept of **MVC architecture** and **Dependency Injection** design pattern. This boilerplate is ideal for building scalable, enterprise-level plugins that will power your WordPress application.

## 🚀 Features

✅ **MVC Architecture**: Separation of Models, Views, and Controllers for **maintainability and clean code**. <br>
✅ **Dependency Injection**: This promotes **loose coupling, testability, and reusability**. <br>
✅ **React Frontend**: Use modern JavaScript (React) for dynamic UI parts. <br>
✅ **Autoloading** via PSR-4 standards (Composer). <br>
✅ **Hook Management**: Organized action and filter registration. <br>
✅ **WP REST API**: Build robust, scalable RESTful endpoints using the native **WordPress REST API framework**. <br>
✅ **Scalable Structure**: Designed with scalability in mind — easy to extend without being **limited** by rigid architecture. <br>

## 📁 Project Structure

```
wp-plugin-boilerplate/
├── dist/                     # Compiled frontend assets (JS, CSS, images from React build)
├── includes/                 # Core backend architecture (MVC, routing, DI)
│   ├── Blocks/               # Registers Gutenberg blocks
│   ├── Controllers/          # Handles requests, connects models, returns responses or views
│   ├── Interfaces/           # PHP interfaces for loose coupling and consistent structure
│   ├── Models/               # Business logic and data representations
│   │   ├── Data/             # Data transfer objects (DTOs) and simple data structures
│   │   └── DB/               # Establish database connections and query logic
│   ├── RewriteRules/         # Custom WordPress rewrite rules
│   ├── Routes/               # Registers REST API routes
│   ├── Shortcodes/           # Custom WordPress shortcodes
│   └── PluginLoader.php      # Initializes and loads all components from `includes/`
├── Pages/                    # View layer / page entry points (React or PHP-based)
├── src/                      # React source code (uncompiled)
│   ├── blocks/               # React-based Gutenberg blocks
│   └── pages/                # React-based views/pages
├── vendor/                   # Composer-managed PHP dependencies
├── scripts/                  # Scripts for bundling Gutenburg blocks
├── index.php                 # WordPress fallback/index entry
├── wp-plugin-boilerplate.php # Main plugin bootstrap file
├── vite.config.js            # Vite configuration file for bundling
├── .gitignore                # List of ignored files and folders
├── package.json              # JavaScript package manifest (npm/yarn)
└── composer.json             # PHP dependencies and autoloader config
```

## ⚙️ Requirements

- PHP 7.4+
- WordPress 5.8+
- Node.js + npm (for React build)
- Composer

## 🛠️ Installation

1. **Clone the repository:**

```sh
git clone https://github.com/itumulak/wp-plugin-biolerplate.git
```

2. **Install PHP Dependencies**

```sh
composer install
```

3. **Install frontend dependencies and build React:**

```sh
npm install --legacy-peer-deps
```

4. **Activate the plugin in the WordPress admin dashboard.**

## 🧪 Development

### React Development

Ensure that your React components are registered in ``vite.config.js``.

```js
...
        v4wp({
            input: {
                samplenotes: 'src/pages/SampleNotes/main.jsx', // Add your react components.
            },
            outDir: 'dist'
        }),
    ],
...
```

To build and compile:

```sh
npm run build
```

### Gutenburg Development

Create your start Block:

```sh
cd ./src/blocks
npx @wordpress/create-block your-block-folder
```

To build and compile:

```sh
npm run build:blocks
```

### Compile plugin into ZIP

```sh
bash zip-project.sh
```

## 📋 TODOs
- Switch to Preact?
- Refactor and refine codebase for registering hooks.
- Utilize PHP Code Sniffer to the project. Go away with PSR-4?
- Add PHP unit test.
- ~~Provide Gutenburg support.~~

## 📜 License
[GPL v2](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)


