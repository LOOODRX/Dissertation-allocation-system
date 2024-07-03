

<p align="center">
  <i align="center">MSc Dissertation Topic Allocation System🚀</i>
</p>

## Introduction

The MSc Dissertation Topic Allocation System is a web application designed to simplify and optimize the process of selecting dissertation topics for master's degree students. Utilizing information technology and data-driven algorithms, the system automates the allocation process, enhancing efficiency and accuracy.

### Objectives

The primary objective of this study is to design, develop, and implement an MSc Dissertation Topic Allocation System that aims to meet the following key requirements and objectives:

- **Enhance efficiency and transparency in the topic selection process**: Traditional topic selection processes rely on physical or electronic files, which may suffer from lack of transparency and inefficiencies. The system's primary goal is to improve the efficiency of the topic selection process, ensuring faculty can easily upload topics, students can quickly view and select topics of interest, thereby accelerating the entire topic selection workflow.
- **Optimize student preference matching**: By introducing mechanisms for students to express preferences, the system aims to optimize the topic assignment process. Students can rate each topic, ensuring better alignment with their needs and interests.
- **Provide online allocation functionality**: The system will offer online allocation capabilities, enabling supervisors or course administrators to efficiently assign topics based on student preferences, academic backgrounds, and other relevant factors. This helps ensure topics are matched with students' research interests and potential, thereby enhancing the quality of graduate dissertation projects.
- **Data management and analytics**: The system will collect and display data related to the topic allocation process. This data will assist academic institutions and administrators in real-time monitoring of topic allocation, enabling informed policies and decisions through data analysis, ultimately optimizing management of graduate dissertation topic selections.

By achieving these objectives, the MSc Dissertation Topic Selection System is expected to improve and simplify traditional topic selection processes, enhance institutional management efficiency, and provide superior academic resources and support, thereby advancing graduate education and research.

</details>

## User Guide

The MSc Dissertation Topic Allocation System offers a user-friendly interface designed to streamline the process of dissertation topic allocation. Below are the steps to effectively utilize the system:

1. **Logging In**: Begin by logging into the system using your credentials. This ensures you have access to the necessary functionalities based on your user role (e.g., student, supervisor, administrator).

2. **View Available Topics**: Upon logging in, navigate to the dashboard or topic selection section. Here, you will find a list of available dissertation topics.

3. **Selecting a Topic**: Review the list of available topics and select a topic that aligns with your research interests and academic goals.

4. **Submitting Preferences**: Some systems allow students to submit their preferences regarding topics. If applicable, indicate your preferences to facilitate the allocation process.

5. **Supervisor Allocation**: Once topics are selected and preferences submitted, supervisors or administrators will allocate topics based on student preferences, academic criteria, and availability.

6. **Confirmation and Feedback**: After topic allocation, you will receive confirmation regarding your assigned dissertation topic. This step ensures transparency and clarity throughout the process.

7. **Monitoring Progress**: Throughout the dissertation process, use the system to monitor progress, submit updates, and communicate with supervisors as necessary.

8. **Completion and Submission**: Upon completion of your dissertation, use the system to submit the final dissertation document or any required materials.


Development
If you prefer to run the project locally instead of using the hosted version, follow these steps to set up your development environment.

<details open>
<summary>
Pre-requisites
</summary> <br />
Before you begin development on your Laravel project, ensure that you have the following prerequisites installed on your machine:
PHP (>= 7.4)
Composer
Node.js (recommended LTS version)
MySQL or another SQL database
Git
</details>
<details open>
<summary>
Running Laravel Project Locally
</summary> <br />
Clone the repository and install Composer dependencies:

bash
Copy code
git clone https://github.com/your_username/your_project.git
cd your_project
composer install
Copy the environment configuration file:

bash
Copy code
cp .env.example .env
Modify the .env file to set up your database connection and other environment-specific configurations.
Generate an application key:

bash
Copy code
php artisan key:generate
This command generates a unique application key for encryption purposes.
Run database migrations and seeders:

bash
Copy code
php artisan migrate --seed
Executes all pending migrations and optionally seeds the database with records.
Start the development server:

bash
Copy code
php artisan serve
Launches the development server at http://localhost:8000.
Additional Commands:

Laravel offers a variety of commands to help with development, such as:
bash
shell
# Run Laravel scheduler (if applicable)
php artisan schedule:run

# Clear application cache
php artisan cache:clear

# Run unit tests
php artisan test
Development Environment Setup Complete:

Your Laravel application is now set up locally. You can start making changes and testing features in your development environment.
</details>
Notes:
Environment Configuration:
Ensure all necessary environment variables are properly configured in the .env file, including database credentials and any API keys.
Development Best Practices:
Follow Laravel's conventions for organizing routes, controllers, models, and views to maintain a clean and scalable codebase.
Troubleshooting:
Refer to Laravel's documentation and community forums for troubleshooting and advanced usage tips.
