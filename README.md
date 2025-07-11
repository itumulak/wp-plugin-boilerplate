# WP Plugin Boilerplate

This is a modern approach (I think) for building Enterprise WordPress plugins. I have consolidated all necessary tech stack that I know off that makes building scalable, enterprise-level plugins that will power your WordPress application.
## 🚀 Features

✅ **MVC Architecture**: Separation of Models, Views, and Controllers for **maintainability and clean code**. <br>
✅ **Dependency Injection**: This promotes **loose coupling, testability, and reusability**. <br>
✅ **React Frontend**: Use modern JavaScript (React) for dynamic UI parts. <br>
✅ **Autoloading** via PSR-4 standards (Composer). <br>
✅ **Hook Management**: Organized action and filter registration. <br>
✅ **WP REST API**: Build robust, scalable RESTful endpoints using the native **WordPress REST API framework**. <br>
✅ **Scalable Structure**: Designed with scalability in mind — easy to extend without being **limited** by rigid architecture. <br>
✅ **Unit testing**: Built-in PHPUnit setup for testing use cases — helps catch regressions early and ensures code reliability. <br>
✅ **PHP Code Sniffers**: Enforces **WordPress Coding Standards** using phpcs to maintain code consistency and improve readability. <br>

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
│   ├── Roles/                # Custom WordPress roles
│   ├── Routes/               # Registers REST API routes
│   ├── Shortcodes/           # Custom WordPress shortcodes
│   └── PluginLoader.php      # Initializes and loads all components from `includes/`
├── Pages/                    # View layer / page entry points (React or PHP-based)
├── src/                      # React source code (uncompiled)
│   ├── blocks/               # React-based Gutenberg blocks
│   └── pages/                # React-based views/pages
├── tests/                    # PHPUnit tests (unit/integration tests for Models, Controllers, Routes, etc.)
├── vendor/                   # Composer-managed PHP dependencies
├── scripts/                  # Scripts for bundling Gutenburg blocks
├── index.php                 # WordPress fallback/index entry
├── wp-plugin-boilerplate.php # Main plugin bootstrap file
├── vite.config.js            # Vite configuration file for bundling
├── .gitignore                # List of ignored files and folders
├── package.json              # JavaScript package manifest (npm/yarn)
├── phpcs.xml                 # PHP_CodeSniffer configuration (defines coding standard, e.g. WordPress)
├── phpunit.xml               # PHPUnit configuration file (bootstrap file, coverage, test suites)
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
composer zip
```

## Detecting code violation and auto-fixes

For checking for formatting issues:

```sh
composer phpcs <REPLACE_WITH_PHP_PATH_FILES>

```

To fix formats and coding violation. For simple formats/violation only:

```sh
composer phpcbf <REPLACE_WITH_PHP_PATH_FILES>
```

By default we are using WordPress coding standard for sniffing out code violation. I have filter out a few rule here. Feel free modify ``phpcs.xml`` if you want modify the sniffer rules to meet your objectives.

## Unit Testing

To unit test:

```sh
composer test
```

Feel free to include your own unit test to meet your objectives.

## Github Workflow (CI)

This project includes a Github Workflow. It simply run unit testing and PHPCS for code violation. Feel free to add more steps.

## 📋 TODOs
- Switch to Preact?
- Improve handling of database table changes.
- ~~Add GitHub workflows.~~
- ~~Refactor and refine codebase for registering hooks.~~
- ~~Utilize PHP Code Sniffer to the project. Go away with PSR-4?~~
- ~~Add PHP unit test.~~
- ~~Provide Gutenburg support.~~

## 📜 License
[GPL v2](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)
