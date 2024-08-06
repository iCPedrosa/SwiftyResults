<?php
if (isset($_POST['name'])): ?>



    <?php 
    $name = $_POST['name'];$name = $_POST['name']; 
    if ($name == 'schematest'):
    ?>
    SCHEMA: 

    CREATE TABLE newsletter_subscriptions (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL,
        submission_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    <?php endif ?>
<?php endif ?>