

<p align="center">
  <i align="center">MSc Dissertation Topic Allocation System🚀</i>
</p>

## Introduction

The MSc Dissertation Topic Allocation System is a web application designed to simplify and optimize the process of selecting dissertation topics for master's degree students. Utilizing information technology and data-driven algorithms, the system automates the allocation process, enhancing efficiency and accuracy.

<details>
<summary>Features</summary>
<br />

### Automated Topic Allocation:
Utilizes data-driven algorithms to automatically allocate dissertation topics to students, improving efficiency and accuracy of assignments.

### Online Topic Management:
Provides an online interface for teachers to upload and manage dissertation topics, allowing students to browse and select topics of interest.

### Student Preference Matching:
Enables students to rate and submit preferences for topics, facilitating optimal matching based on individual interests.

### Real-time Data Analysis:
Collects and displays data related to topic allocation, enabling administrators to monitor and optimize the process in real-time.

### User Role Management:
Includes roles for students, teachers, and administrators with distinct permissions and functionalities, ensuring secure and efficient system operation.

</details>


### Motivation

As graduate students near the culmination of their academic journey, they face a critical academic milestone - completing their dissertation projects. This pivotal phase typically revolves around the selection of suitable dissertation topics, a process that in practice proves time-consuming. It demands multiple meetings and consultations with potential supervisors, requiring careful evaluation of research interests and academic expertise.

Course administrators play a crucial role in the dissertation topic selection process, balancing the need for rapid topic assignment while ensuring students are matched with topics aligned with their academic pursuits. This traditional approach, often lacking in information technology solutions, tends to be inefficient and prone to errors, thereby compromising the precision of the entire topic selection process.

To effectively address these complex challenges, a technology-driven solution becomes a promising approach. This solution leverages information technology and data-driven algorithms to automate and enhance the dissertation topic assignment process. In this context, developing a web-based application becomes particularly critical, aiming to simplify and optimize the assignment process. The application allows students to seamlessly submit their topic preferences through an online system, utilizes sophisticated automated allocation algorithms to strive for optimal matches of dissertation topics for each student, maintaining efficiency and accuracy.

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


## Development

Alternatively, instead of using the hosted version of the product, Amplication can be run locally for code generation purposes or contributions - if so, please refer to our [contributing](#contributing_anchor) section.

<details open>
<summary>
Pre-requisites
</summary> <br />
To be able to start development on Amplication, make sure that you have the following prerequisites installed:

###

- Node.js
- Docker
- Git
</details>

<details open>
<summary>
Running Amplication
</summary> <br />

> **Note**
> It is also possible to start development with GitHub Codespaces, when navigating to `< > Code`, select `Codespaces` instead of `Local`. Click on either the `+`-sign or the `Create codespace on master`-button.

Amplication is using a monorepo architecture - powered by <a href="https://nx.dev">Nx Workspaces</a> - where multiple applications and libraries exist in a single repository. To setup a local development environment the following steps can be followed:

**BEFORE** you run the following steps make sure:
1. You have typescript installed locally on you machine ```npm install -g typescript```
2. You are using a supported node version (check `engines` `node` in the [package.json](./package.json))
3. You are using a supported npm version (check `engines` `npm` in the [package.json](./package.json))
4. You have `docker` installed and running on your machine


1. Clone the repository and install dependencies:
```shell
git clone https://github.com/amplication/amplication.git && cd amplication && npm install

2. Run the setup script, which takes care of installing dependencies, building packages, and setting up the workspace:
```shell
npm run setup:dev

3. Running the required infrastructure - view infrastructure component logs
```shell
npm run docker:dev

4. Apply database migrations
```shell
npm run db:migrate:deploy

5. To start developing, run one or more of the applications available under serve:[application] scripts of the package.json.
```shell
# running the server component
npm run serve:server

# running the client component
npm run serve:client

# running the data-service-generator component
npm run serve:dsg

# running the git-sync-manager component
npm run serve:git

# running the plugin-api component
npm run serve:plugins

Note
In order to run the Amplication client properly, both the client and server need to be started by the npm run serve:[application] command, as well as an additional component for development on a specific component.

The development environment should now be set up. Additional information on the different application components can be found under packages/[application]/README.md file. Happy hacking! 👾

</details>
