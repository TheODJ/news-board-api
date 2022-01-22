# About News Board API
This API is a Laravel Application for managing News posts and comments with CRUD functionality
- There are endpoints for adding a news post, updating, and deleting posts.
- There also exist endpoints for adding, updating, and deleting comments posts for which news posts is also updated
- There also exists an endpoint for upvoting a post
- Lastly, there is a scheduled job set up to reset the upvotes count per day

## To set up
- Clone this repository
- Copy `.env.example` to `.env` and edit environment variables to fit environment
- Change directory to installation directory and run `php artisan migrate` to migrate databases and set up locally
- Run `php artisan key:generate` to generate an application key for the application
- Import collection into Postman and test APIs

## Environment variables
- base_url: The base url of your API application e.g. `localhost:8000/api`
- post_author_name: The author of the news post being entered
- post_title: The title of the news post being entered
- post_url: The url of the news post being entered
- comment_author_name: The author of the comment being entered
- comment_post_id: The post id to be associated with the comment being entered
- comment_content: The content of the comment being entered
- post_id: The post id of the post being upvoted

## Collection Link and Documentation
- `https://documenter.getpostman.com/view/17990816/UVXqDrvm`

## Deployment Link on Heroku
- `https://odj-news-board-api.herokuapp.com/api/`

## To Run CRON Job
- SSH into your server
- Open a new crontab with `crontab -e`
- Insert `* * * * * cd /path-to-project && php artisan schedule:run >> /dev/null 2>&1`, then save