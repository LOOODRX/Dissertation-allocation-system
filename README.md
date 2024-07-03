<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MSc Dissertation Topic Allocation System - README</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2, h3 {
            color: #333;
        }
        p {
            margin: 10px 0;
        }
        code {
            background: #e6e6e6;
            padding: 2px 4px;
            font-family: monospace;
        }
        .badge {
            display: inline-block;
            padding: 5px 10px;
            font-size: 12px;
            color: #fff;
            background-color: #007bff;
            border-radius: 3px;
        }
        .section {
            margin-bottom: 20px;
        }
        .code-block {
            background: #e6e6e6;
            padding: 10px;
            border-radius: 3px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>MSc Dissertation Topic Allocation System</h1>

        <span class="badge">MIT License</span>

        <div class="section">
            <h2>Introduction</h2>
            <p>The MSc Dissertation Topic Allocation System is a web application designed to simplify and optimize the process of selecting dissertation topics for master's degree students. Utilizing information technology and data-driven algorithms, the system automates the allocation process, enhancing efficiency and accuracy.</p>
        </div>

        <div class="section">
            <h2>Table of Contents</h2>
            <ul>
                <li><a href="#introduction">Introduction</a></li>
                <li><a href="#motivation-and-aims">Motivation and Aims</a></li>
                <li><a href="#installation-guide">Installation Guide</a></li>
                <li><a href="#usage-instructions">Usage Instructions</a></li>
                <li><a href="#contributing">Contributing</a></li>
                <li><a href="#license">License</a></li>
                <li><a href="#acknowledgements">Acknowledgements</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>

        <div class="section">
            <h2 id="motivation-and-aims">Motivation and Aims</h2>
            <h3>Motivation</h3>
            <p>As graduate or postgraduate studies approach their conclusion, students face a pivotal academic milestone – the completion of a dissertation project. This critical phase often revolves around the intricate process of selecting a fitting dissertation topic, which, in practice, proves to be a time-intensive endeavor. It necessitates multiple meetings and consultations between students and potential advisors, demanding a meticulous assessment of research interests and academic specialization.</p>
            <p>Adding to the complexity of this topic selection process is the involvement of course administrators, tasked with the responsibility of orchestrating the allocation of these dissertation topics. Balancing the need for swift topic assignment while ensuring students are aligned with topics that harmonize with their academic pursuits adds a layer of intricacy to the allocation procedure. Unfortunately, due to the absence of information technology solutions to streamline these tasks, course administrators often revert to conventional, manual methods for topic allocation. This conventional approach, while well-intentioned, often leads to inefficiencies and opens the door to potential errors, ultimately undermining the precision of the entire topic selection process.</p>
            <p>To effectively address these multifaceted challenges, a technology-driven solution emerges as a promising avenue. Such a solution capitalizes on the potential of information technology and data-driven algorithms to automate and enhance the dissertation topic allocation process. In this context, the development of a web-based application emerges as a compelling solution, designed to streamline and optimize the allocation process. This application empowers students to submit their topic preferences seamlessly through an online volunteering system. Leveraging a sophisticated automated topic allocation algorithm, the application endeavors to match each student with the most suitable dissertation topic, all while maintaining efficiency and precision.</p>
            <h3>Aims</h3>
            <p>The primary objective of this research is to design, develop, and implement MSc Dissertation Topic Allocation System aimed at meeting the following key requirements and aims:</p>
            <ul>
                <li><strong>Enhancing Efficiency and Transparency in Topic Selection Process:</strong> Traditional topic selection processes often rely on paper-based or electronic documents, which may suffer from issues such as lack of transparency and time inefficiency. The foremost goal of this system is to enhance the efficiency of the topic selection process, ensuring that teachers can conveniently upload topics, and students can quickly view and choose topics of interest, thereby expediting the entire topic selection workflow.</li>
                <li><strong>Optimizing Student Preference Matching:</strong> By introducing a mechanism for students to express their preferences, the system aims to optimize the topic allocation process. Students can provide feedback for each topic, rating them on a scale of 1 to 10 based on their interests, ensuring better alignment with their needs and interests.</li>
                <li><strong>Providing Online Allocation:</strong> The system will offer online allocation functionality, allowing supervisor or module owner to effectively allocate topics to appropriate students based on their preferences, academic backgrounds, and other relevant factors. This helps ensure that topics are matched with students' research interests and potential, ultimately enhancing the quality of graduate dissertation projects.</li>
                <li><strong>Data Management and Analysis:</strong> The system will collect and display data relevant to the topic selection process. This data will assist academic institutions and administrators in real-time monitoring of topic allocation, allowing them to promptly identify students who have not yet been allocated topics. Through data analysis, institutions can make more informed policies and decisions, ultimately optimizing the management of graduate dissertation topics.</li>
            </ul>
        </div>

        <div class="section">
            <h2 id="installation-guide">Installation Guide</h2>
            <h3>System Requirements</h3>
            <ul>
                <li>Operating System: Windows, macOS, Linux</li>
                <li>Dependencies: Node.js, npm, MongoDB</li>
            </ul>
            <h3>Installation Steps</h3>
            <ol>
                <li>Clone the repository:
                    <div class="code-block">
                        <code>git clone https://github.com/yourusername/your-repo-name.git</code>
                    </div>
                </li>
                <li>Navigate to the project directory:
                    <div class="code-block">
                        <code>cd your-repo-name</code>
                    </div>
                </li>
                <li>Install dependencies:
                    <div class="code-block">
                        <code>npm install</code>
                    </div>
                </li>
                <li>Configure database connection:
                    <div class="code-block">
                        <code>Edit `config/database.js` file to add your MongoDB connection string.</code>
                    </div>
                </li>
                <li>Start the application:
                    <div class="code-block">
                        <code>npm start</code>
                    </div>
                </li>
            </ol>
        </div>

        <div class="section">
            <h2 id="usage-instructions">Usage Instructions</h2>
            <h3>User Interfaces</h3>
            <p>In this section, the displayed screenshots are taken from a Windows operating system.</p>
            <h4>Login Page</h4>
            <p>As shown in Figure 4, the first interface users encounter when initially opening the application through a web page is the login screen. Users have the option to enter their account credentials on this page to access the application. In the event that a system user enters incorrect account information during login attempts, the login screen will display corresponding error messages.</p>
            <h4>Home Page</h4>
            <p>Access to the application is granted only when users correctly input their account credentials. Upon successful login, they are redirected to the homepage corresponding to their role within the application. On the homepage's left-side bar, users can find distinct functional buttons tailored to their respective roles. For student login, refer to Figure 4. Module owner login homepage is depicted in Figure 5. Supervisor's login homepage is depicted in Figure 6.</p>
            <h4>Upload Topic</h4>
            <p>Module owners and supervisors can access the "Upload Topics" page by clicking on the sidebar, as depicted in Figure 8. Once on this page, they can select a CSV file and click the "Upload" button to transfer the data from the CSV file into the "topic_data" table. Typically, supervisors only upload updates to their own topics, while module owners upload all the topics that have been reviewed and approved.</p>
            <h4>View Topic List</h4>
            <p>All users can access the "View Topic List" page by clicking
