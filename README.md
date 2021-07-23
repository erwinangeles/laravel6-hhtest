## Overview

**Using Laravel 6 (since it is the current LTS release) implement the following:**

*   A user system with authentication and registration controllers/views

*   Include a separate user_attributes table that allows a user to enter and store their birthday, gender, and country

*   A user profile page that can only be viewed after logging in that lets them view and update their login details and attributes
*   A console command that will export users and their attributes to a CSV when run
*   Exposes a REST API that can be used to validate user credentials and get/update their attributes with authorized API key(s)

*   API key(s) can be a single key from pulled from an environment variable or a table in the DB that can store multiple keys, your choice

*   PHPUnit tests that provide code coverage for all the custom written code