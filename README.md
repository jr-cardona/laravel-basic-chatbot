# Laravel 12 Project with OpenAI Integration

This is a Laravel 12 project with OpenAI integration to summarize texts using GPT. It also includes a simple chatbot interface built with Vue.js and Tailwind CSS.

![Alt text](/public/img/image.png)

## Requirements

To run this project locally, make sure you have the following installed:

- PHP: Version 8.2 or higher
- Composer: PHP dependency manager
- Node.js: Version 16.x or higher
- npm or yarn: Package managers for frontend dependencies

## System Requirements

- PHP 8.2+ (check with `php -v`)
- Laravel 12.x
- Node.js (verify with `node -v`)

## Installation

### Step 1: Clone the repository

Clone the repository to your local machine and navigate to the project directory.

### Step 2: Install dependencies

Install PHP dependencies using:
`composer install`

Install JavaScript dependencies using:
`npm install`

### Step 3: Configure the environment

1. Copy `.env.example` to `.env`
2. Generate application key: `php artisan key:generate`
3. Run migrations: `php artisan migrate --graceful`

### Step 4: Start the Development Server

Start the server with:
`php artisan serve`

### Step 5: Build Frontend Assets

For development:
`npm run dev`

For production:
`npm run build`

## API Endpoints

The project includes a simple API endpoint to generate text summaries using OpenAI.

**POST /api/summary**: Accepts a text string and returns a summary.

Request Body:
```json
{
  "text": "Your text to summarize here"
}
```

Response:
```json
{
  "summary": "The generated summary goes here."
}
```

## Development Commands

Here are some useful commands for development:

- Start development server:  
  `php artisan serve`

- Watch frontend assets:  
  `npm run dev`

- Build production assets:  
  `npm run build`

- Run migrations:  
  `php artisan migrate`

## Technologies Used

### Backend
- Laravel 12
- PHP 8.2+
- OpenAI API

### Frontend
- Vue.js 3
- Tailwind CSS
- Axios

## Environment Variables

Required variables in `.env`:
- OPENAI_API_KEY: Your OpenAI API key for accessing the GPT model.
- APP_ENV: Set to local during development, production for production environment.
- APP_DEBUG: Set to true for development, false for production.

## Deployment Notes

For production deployment:
1. Set `APP_ENV=production`
2. Run `npm run build`
3. Configure proper caching
4. Set up queue workers if using jobs

## License

MIT License - See [LICENSE](LICENSE) file for details.
