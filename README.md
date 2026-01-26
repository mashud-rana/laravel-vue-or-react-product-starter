# Laravel Vue or React Product Starter

Modern Full-Stack Application Starter Kit

## Description

This is a Laravel Vue/React product starter kit for building modern web applications. It uses Laravel 12 as the backend API and supports both Vue.js and React 18 with Vite for the frontend. The project follows modern development practices with a clean separation between backend and frontend, making it perfect for starting any new web application project.

## Prerequisites

Before you begin, ensure you have met the following requirements:

-   [Node.js](https://nodejs.org/) installed v22 stable
-   [Composer](https://getcomposer.org/) installed v2.7.4
-   [PHP](https://www.php.net/) installed v^8.3
-   [Laravel](https://laravel.com/) v12
-   [Vue.js](https://vuejs.org/) v3+ or [React](https://react.dev/) v18.3+ (Choose one or use both)
-   [Vite](https://vitejs.dev/) v6.4+
-   [Bun](https://bun.sh/docs/installation) (Preferred) or [NPM](https://www.npmjs.com/) or [Yarn](https://yarnpkg.com/)

## Setup Instructions

To set up this project locally, follow these steps:

1. Clone the repository:

    ```bash
    git clone <your-repository-url>
    ```

2. Navigate into the project directory:

    ```bash
    cd laravel-vue-or-react-product-starter
    ```

3. Install PHP dependencies using Composer:

    ```bash
    composer install
    ```

4. Install JavaScript dependencies using NPM or Yarn:

    ```bash
    bun install
    ```
   ### or
    ```bash
    npm install
    ```
   ### or

    ```bash
    yarn install
    ```

5. Copy the `.env.example` file and rename it to `.env`:

    ```bash
    cp .env.example .env
    ```

6. Generate an application key:

    ```bash
    php artisan key:generate
    ```

7. Configure your database settings in the `.env` file.

8. Run database migrations:

    ```bash
    php artisan migrate
    ```

9. Setup passport:

    ```bash
    php artisan passport:keys
    ```

    ```bash
    php artisan passport:client --personal --name="laravel-vue-or-react-product-starter"
    ```

10. Compile front-end assets:

    ```bash
    bun run dev
    # or
    npm run dev
    # or
    yarn dev
    ```

11. Start the development server:

    ```bash
    php artisan serve
    ```

12. Visit `http://localhost:8000` in your browser to see the application.

## Project Structure

```
laravel-vue-or-react-product-starter/
├── app/                    # Laravel backend
│   ├── Http/Controllers/  # API Controllers
│   ├── Models/            # Eloquent Models
│   └── Services/          # Business Logic
├── resources/
│   ├── js/                # Vue/React Frontend
│   │   ├── components/    # Vue/React Components
│   │   ├── pages/         # Page Components
│   │   ├── utils/         # Utility Functions
│   │   └── app.jsx        # Main React Entry (or app.js for Vue)
│   └── views/             # Blade Templates (for mounting Vue/React)
├── routes/
│   ├── api.php            # API Routes
│   └── web.php            # Web Routes
├── vite.config.js         # Vite Configuration
└── package.json           # Node Dependencies
```

## React Usage Examples

### 1. Creating a React Component

Create a new component in `resources/js/components/`:

```jsx
// resources/js/components/CourseCard.jsx
import React from 'react';

const CourseCard = ({ course }) => {
    return (
        <div className="card">
            <div className="card-body">
                <h5 className="card-title">{course.title}</h5>
                <p className="card-text">{course.description}</p>
                <span className="badge bg-primary">{course.category}</span>
            </div>
        </div>
    );
};

export default CourseCard;
```

### 2. Using React Hooks with API Calls

```jsx
// resources/js/components/CourseList.jsx
import React, { useState, useEffect } from 'react';
import axios from 'axios';
import toast from 'react-hot-toast';

const CourseList = () => {
    const [courses, setCourses] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        fetchCourses();
    }, []);

    const fetchCourses = async () => {
        try {
            const response = await axios.get('/api/courses');
            setCourses(response.data);
        } catch (error) {
            toast.error('Failed to load courses');
        } finally {
            setLoading(false);
        }
    };

    if (loading) {
        return <div className="spinner-border">Loading...</div>;
    }

    return (
        <div className="course-list">
            {courses.map(course => (
                <CourseCard key={course.id} course={course} />
            ))}
        </div>
    );
};

export default CourseList;
```

### 3. Form Handling with React

```jsx
// resources/js/components/SubscriberForm.jsx
import React, { useState } from 'react';
import axios from 'axios';
import toast from 'react-hot-toast';

const SubscriberForm = () => {
    const [formData, setFormData] = useState({
        first_name: '',
        last_name: '',
        email: '',
        phone: ''
    });

    const handleChange = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            await axios.post('/api/subscribers', formData);
            toast.success('Subscriber created successfully');
            setFormData({ first_name: '', last_name: '', email: '', phone: '' });
        } catch (error) {
            toast.error('Failed to create subscriber');
        }
    };

    return (
        <form onSubmit={handleSubmit}>
            <input
                type="text"
                name="first_name"
                value={formData.first_name}
                onChange={handleChange}
                placeholder="First Name"
                required
            />
            <input
                type="text"
                name="last_name"
                value={formData.last_name}
                onChange={handleChange}
                placeholder="Last Name"
                required
            />
            <input
                type="email"
                name="email"
                value={formData.email}
                onChange={handleChange}
                placeholder="Email"
                required
            />
            <button type="submit">Create Subscriber</button>
        </form>
    );
};

export default SubscriberForm;
```

### 4. Mounting React Components in Blade

```php
<!-- resources/views/subscribers/dashboard.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Subscriber Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.jsx'])
</head>
<body>
    <div id="subscriber-dashboard" 
         data-subscriber-id="{{ $subscriber->id }}"
         data-api-url="{{ config('app.url') }}/api">
    </div>
</body>
</html>
```

```jsx
// resources/js/app.jsx
import React from 'react';
import { createRoot } from 'react-dom/client';
import SubscriberDashboard from './components/SubscriberDashboard';

// Mount Subscriber Dashboard
const subscriberDashboardEl = document.getElementById('subscriber-dashboard');
if (subscriberDashboardEl) {
    const subscriberId = subscriberDashboardEl.dataset.subscriberId;
    const apiUrl = subscriberDashboardEl.dataset.apiUrl;
    
    createRoot(subscriberDashboardEl).render(
        <SubscriberDashboard subscriberId={subscriberId} apiUrl={apiUrl} />
    );
}
```

### 5. Using Translation Helper

```jsx
// resources/js/utils/translate.js
export const __ = (key, replace = {}) => {
    let translation = window.translations?.[key] || key;
    Object.keys(replace).forEach(replaceKey => {
        translation = translation.replace(`:${replaceKey}`, replace[replaceKey]);
    });
    return translation;
};
```

```jsx
// Usage in component
import { __ } from '../utils/translate';

const WelcomeMessage = ({ name }) => {
    return <h1>{__('Welcome, :name', { name })}</h1>;
};
```

## Available Scripts

```bash
# Development mode with hot reload
bun run dev

# Build for production
bun run build

# Watch mode (auto-rebuild on changes)
bun run watch
```

## Key Technologies

### Frontend
- **React 18.3** - UI Library
- **Vite 6.4** - Build Tool & Dev Server
- **Axios** - HTTP Client
- **React Hot Toast** - Toast Notifications
- **Lucide React** - Icon Library

### Backend
- **Laravel 12** - PHP Framework
- **Laravel Passport** - API Authentication
- **MySQL/PostgreSQL** - Database

## API Endpoints

### Subscribers
```
GET    /api/subscribers         - List all subscribers
GET    /api/subscribers/{id}    - Get subscriber details
POST   /api/subscribers         - Create subscriber
PUT    /api/subscribers/{id}    - Update subscriber
DELETE /api/subscribers/{id}    - Delete subscriber
```

### Tools & Services
```
GET    /api/tools               - List all available tools
GET    /api/tools/{id}          - Get tool details
POST   /api/subscriptions       - Subscribe to a tool or bundle
GET    /api/subscriptions       - Get user subscriptions
```

## Development Tips

1. **Hot Module Replacement (HMR)**: Vite provides instant feedback when you save changes
2. **Component Structure**: Keep components small and focused on a single responsibility
3. **State Management**: Use React hooks (useState, useEffect) for component state
4. **API Integration**: Use axios with async/await for clean API calls
5. **Error Handling**: Always wrap API calls in try-catch blocks
6. **Toast Notifications**: Use react-hot-toast for user feedback

## Troubleshooting

### Vite manifest not found
```bash
bun run build
```

### React component not rendering
- Check that the mount point div ID matches
- Verify @vite directive is in the blade template
- Check browser console for errors

### API 404 errors
- Ensure Laravel routes are defined in `routes/api.php`
- Check API URL configuration
- Verify CSRF token if needed

## Authors of this repo

### Regards  [Zahid Hassan Shaikot](https://github.com/zahidhassanshaikot/)

## Contributors
- [Zahid Hassan Shaikot](https://github.com/zahidhassanshaikot/)
- [A Awal Hadi](https://github.com/awalhadi)
