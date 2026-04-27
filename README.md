# Font Awesome 6.x Icon Package for Laravel

A powerful Laravel package that provides seamless integration with Font Awesome 6.x icons. It includes an interactive icon picker, REST API for icon retrieval, and pre-populated database of all Font Awesome icons.

![Laravel](https://img.shields.io/badge/Laravel-8.0%2B-red)
![PHP](https://img.shields.io/badge/PHP-8.1%2B-blue)
![License](https://img.shields.io/badge/License-MIT-green)

## Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Quick Start](#quick-start)
- [Configuration](#configuration)
- [Usage](#usage)
  - [Using Helper Functions](#using-helper-functions)
  - [Using Views](#using-views)
  - [Using the API](#using-the-api)
  - [Using the Icon Model](#using-the-icon-model)
- [Publishing Assets](#publishing-assets)
- [API Reference](#api-reference)
- [Customization](#customization)
- [Troubleshooting](#troubleshooting)
- [Contributing](#contributing)
- [License](#license)

---

## Features

✨ **Complete Features Include:**

- 🎨 **Pre-populated Database** - All Font Awesome 6.x icon names included
- 🔍 **Interactive Icon Picker** - Ready-to-use icon selection component
- 📡 **REST API** - Retrieve icons programmatically with search capabilities
- 🛠️ **Helper Functions** - Quick template integration with `iconAssets()` and `iconInput()`
- 🗂️ **Blade Components** - Reusable icon input form component
- 📦 **Publishable Assets** - CSS and JavaScript fully customizable
- ⚡ **One-Command Setup** - `php artisan icon:install` handles everything
- 🔄 **Auto Migration** - Database setup handled automatically
- 🎯 **Search Functionality** - Filter icons by name in real-time

---

## Requirements

- **PHP**: 8.1 or higher
- **Laravel**: 8.0 or higher
- **Database**: MySQL, PostgreSQL, SQLite, or any Laravel-supported database
- **Composer**: Latest version

---

## Installation

### Step 1: Install via Composer

```bash
composer require abdur-rahaman/icon
```

### Step 2: Run Installation Command

The package uses Laravel's auto-discovery, so the service provider is automatically registered. Run the installation command:

```bash
php artisan icon:install
```

This command will:
- ✅ Publish CSS and JavaScript assets to `public/vendor/icon/`
- ✅ Publish routes to `routes/icon.php` (optional)
- ✅ Publish views to `resources/views/vendor/icon/` (optional)
- ✅ Run migrations and seed the icons database

### Step 3: Verify Installation

Check if assets are published:

```bash
ls public/vendor/icon/
```

You should see:
- `css/icon.css`
- `js/icon.js`

---

## Quick Start

### Basic Usage - Icon Picker Input

In your Blade template:

```blade
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Select an Icon</h1>
        
        {!! iconInput() !!}
    </div>
@endsection

@push('css')
    {!! iconAssets() !!}
@endpush
```

That's it! You now have a working icon picker.

---

## Configuration

The package works out-of-the-box with zero configuration. However, here are some optional configurations:

### Custom Database Table Name

If you need to use a different table name, publish and modify the migration:

```bash
php artisan vendor:publish --tag=icon-migrations
```

Then update the migration before running `php artisan migrate`.

### Custom Asset Path

Assets are published to `public/vendor/icon/` by default. To customize:

```bash
php artisan vendor:publish --tag=icon-assets --force
```

Then modify the paths in your Blade templates as needed.

---

## Usage

### 1. Using Helper Functions

The package provides two convenient helper functions:

#### `iconAssets()` - Load CSS and JavaScript

```blade
<!-- In your layout template -->
@push('css')
    {!! iconAssets() !!}
@endpush
```

This includes:
- Font Awesome 6.x CSS
- Icon picker JavaScript
- Hidden input with API endpoint URL

#### `iconInput()` - Icon Picker Component

```blade
<form method="POST" action="/save-icon">
    @csrf
    {!! iconInput() !!}
    <button type="submit">Save Icon</button>
</form>
```

Renders a complete icon input field with:
- Text input for icon search/display
- Interactive icon preview/selector
- Icon showcase display area

### 2. Using Views Directly

If you prefer more control, use the views directly:

```blade
@extends('layouts.app')

@section('content')
    <div class="form-group">
        <label>Choose Icon:</label>
        @include('icon::input')
    </div>
@endsection
```

### 3. Using the API

The package provides a REST API endpoint for fetching icons:

#### Get All Icons (First 100)

```bash
curl http://yourapp.test/icon/get
```

**Response:**
```json
[
    {"id": 1, "icon": "fa-home", "created_at": "2026-04-28...", "updated_at": "2026-04-28..."},
    {"id": 2, "icon": "fa-user", "created_at": "2026-04-28...", "updated_at": "2026-04-28..."},
    ...
]
```

#### Search Icons

```bash
curl "http://yourapp.test/icon/get?icon=home"
```

**Response:**
```json
[
    {"id": 1, "icon": "fa-home", "created_at": "2026-04-28...", "updated_at": "2026-04-28..."},
    {"id": 15, "icon": "fa-home-lg-alt", "created_at": "2026-04-28...", "updated_at": "2026-04-28..."}
]
```

#### JavaScript Example

```javascript
// Fetch all icons
fetch('/icon/get')
    .then(response => response.json())
    .then(data => console.log(data));

// Search for icons
fetch('/icon/get?icon=user')
    .then(response => response.json())
    .then(data => console.log(data));
```

### 4. Using the Icon Model

Access icons programmatically:

```php
<?php

use AbdurRahaman\Icon\Models\Icon;

// Get all icons
$icons = Icon::all();

// Search icons
$userIcons = Icon::where('icon', 'like', '%user%')->get();

// Get first 50 icons
$icons = Icon::take(50)->get();

// Paginate icons
$icons = Icon::paginate(20);
```

---

## Publishing Assets

The package allows you to publish and customize assets, routes, and views:

### Publish Assets Only

```bash
php artisan vendor:publish --tag=icon-assets
```

Assets will be copied to `public/vendor/icon/`

### Publish Views

```bash
php artisan vendor:publish --tag=icon-views
```

Views will be copied to `resources/views/vendor/icon/`

### Publish Routes

```bash
php artisan vendor:publish --tag=icon-routes
```

Routes will be copied to `routes/icon.php`

### Publish All

```bash
php artisan vendor:publish --provider="AbdurRahaman\Icon\IconServiceProvider"
```

---

## API Reference

### IconController

#### `get(Request $request)`

Retrieves icons from the database.

**Route:** `GET /icon/get`

**Parameters:**
- `icon` (optional, string): Filter icons by name using LIKE operator

**Response:** JSON array of icons

**Status Codes:**
- `200` - Success
- `503` - Server error

**Example Usage:**

```php
// In your controller
Route::get('/my-endpoint', function () {
    $response = Http::get('icon/get', [
        'icon' => 'home'
    ]);
    
    return $response->json();
});
```

### Icon Model

**Attributes:**
- `id` (integer, primary key)
- `icon` (string, unique) - Font Awesome icon class name (e.g., "fa-home")
- `created_at` (timestamp)
- `updated_at` (timestamp)

**Table Name:** `icons`

---

## Customization

### Customizing the Icon Input Component

Publish the views and modify `resources/views/vendor/icon/input.blade.php`:

```blade
<!-- Your custom version -->
<div class="custom-icon-input">
    <label for="custom-icon">{{ __("Select Icon") }}</label>
    <input 
        value="{{ isset($icon) ? $icon : '' }}" 
        type="text" 
        id="custom-icon" 
        class="form-control icon custom-class"
        data-icon="icon" 
        data-show="#custom-showcase"
    >
    <div id="custom-showcase"></div>
</div>
```

### Customizing CSS

Modify `public/vendor/icon/css/icon.css` after publishing:

```css
/* Example: Change icon picker colors */
.icon-picker {
    background-color: #f5f5f5;
}

.icon-item {
    border-radius: 8px;
}
```

### Customizing JavaScript

Modify `public/vendor/icon/js/icon.js` after publishing to add custom behavior:

```javascript
// Add event listeners, custom validations, etc.
document.addEventListener('DOMContentLoaded', function() {
    console.log('Custom icon picker initialization');
});
```

---

## Troubleshooting

### Issue: Icons table not created

**Solution:**
```bash
php artisan migrate
```

If that doesn't work, manually run:
```bash
php artisan migrate --path=vendor/abdur-rahaman/icon/src/database/migrations
```

### Issue: Assets not loading

**Solution:**
```bash
php artisan vendor:publish --tag=icon-assets --force
```

Then check permissions:
```bash
chmod -R 755 public/vendor/icon/
```

### Issue: API endpoint returns 503 error

**Solution:**
- Check database connection
- Ensure migrations have run
- Check for database errors in logs

### Issue: Icon picker component not appearing

**Solution:**
1. Verify helper functions are available:
   ```php
   php artisan tinker
   > iconInput()
   ```

2. Check that views are loaded in routes:
   ```bash
   php artisan route:list | grep icon
   ```

3. Ensure JavaScript and CSS are loaded:
   ```bash
   php artisan vendor:publish --tag=icon-assets --force
   ```

### Issue: Search functionality not working

**Solution:**
- Check browser console for JavaScript errors
- Verify API endpoint URL in hidden input:
  ```html
  <input type="hidden" id="icon_url" value="{{ route('icon.get') }}">
  ```
- Test API manually:
  ```bash
  curl "http://yourapp.test/icon/get?icon=home"
  ```

---

## Advanced Usage

### Custom Search Endpoint

Create a custom controller that extends the default functionality:

```php
<?php

namespace App\Http\Controllers;

use AbdurRahaman\Icon\Models\Icon;
use Illuminate\Http\Request;

class CustomIconController extends Controller
{
    public function advancedSearch(Request $request)
    {
        $query = $request->get('q');
        
        $icons = Icon::where('icon', 'like', "%{$query}%")
            ->where('icon', 'not like', '%circle%') // Exclude certain patterns
            ->limit(50)
            ->get();
        
        return response()->json($icons);
    }
}
```

Register in `routes/web.php`:

```php
Route::get('/custom-icon-search', [CustomIconController::class, 'advancedSearch']);
```

### Caching Icons

Improve performance by caching icon results:

```php
<?php

use AbdurRahaman\Icon\Models\Icon;
use Illuminate\Support\Facades\Cache;

$icons = Cache::remember('all_icons', 60 * 60 * 24, function () {
    return Icon::all();
});
```

### Validation

Validate icon selections in your forms:

```php
<?php

public function store(Request $request)
{
    $validated = $request->validate([
        'icon' => 'required|exists:icons,icon',
    ]);
    
    // Process validated icon
}
```

---

## Contributing

Contributions are welcome! Please follow these guidelines:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

### Development Setup

```bash
# Clone repository
git clone https://github.com/abdur-rahaman/icon.git

# Install dependencies
composer install

# Run tests (if available)
php artisan test
```

---

## License

This package is open-sourced software licensed under the MIT license. See the LICENSE file for details.

---

## Support

For issues, questions, or suggestions:

- 📧 Email: abdur.babu84@gmail.com
- 🐛 GitHub Issues: [Report a bug](https://github.com/abdur-rahaman/icon/issues)
- 💬 Discussions: [Ask a question](https://github.com/abdur-rahaman/icon/discussions)

---

## Changelog

### Version 1.0.0 (2026-04-28)

**Initial Release**
- Complete Font Awesome 6.x icon database
- Interactive icon picker
- REST API for icon retrieval
- Helper functions
- Auto-installation command
- Blade components and views

---

## Credits

- **Author**: Abdur Rahaman
- **Email**: abdur.babu84@gmail.com
- **Font Awesome**: Font Awesome 6.x icons library

---

**Made with ❤️ for the Laravel community**
