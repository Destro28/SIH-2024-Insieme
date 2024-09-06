

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mine Guard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<style>
    #submission-history {
        margin: 50px auto;
        max-width: 700px;
        padding: 20px;
        background-color: #fefefe;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .history-container p {
        border-bottom: 1px solid #ccc;
        padding: 10px 0;
        font-size: 0.9rem;
        color: #555;
    }
    
</style>
<body>

    <!-- header -->
    <center>
    <header>
        <div class="fas fa-bars" id="menu"></div>

        <a href="#" class="logo"><i class="fa-solid fa-user-secret" style="color: white;"></i> MINE GUARD</a>

        <nav class="navbar">
            <ul>
                <li><a href="#" class="active">Home</a></li>
                <li><a href="#courses">Protocols</a></li>
                <li><a href="hazardreport.html">Report</a></li>
                <li><a href="contact.html">Contact</a></li>
            </ul>
        </nav>

        <a href="Login.html"><div id="login" class="fas fa-user"></div></a>

    </header>
    </center>

    
    <section class="home">
    <div class="image-container">
        <img src="coalworker.jpg" alt="student studying in laptop" class="image">
    </div>
    <div class="content">
        <h3>Register a new admin here!</h3>
        <a href="JOIN_US.html" class="button">Register</a>
    </div>
</section>

    </section>

    <!-- About -->
    <section id="about">
        <h2>ABOUT US</h2>
        <p>We the members of Team Insieme are committed to revolutionizing coal mine management through advanced technology. Our platform is designed to enhance productivity and ensure safety in coal mines by providing real-time monitoring, predictive analytics, and efficient resource management.

            We aim to create a safer working environment by minimizing risks and optimizing operational efficiency. Through data-driven insights, we empower mining companies to make informed decisions, reduce hazards, and boost productivity, ultimately contributing to a more sustainable mining industry.
            
            </p>
        <section class="container">
            <div class="box-container">
                <div class="box">
                   
                    <div class="box-content">
                        <h3>SAFE</h3>
                    </div>
                </div>
    
                <div class="box">
                    
                    <div class="box-content">
                        <h3>EFFICIENT</h3>
                    </div>
                </div>
    
                <div class="box">
                    
                    <div class="box-content">
                        <h3>REVOLUTIONARY</h3>
                        
                    </div>
                </div>
            </div>
        </section>
    </section>

    <!-- Courses -->
    <section id="courses">
        <h3>Protocols</h3>
        <div class="courses-box">
            <div class="course">
                <div class="img">
                    <img src="SMP.png" alt="HTML Image">
                </div>
                <div class="content">
                    <h3>Safety Management </h3>

                </div>
                <a href="course1.html" class="button">Click Here!</a>
            </div>
    
            <div class="course">
                <div class="img">
                    <img src="shifthand.png" alt="CSS Image">
                </div>
                <div class="content">
                    <h3>Shift Handover</h3>
                    
                </div>
                <a href="shift_details.html" class="button">Click Here!</a>
            </div>
    
            <div class="course">
                <div class="img">
                    <img src="report.png" alt="JavaScript Image">
                </div>
                <div class="content">
                    <h3>Shift Reports</h3>
                    
                </div>
                <a href="report_generate.php" class="button">Click Here!</a>
            </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="script.js"></script>

</body>
</html>