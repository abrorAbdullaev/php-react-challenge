# React PHP Coding Challenge

## General
The app is built using PHP and React and they both work together.
To be able to see the working app you will have to set up the environment

Unfortunately the docker is not supported in Win10 Home edition, so I could not wrap everything into docker for easier set up
The state of the codebase is not ideal and still has lots to improve such as wrigin tests for frontend app, also covering backend with more tests
Optimising the frontend actions and reducers to perform less work, Creating better error handling on frontend and on backend and etc... but for the showcase I think enough work has been done

## Set Up
(backend)
 - Clone the repo (Only once for backend and frontend)
 - Switch to backend `cd backend`
 - Set up the server to serve backed/index.php
 - run `composer install` if you want to run tests too or just `composer dumpautoload` if you skip tests run
 - send a test request from browser to `{base_url}/?c=jobs`

(frontend)
 - Clone the repo (Only once for backend and frontend)
 - Switch to frontend `cd frontend`
 - run `npm install`
 - change the backend ulr in JobsService according to your back end url in `frontend\src\Services\JobsService.tsx::4`
 - run `npm run start`