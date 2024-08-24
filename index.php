<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SwiftyResults</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logoswiftyresults.png" rel="icon">
  <link href="assets/img/logoswiftyresults.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">


  <!-- =======================================================
  * Template Name: SwiftyResults
  * Template URL: https://bootstrapmade.com/SwiftyResults-bootstrap-startup-template/
  * Updated: Mar 17 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- ======= CHAT BOT ================================ ======= -->
  <title>Chat Button</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">



  <div class="chat-button" id="chatButton" onclick="toggleChat()"><i class="fa fa-comments"></i></div>

  <div class="chat-container" id="chatContainer">
    <div class="chat-header" onclick="toggleChat()">Close Chat</div>
    <div class="message-container" id="messageContainer"></div>
    <form class="chat-form" id="chatForm">
      <input type="text" id="name" name="name" placeholder="Your Name" required>
      <input type="email" id="email" name="email" placeholder="Your Email" required>
      <textarea id="message" name="message" placeholder="Your Message" rows="4" required></textarea>
      <button type="button" onclick="validateAndSendMessage()">Send</button>
    </form>
  </div>

  <script>
    var chatContainer = document.getElementById('chatContainer');
    var messageContainer = document.getElementById('messageContainer');

    function toggleChat() {
      chatContainer.style.display = chatContainer.style.display === 'none' ? 'block' : 'none';
    }

    function sendMessage() {
      var xhr = new XMLHttpRequest();
      var formData = new FormData(document.getElementById('chatForm'));
      xhr.open('POST', 'php/chat_bot.php', true);
      xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
              showConfirmation(response.message);
              document.getElementById('name').value = '';
              document.getElementById('email').value = '';
              document.getElementById('message').value = '';
              setTimeout(function() {
                toggleChat();
              }, 5000);
            } else {
              showErrorMessage(response.message);
            }
          } else {
            showErrorMessage('Error sending message.');
          }
        }
      };
      xhr.send(formData);
    }

    function showConfirmation(message) {
      var confirmationElement = document.createElement('div');
      confirmationElement.classList.add('confirmation-message');
      confirmationElement.textContent = message;
      messageContainer.appendChild(confirmationElement);
      messageContainer.scrollTop = messageContainer.scrollHeight;
    }

    function showErrorMessage(message) {
      var errorElement = document.createElement('div');
      errorElement.classList.add('error-message');
      errorElement.textContent = message;
      messageContainer.appendChild(errorElement);
      messageContainer.scrollTop = messageContainer.scrollHeight;
    }

    function validateEmail(email) {
      // Regex for simple email validation
      var re = /\S+@\S+\.\S+/;
      return re.test(email);
    }

    function validateAndSendMessage() {
      var emailInput = document.getElementById('email');
      var email = emailInput.value.trim();

      if (!validateEmail(email)) {
        showErrorMessage('Please enter a valid email address.');
        return;
      }

      sendMessage(); // If email is valid, proceed to send message
    }
  </script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>


  <!-- ======= CHAT BOT ================================ ======= -->



  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logoswiftyresults.png" alt="">
        <span><b>Swifty</b>Results</span>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
          <li><a class="nav-link scrollto" href="#about">About</a></li>
          <li><a class="nav-link scrollto" href="#services">Services</a></li>
          <li><a class="nav-link scrollto" href="#portfolio">Portfolio</a></li>
          <!--<li><a class="nav-link scrollto" href="#team">Team</a></li>-->
          <!--<li><a href="blog.html">Blog</a></li>-->
          <!--
          <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li>-->
          <!--
          <li class="dropdown megamenu"><a href="#"><span>Mega Menu</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li>
                <a href="#">Column 1 link 1</a>
                <a href="#">Column 1 link 2</a>
                <a href="#">Column 1 link 3</a>
              </li>
              <li>
                <a href="#">Column 2 link 1</a>
                <a href="#">Column 2 link 2</a>
                <a href="#">Column 3 link 3</a>
              </li>
              <li>
                <a href="#">Column 3 link 1</a>
                <a href="#">Column 3 link 2</a>
                <a href="#">Column 3 link 3</a>
              </li>
              <li>
                <a href="#">Column 4 link 1</a>
                <a href="#">Column 4 link 2</a>
                <a href="#">Column 4 link 3</a>
              </li>
            </ul>
          </li>
          -->
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <li><a class="getstarted scrollto" href="#about">Get Started</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-center">

        <h1 data-aos="fade-up">Navigate the digital landscape with trust at SwiftyResults.</b></h1>
          <h2 data-aos="fade-up" data-aos-delay="400">We want to make it easy and affordable for you to get your business online. We're a small team of experts that have worked with small to mid
            size businesses up to Fortune 500s.</h2>

          <div data-aos="fade-up" data-aos-delay="600">
            <div class="text-center text-lg-start">
              <a href="#contact"
                class="btn-get-started scrollto d-inline-flex align-items-center justify-content-center align-self-center">
                <span>Begin Your Journey</span>
                <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-6 hero-img" data-aos="zoom-out" data-aos-delay="200">
          <img src="assets/img/hero-img.png" class="img-fluid" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">
    <!-- ======= About Section ======= -->
    <section id="about" class="about">

      <div class="container" data-aos="fade-up">
        <div class="row gx-0">

          <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="content">
              <h3>Who We Are</h3>
              <h2>We're all about creating amazing digital solutions that help your business shine online.</h2>
              <p>
                Whether you're looking for a stunning website, a seamless CRM system, or some marketing magic, we've got
                you covered. What sets us apart? Our friendly team's here to partner with you every step of the way.
                Let's make your online presence shine. <br /><br />Welcome to SwiftyResults, where success is just a
                click away.
              </p>
              <div class="text-center text-lg-start">
                <a href="#services"
                  class="btn-read-more d-inline-flex align-items-center justify-content-center align-self-center">
                  <span>Read More</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>

          <div class="col-lg-6 d-flex align-items-center" data-aos="zoom-out" data-aos-delay="200">
            <img src="assets/img/about.png" class="img-fluid" alt="">
          </div>

        </div>
      </div>

    </section><!-- End About Section -->


    <!-- ======= Values Section ======= -->
    <!--
    <section id="values" class="values">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Our Values</h2>
          <p>Odit est perspiciatis laborum et dicta</p>
        </header>

        <div class="row">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="box">
              <img src="assets/img/values-1.png" class="img-fluid" alt="">
              <h3>Ad cupiditate sed est odio</h3>
              <p>Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit. Et veritatis id.</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="400">
            <div class="box">
              <img src="assets/img/values-2.png" class="img-fluid" alt="">
              <h3>Voluptatem voluptatum alias</h3>
              <p>Repudiandae amet nihil natus in distinctio suscipit id. Doloremque ducimus ea sit non.</p>
            </div>
          </div>

          <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="600">
            <div class="box">
              <img src="assets/img/values-3.png" class="img-fluid" alt="">
              <h3>Fugit cupiditate alias nobis.</h3>
              <p>Quam rem vitae est autem molestias explicabo debitis sint. Vero aliquid quidem commodi.</p>
            </div>
          </div>

        </div>

      </div>

    </section>
    -->
    <!-- End Values Section -->

    <!-- ======= Counts Section ======= -->
    <!--
    <section id="counts" class="counts">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-emoji-smile"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                <p>Happy Clients</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-journal-richtext" style="color: #ee6c20;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                <p>Projects</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-headset" style="color: #15be56;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="1463" data-purecounter-duration="1" class="purecounter"></span>
                <p>Hours Of Support</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="count-box">
              <i class="bi bi-people" style="color: #bb0852;"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
                <p>Hard Workers</p>
              </div>
            </div>
          </div>

        </div>

      </div>
    </section>
    -->
    <!-- End Counts Section -->

    <!-- ======= Features Section ======= -->
    <!--
    <section id="features" class="features">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Features</h2>
          <p>Laboriosam et omnis fuga quis dolor direda fara</p>
        </header>

        <div class="row">

          <div class="col-lg-6">
            <img src="assets/img/features.png" class="img-fluid" alt="">
          </div>

          <div class="col-lg-6 mt-5 mt-lg-0 d-flex">
            <div class="row align-self-center gy-4">

              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="200">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Eos aspernatur rem</h3>
                </div>
              </div>

              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="300">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Facilis neque ipsa</h3>
                </div>
              </div>

              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="400">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Volup amet voluptas</h3>
                </div>
              </div>

              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="500">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Rerum omnis sint</h3>
                </div>
              </div>

              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="600">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Alias possimus</h3>
                </div>
              </div>

              <div class="col-md-6" data-aos="zoom-out" data-aos-delay="700">
                <div class="feature-box d-flex align-items-center">
                  <i class="bi bi-check"></i>
                  <h3>Repellendus mollitia</h3>
                </div>
              </div>

            </div>
          </div>

        </div>--> <!-- / row -->

    <!-- Feature Tabs -->
    <!-- <div class="row feture-tabs" data-aos="fade-up">
          <div class="col-lg-6">
            <h3>Neque officiis dolore maiores et exercitationem quae est seda lidera pat claero</h3> -->

    <!-- Tabs -->
    <!-- <ul class="nav nav-pills mb-3">
              <li>
                <a class="nav-link active" data-bs-toggle="pill" href="#tab1">Saepe fuga</a>
              </li>
              <li>
                <a class="nav-link" data-bs-toggle="pill" href="#tab2">Voluptates</a>
              </li>
              <li>
                <a class="nav-link" data-bs-toggle="pill" href="#tab3">Corrupti</a>
              </li>
            </ul> -->

    <!-- End Tabs -->

    <!-- Tab Content -->
    <!-- <div class="tab-content">

              <div class="tab-pane fade show active" id="tab1">
                <p>Consequuntur inventore voluptates consequatur aut vel et. Eos doloribus expedita. Sapiente atque consequatur minima nihil quae aspernatur quo suscipit voluptatem.</p>
                <div class="d-flex align-items-center mb-2">
                  <i class="bi bi-check2"></i>
                  <h4>Repudiandae rerum velit modi et officia quasi facilis</h4>
                </div>
                <p>Laborum omnis voluptates voluptas qui sit aliquam blanditiis. Sapiente minima commodi dolorum non eveniet magni quaerat nemo et.</p>
                <div class="d-flex align-items-center mb-2">
                  <i class="bi bi-check2"></i>
                  <h4>Incidunt non veritatis illum ea ut nisi</h4>
                </div>
                <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta tenetur. Iure molestiae assumenda sunt qui inventore eligendi voluptates nisi at. Dolorem quo tempora. Quia et perferendis.</p>
              </div> -->

    <!-- End Tab 1 Content -->

    <!-- <div class="tab-pane fade show" id="tab2">
                <p>Consequuntur inventore voluptates consequatur aut vel et. Eos doloribus expedita. Sapiente atque consequatur minima nihil quae aspernatur quo suscipit voluptatem.</p>
                <div class="d-flex align-items-center mb-2">
                  <i class="bi bi-check2"></i>
                  <h4>Repudiandae rerum velit modi et officia quasi facilis</h4>
                </div>
                <p>Laborum omnis voluptates voluptas qui sit aliquam blanditiis. Sapiente minima commodi dolorum non eveniet magni quaerat nemo et.</p>
                <div class="d-flex align-items-center mb-2">
                  <i class="bi bi-check2"></i>
                  <h4>Incidunt non veritatis illum ea ut nisi</h4>
                </div>
                <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta tenetur. Iure molestiae assumenda sunt qui inventore eligendi voluptates nisi at. Dolorem quo tempora. Quia et perferendis.</p>
              </div> -->

    <!-- End Tab 2 Content -->

    <!-- <div class="tab-pane fade show" id="tab3">
                <p>Consequuntur inventore voluptates consequatur aut vel et. Eos doloribus expedita. Sapiente atque consequatur minima nihil quae aspernatur quo suscipit voluptatem.</p>
                <div class="d-flex align-items-center mb-2">
                  <i class="bi bi-check2"></i>
                  <h4>Repudiandae rerum velit modi et officia quasi facilis</h4>
                </div>
                <p>Laborum omnis voluptates voluptas qui sit aliquam blanditiis. Sapiente minima commodi dolorum non eveniet magni quaerat nemo et.</p>
                <div class="d-flex align-items-center mb-2">
                  <i class="bi bi-check2"></i>
                  <h4>Incidunt non veritatis illum ea ut nisi</h4>
                </div>
                <p>Non quod totam minus repellendus autem sint velit. Rerum debitis facere soluta tenetur. Iure molestiae assumenda sunt qui inventore eligendi voluptates nisi at. Dolorem quo tempora. Quia et perferendis.</p>
              </div> -->

    <!-- End Tab 3 Content -->
    <!-- 
            </div>

          </div>

          <div class="col-lg-6">
            <img src="assets/img/features-2.png" class="img-fluid" alt="">
          </div>

        </div> -->

    <!-- End Feature Tabs -->

    <!-- Feature Icons -->
    <!-- <div class="row feature-icons" data-aos="fade-up">
          <h3>Ratione mollitia eos ab laudantium rerum beatae quo</h3>

          <div class="row">

            <div class="col-xl-4 text-center" data-aos="fade-right" data-aos-delay="100">
              <img src="assets/img/features-3.png" class="img-fluid p-4" alt="">
            </div>

            <div class="col-xl-8 d-flex content">
              <div class="row align-self-center gy-4">

                <div class="col-md-6 icon-box" data-aos="fade-up">
                  <i class="ri-line-chart-line"></i>
                  <div>
                    <h4>Corporis voluptates sit</h4>
                    <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                  </div>
                </div>

                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="100">
                  <i class="ri-stack-line"></i>
                  <div>
                    <h4>Ullamco laboris nisi</h4>
                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                  </div>
                </div>

                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="200">
                  <i class="ri-brush-4-line"></i>
                  <div>
                    <h4>Labore consequatur</h4>
                    <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                  </div>
                </div>

                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="300">
                  <i class="ri-magic-line"></i>
                  <div>
                    <h4>Beatae veritatis</h4>
                    <p>Expedita veritatis consequuntur nihil tempore laudantium vitae denat pacta</p>
                  </div>
                </div>

                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="400">
                  <i class="ri-command-line"></i>
                  <div>
                    <h4>Molestiae dolor</h4>
                    <p>Et fuga et deserunt et enim. Dolorem architecto ratione tensa raptor marte</p>
                  </div>
                </div>

                <div class="col-md-6 icon-box" data-aos="fade-up" data-aos-delay="500">
                  <i class="ri-radar-line"></i>
                  <div>
                    <h4>Explicabo consectetur</h4>
                    <p>Est autem dicta beatae suscipit. Sint veritatis et sit quasi ab aut inventore</p>
                  </div>
                </div>

              </div>
            </div>

          </div> 

        </div>-->

    <!-- End Feature Icons -->
    <!-- 
      </div>

    </section> -->

    <!-- End Features Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Services</h2>
          <p>Your Digital Partner in Growth: SwiftyResults Collaborative Offerings</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="service-box blue flip-card">
              <div class="flip-card-inner">
                <div class="flip-card-front">
                  <i class="ri-discuss-line icon"></i>
                  <h3>Shopify Solutions</h3>
                  <p>Transform your e-commerce experience with tailored Shopify solutions. Streamline your store setup, enhance user experience, and boost sales.</p>
                  <a href="javascript:void(0)" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="flip-card-back">
                  <h3>Shopify Solutions</h3>

                  <p>Fully functional Shopify store
                    <br>Custom theme design files
                    <br> Product catalog setup
                    <br> Payment gateway integration
                    <br> Training documentation for store management
                  </p>

                  <a href="javascript:void(0)" class="read-less"><span>Show Less</span> <i class="bi bi-arrow-left"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="service-box orange flip-card">
              <div class="flip-card-inner">
                <div class="flip-card-front">
                  <i class="ri-discuss-line icon"></i>
                  <h3>Website Development</h3>
                  <p>From concept to launch, we craft visually stunning and user-friendly websites. Elevate your online presence with our expert development services.</p>
                  <a href="javascript:void(0)" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="flip-card-back">
                  <h3>Website Development</h3>
                  <p>Responsive website<br>
                    Content Management System<br>
                    SEO-optimized site structure<br>
                    Web hosting setup (if included)<br>
                    Training on website maintenance</p>
                  <a href="javascript:void(0)" class="read-less"><span>Show Less</span> <i class="bi bi-arrow-left"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-box green flip-card">
              <div class="flip-card-inner">
                <div class="flip-card-front">
                  <i class="ri-discuss-line icon"></i>
                  <h3>Marketing Automation</h3>
                  <p>Maximize efficiency and drive growth with marketing automation solutions. Engage customers, nurture leads, and analyze performance seamlessly.</p>
                  <a href="javascript:void(0)" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="flip-card-back">
                  <h3>Marketing Automation</h3>
                  <p>Configured marketing automation <br>
                    Set of automated workflows and email templates<br>
                    Integration with existing CRM or other tools<br>
                    Dashboard for campaign monitoring<br>
                    Initial set of segmented contact lists</p>

                  <a href="javascript:void(0)" class="read-less"><span>Show Less</span> <i class="bi bi-arrow-left"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-box red flip-card">
              <div class="flip-card-inner">
                <div class="flip-card-front">
                  <i class="ri-discuss-line icon"></i>
                  <h3>CRM Implementation</h3>
                  <p>Empower your team and strengthen customer relationships with customized CRM solutions. Unlock insights, streamline processes, and drive revenue.</p>
                  <a href="javascript:void(0)" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="flip-card-back">
                  <h3>CRM Implementation</h3>
                  <p>Installed and configured CRM system<br>
                    Customized fields and layouts<br>
                    Imported and cleaned customer data<br>
                    Set of custom reports and dashboards<br>
                    User access setup and permissions</p>
                  <a href="javascript:void(0)" class="read-less"><span>Show Less</span> <i class="bi bi-arrow-left"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-box purple flip-card">
              <div class="flip-card-inner">
                <div class="flip-card-front">
                  <i class="ri-discuss-line icon"></i>
                  <h3>SMS and Email Marketing</h3>
                  <p>Reach your audience effectively with targeted SMS and email marketing campaigns. Drive engagement, conversions, and brand loyalty effortlessly.</p>
                  <a href="javascript:void(0)" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="flip-card-back">
                  <h3>SMS and Email Marketing</h3>
                  <p>Configured email marketing platform<br>
                    Set of branded email templates<br>
                    Initial campaign strategy document<br>
                    SMS sending capability setup<br>
                    Subscription management system</p>
                  <a href="javascript:void(0)" class="read-less"><span>Show Less</span> <i class="bi bi-arrow-left"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">
            <div class="service-box pink flip-card">
              <div class="flip-card-inner">
                <div class="flip-card-front">
                  <i class="ri-discuss-line icon"></i>
                  <h3>Custom Solutions</h3>
                  <p>Have a unique need? Let's discuss. Our team specializes in crafting bespoke digital solutions tailored to your specific requirements and goals.</p>
                  <a href="javascript:void(0)" class="read-more"><span>Read More</span> <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="flip-card-back">
                  <h3>Custom Solutions</h3>
                  <p>Custom-developed software application<br>
                    Source code (if agreed upon)<br>
                    User documentation<br>
                    Admin panel or management interface<br>
                    API documentation (if applicable)</p>
                  <a href="javascript:void(0)" class="read-less"><span>Show Less</span> <i class="bi bi-arrow-left"></i></a>
                </div>
              </div>
            </div>
          </div>

        </div>

        <script>
          document.querySelectorAll('.read-more').forEach(button => {
            button.addEventListener('click', function() {
              const card = this.closest('.flip-card');
              card.classList.add('flipped');
            });
          });

          document.querySelectorAll('.read-less').forEach(button => {
            button.addEventListener('click', function() {
              const card = this.closest('.flip-card');
              card.classList.remove('flipped');
            });
          });
        </script>

    </section><!-- End Services Section -->

    <!-- ======= Pricing Section ======= -->
    <!-- <section id="pricing" class="pricing">
      <div class="container" data-aos="fade-up">
        <header class="section-header">
          <h2>Pricing</h2>
          <p>Check our Pricing</p>
        </header>

        <div class="pricing-sections">
          <!-- Shopify Section -->
         <!-- <div class="pricing-section">
            <h3 class="section-title text-center" onclick="toggleSection('shopify-pricing', this)">Shopify Solutions</h3>
            <div id="shopify-pricing" class="row gy-4" data-aos="fade-left">
              <!-- Original Shopify pricing content goes here -->
              <!-- ... (Your existing Shopify pricing boxes) ... -->
           <!--   <div class="row gy-4 pricing-padding-fix" data-aos="fade-left">

                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                  <div class="box">
                    <h3 style="color: #07d5c0;">Starter Shopify Setup</h3>
                    <div class="price"><sup>$</sup>499<span> / one-time</span></div>
                    <img src="assets/img/pricing-free.png" class="img-fluid" alt="">
                    <ul>
                      <li>Basic setup for a one-page Shopify store</li>
                      <li>Theme installation and customization</li>
                      <li>Payment gateway integration</li>
                      <li>10 Winning products setup for you</li>
                    </ul>
                    <a href="#contact" class="btn-buy">Get Started</a>
                  </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                  <div class="box">
                    <span class="featured">Featured</span>
                    <h3 style="color: #65c600;">Standard Shopify Package</h3>
                    <div class="price"><sup>$</sup>999<span> / starting</span></div>
                    <img src="assets/img/pricing-starter.png" class="img-fluid" alt="">
                    <ul>
                      <li>Advanced setup for a multi-page Shopify store</li>
                      <li>Custom theme design</li>
                      <li>15 Winning Products setup for you</li>
                      <li>Basic SEO optimization</li>
                    </ul>
                    <a href="#contact" class="btn-buy">Get Started</a>
                  </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                  <div class="box">
                    <h3 style="color: #ff901c;">Premium Shopify Solution</h3>
                    <div class="price"><sup>$</sup>1999<span> / starting</span></div>
                    <img src="assets/img/pricing-business.png" class="img-fluid" alt="">
                    <ul>
                      <li>Everything in the Standard plan</li>
                      <li>Winback and Email campaigns</li>
                      <li>20 Winning Products setup for you</li>
                      <li>Priority support</li>
                    </ul>
                    <a href="#contact" class="btn-buy">Get Started</a>
                  </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                  <div class="box">
                    <h3 style="color: #ff0071;">Enterprise Shopify Package</h3>
                    <div class="price">Contact us</span></div>
                    <img src="assets/img/pricing-ultimate.png" class="img-fluid" alt="">
                    <ul>
                      <li>Fully customized and scalable solution</li>
                      <li>Advanced Features tailored for you</li>
                      <li>30+ Winning Products</li>
                      <li>Ongoing support</li>
                    </ul>
                    <a href="#contact" class="btn-buy">Get Started</a>
                  </div>
                </div>


              </div>

            </div>
          </div> -->

          <!-- Website Development Section -->
         <!--  <div class="pricing-section">
            <h3 class="section-title text-center" onclick="toggleSection('website-pricing', this)">Website Development</h3>
            <div id="website-pricing" class="row gy-4" data-aos="fade-left">
              <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="100">
                <div class="box">
                  <h3 style="color: #07d5c0;">Basic Website</h3>
                  <div class="price"><sup>$</sup>999<span> / Starting</span></div>
                  <img src="assets/img/pricing-free.png" class="img-fluid" alt="">
                  <ul>
                    <li>Establish online presence 24/7</li>
                    <li>Increase credibility and trust</li>
                    <li>Showcase products/services</li>
                    <li>Basic contact form</li>
                    <li>Mobile-responsive design</li>
                  </ul>
                  <a href="#contact" class="btn-buy">Get Started</a>
                </div>
              </div>

              <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="200">
                <div class="box">
                  <span class="featured">Featured</span>
                  <h3 style="color: #65c600;">Professional Website</h3>
                  <div class="price"><sup>$</sup>1999<span> / starting</span></div>
                  <img src="assets/img/pricing-starter.png" class="img-fluid" alt="">
                  <ul>
                    <li>All of Basic +</li>
                    <li>Attract more qualified leads</li>
                    <li>Improve customer engagement</li>
                    <li>Basic SEO optimization</li>
                    <li>Calendar Scheduling Widget</li>
                  </ul>
                  <a href="#contact" class="btn-buy">Get Started</a>
                </div>
              </div>

              <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="300">
                <div class="box">
                  <h3 style="color: #ff901c;">Advanced Website</h3>
                  <div class="price"><sup>$</sup>3499<span> / starting</span></div>
                  <img src="assets/img/pricing-business.png" class="img-fluid" alt="">
                  <ul>
                    <li>Online store integration</li>
                    <li>Admin portal and analytics integration</li>
                    <li>Custom tailored solutions</li>
                    <li>Product catalog management</li>
                  </ul>
                  <a href="#contact" class="btn-buy">Get Started</a>
                </div>
              </div>

              <div class="col-lg-3 col-md-6" data-aos="zoom-in" data-aos-delay="400">
                <div class="box">
                  <h3 style="color: #ff0071;">Custom Web Solution</h3>
                  <div class="price">Contact us</span></div>
                  <img src="assets/img/pricing-ultimate.png" class="img-fluid" alt="">
                  <ul>
                    <li>Tailored to unique business needs</li>
                    <li>Advanced features and integrations</li>
                    <li>Scalable for business growth</li>
                    <li>Ongoing support and maintenance</li>
                  </ul>
                  <a href="#contact" class="btn-buy">Get Started</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>

    </script>--><!-- End Pricing Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>F.A.Q</h2>
          <p>Frequently Asked Questions</p>
        </header>

        <div class="row">
          <div class="col-lg-6">
            <!-- F.A.Q List 1-->
            <div class="accordion accordion-flush" id="faqlist1">
            <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq-content-1">
                    How does it work?
                  </button>
                </h2>
                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    We'll set up a discovery call to understand what your vision is, if you're local to southwest Florida, we can even meet in person. 
                    We'll talk about what's doable and what isnt and offer you different options that meet your budget. Once the work is completed you'll have options for revision, training and ongoing maintenance to fit your needs.
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq-content-1">
                    What services do you offer for Shopify setup?
                  </button>
                </h2>
                <div id="faq-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    We offer a range of Shopify setup services tailored to your needs. This includes basic setup for
                    one-page stores, advanced setup for multi-page stores, custom theme design, product upload
                    assistance, and more.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq-content-2">
                    Do you provide ongoing support for website development?
                  </button>
                </h2>
                <div id="faq-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    Yes, we offer ongoing support for website development projects. Our team is available to address any
                    questions or issues you may encounter after the initial setup, ensuring your website runs smoothly.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq-content-3">
                    Can I customize the marketing automation solutions to suit my business needs?
                  </button>
                </h2>
                <div id="faq-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist1">
                  <div class="accordion-body">
                    Absolutely. Our marketing automation solutions are highly customizable. We work closely with you to
                    understand your business requirements and tailor the automation processes to achieve your specific
                    goals.
                  </div>
                </div>
              </div>

            </div>
          </div>

          <div class="col-lg-6">

            <!-- F.A.Q List 2-->
            <div class="accordion accordion-flush" id="faqlist2">

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq2-content-1">
                    What does the CRM implementation process involve?
                  </button>
                </h2>
                <div id="faq2-content-1" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    Our CRM implementation process includes consultation, customization, data migration, integration
                    with existing systems, user training, and ongoing support. We ensure a seamless transition to your
                    new CRM system.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq2-content-2">
                    How effective are SMS and email marketing campaigns?
                  </button>
                </h2>
                <div id="faq2-content-2" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    SMS and email marketing campaigns can be highly effective when executed strategically. We employ
                    best practices in audience segmentation, personalized messaging, and timing to maximize engagement
                    and conversions for your business.
                  </div>
                </div>
              </div>

              <div class="accordion-item">
                <h2 class="accordion-header">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#faq2-content-3">
                    Is there flexibility in pricing plans for your services?
                  </button>
                </h2>
                <div id="faq2-content-3" class="accordion-collapse collapse" data-bs-parent="#faqlist2">
                  <div class="accordion-body">
                    Yes, we offer flexibility in pricing plans to accommodate businesses of all sizes. Whether you're a
                    startup or an enterprise, we have tailored solutions to meet your budget and requirements.
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>


      </div>

    </section><!-- End F.A.Q Section -->
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">




        <header class="section-header">
          <!-- <h2>Contact</h2> -->
          <p>Begin Your Journey</p>
        </header>



        <div class="row gy-4 justify-content-center">



          <!-- <div class="col-lg-6">

            <form action="php/schedule_meeting.php" method="post" class="php-email-form">
              <p>Schedule a 15 Minute With Us</p>
              <div class="row gy-4">
                <div class="col-md-6">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="col-md-3">
                  <input type="date" class="form-control" id="date" name="date" placeholder="Date"
                    min="<?php echo date('Y-m-d'); ?>" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="col-md-3">
                  <select class="form-control" id="time" name="time" required>
                    <option value="">Time</option>
                    <option value="08:00">08:00</option>
                    <option value="08:15">08:15</option>
                    <option value="08:30">08:30</option>
                    <option value="08:45">08:45</option>
                    <option value="09:00">09:00</option>
                    <option value="09:15">09:15</option>
                    <option value="09:30">09:30</option>
                    <option value="09:45">09:45</option>
                    <option value="10:00">10:00</option>
                    <option value="10:15">10:15</option>
                    <option value="10:30">10:30</option>
                    <option value="10:45">10:45</option>
                    <option value="11:00">11:00</option>
                    <option value="11:15">11:15</option>
                    <option value="11:30">11:30</option>
                    <option value="11:45">11:45</option>
                    <option value="12:00">12:00</option>
                    <option value="12:15">12:15</option>
                    <option value="12:30">12:30</option>
                    <option value="12:45">12:45</option>
                    <option value="13:00">13:00</option>
                    <option value="13:15">13:15</option>
                    <option value="13:30">13:30</option>
                    <option value="13:45">13:45</option>
                    <option value="14:00">14:00</option>
                    <option value="14:15">14:15</option>
                    <option value="14:30">14:30</option>
                    <option value="14:45">14:45</option>
                    <option value="15:00">15:00</option>
                    <option value="15:15">15:15</option>
                    <option value="15:30">15:30</option>
                    <option value="15:45">15:45</option>
                    <option value="16:00">16:00</option>
                    <option value="16:15">16:15</option>
                    <option value="16:30">16:30</option>
                    <option value="16:45">16:45</option>
                  </select>
                  </select>
                </div>
                <div class="col-md-12">
                  <textarea class="form-control" id="description" name="description" placeholder="Description"
                    rows="6"></textarea>
                </div>
                <div class="col-md-12 text-center">
                  <div class="loading" style="display: none;">Loading</div>
                  <div class="error-message" style="display: none;"></div>
                  <div class="sent-message" style="display: none;">Your Schedule a 15 Minute With Us. Thank you!</div>
                  <button type="submit">Submit</button>
                </div>
              </div>
            </form>
          </div> -->



          <script>
            document.addEventListener('DOMContentLoaded', function() {
              // //   const timeSelect = document.getElementById('time');
              // //   const intervals = 15; // Intervalo de 15 minutos
              // //   const startHour = 8;
              // //   const endHour = 17;
              // //   const inicial = 'Time'

              // Função para gerar as opções de tempo
              // //   function generateTimeOptions() {
              // //     timeSelect.innerHTML = ''; // Limpa as opções existentes
              // //     timeSelect.text = 'Time'
              // //     for (let hour = startHour; hour < endHour; hour++) {
              // //       for (let minutes = 0; minutes < 60; minutes += intervals) {
              // //         const time = `${String(hour).padStart(2, '0')}:${String(minutes).padStart(2, '0')}`;
              // //         const option = document.createElement('option');

              // //         option.value = time;
              // //         option.textContent = time;
              // //         timeSelect.appendChild(option);
              // //       }
              // //     }
              // //   }

              //   generateTimeOptions(); // Chama a função para gerar as opções de tempo inicialmente

              // Adiciona um listener para quando a data for alterada
              document.getElementById('date').addEventListener('input', function() {
                validateDate(); // Chama a função para validar a data sempre que ela mudar
              });

              // Função para validar a data e evitar datas anteriores
              function validateDate() {
                const selectedDate = new Date(document.getElementById('date').value);
                const today = new Date();

                // Define o mínimo como a data de hoje, se a data selecionada for anterior
                if (selectedDate < today) {
                  document.getElementById('date').value = today.toISOString().split('T')[0]; // Define o valor como o dia de hoje no formato ISO 8601
                }
              }
            });
          </script>

















          <div class="col-lg-12">

            <form action="php/mail.php" method="post" class="php-email-form">
              <p>Contact Us </p>
              <div class="row gy-4">


                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>

                <label for="nickname" aria-hidden="true" class="user-cannot-see"> Nickname
                  <input type="text" name="nickname" id="nickname" class="user-cannot-see" tabindex="-1"
                    autocomplete="off">
                </label>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Submit</button>
                </div>


            </form>

          </div>

        </div>

      </div>
      </div>
    </section><!-- End Contact Section -->




    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="row gy-4">
        <div class="container" data-aos="fade-up">

          <header class="section-header">
            <h2>Portfolio</h2>
            <p>Check our latest work</p>
          </header>

          <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-lg-12 d-flex justify-content-center">
              <ul id="portfolio-flters">
                <li data-filter="*" class="filter-active">All</li>
                <li data-filter=".filter-app">Shopify</li>
                <li data-filter=".filter-card">SMS and Email</li>
                <li data-filter=".filter-web">Web</li>
              </ul>
            </div>
          </div>

          <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
            <!-- HableePets-->
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                <img src="assets/img/portfolio/portfolio-1.png" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>HableePets</h4>
                  <p>Shopify eCommerce</p>
                  <div class="portfolio-links">
                    <a href="assets/img/portfolio/portfolio-1.png" data-gallery="portfolioGallery"
                      class="portfokio-lightbox" title="App 1"><i class="bi bi-plus"></i></a>
                    <a target="_blank" href="https://www.hableepets.com" target="_blank" title="More Details"><i
                        class="bi bi-link"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Victory Fitness ​Club-->
            <div class="col-lg-4 col-md-6 portfolio-item filter-web">
              <div class="portfolio-wrap">
                <img src="assets/img/portfolio/Victory Fitness ​Club.png" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Victory Fitness ​Club</h4>
                  <p>Service Business Website</p>
                  <div class="portfolio-links">
                    <a href="assets/img/portfolio/Victory Fitness ​Club.png" data-gallery="portfolioGallery"
                      class="portfokio-lightbox" title="Web 3"><i class="bi bi-plus"></i></a>
                    <a target="_blank" href="https://devbm.my.canva.site/victory-fitness-club" target="_blank" title="More Details"><i
                        class="bi bi-link"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <!-- Winslough Car Repair-->
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                <img src="assets/img/portfolio/Winslough Car Repair.png" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>Winslough Car Repair</h4>
                  <p>Service Business Website</p>
                  <div class="portfolio-links">
                    <a href="assets/img/portfolio/Winslough Car Repair.png" data-gallery="portfolioGallery"
                      class="portfokio-lightbox" title="App 2"><i class="bi bi-plus"></i></a>
                    <a target="_blank" href="https://devbm.my.canva.site/winslough" target="_blank" title="More Details"><i
                        class="bi bi-link"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row gy-4 portfolio-container" data-aos="fade-up" data-aos-delay="200">
            <!-- <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Card 2</h4>
                <p>Card</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-4.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox" title="Card 2"><i class="bi bi-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                </div>
              </div>
            </div>
          </div> -->

            <!-- PureClean ​Residential-->

            <div class="col-lg-4 col-md-6 portfolio-item filter-web">
              <div class="portfolio-wrap">
                <img src="assets/img/portfolio/PureClean ​Residential.jpg" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>PureClean ​Residential</h4>
                  <p>Service Business Website</p>
                  <div class="portfolio-links">
                    <a href="assets/img/portfolio/PureClean ​Residential.jpg" data-gallery="portfolioGallery"
                      class="portfokio-lightbox" title="Web 2"><i class="bi bi-plus"></i></a>
                    <a target="_blank" href="https://devbm.my.canva.site/pureclean-residential" title="More Details"><i class="bi bi-link"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <!-- SWFL Pool Perfection-->
            <div class="col-lg-4 col-md-6 portfolio-item filter-app">
              <div class="portfolio-wrap">
                <img src="assets/img/portfolio/portfolio-6.png" class="img-fluid" alt="">
                <div class="portfolio-info">
                  <h4>SWFL Pool Perfection</h4>
                  <p>Service Business Website</p>
                  <div class="portfolio-links">
                    <a href="assets/img/portfolio/portfolio-6.png" data-gallery="portfolioGallery" class="portfokio-lightbox" title="App 3"><i class="bi bi-plus"></i></a>
                    <a target="_blank" href="https://devbm.my.canva.site/capecoralcrystalpools#home" title="More Details"><i class="bi bi-link"></i></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Card 1</h4>
                <p>Card</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-7.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox" title="Card 1"><i class="bi bi-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-card">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Card 3</h4>
                <p>Card</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-8.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox" title="Card 3"><i class="bi bi-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 portfolio-item filter-web">
            <div class="portfolio-wrap">
              <img src="assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt="">
              <div class="portfolio-info">
                <h4>Web 3</h4>
                <p>Web</p>
                <div class="portfolio-links">
                  <a href="assets/img/portfolio/portfolio-9.jpg" data-gallery="portfolioGallery" class="portfokio-lightbox" title="Web 3"><i class="bi bi-plus"></i></a>
                  <a href="portfolio-details.html" title="More Details"><i class="bi bi-link"></i></a>
                </div>
              </div>
            </div>
          </div> -->

        </div>

      </div>

    </section><!-- End Portfolio Section -->





    <!-- ======= Testimonial Section ======= -->
    <section id="testimonials" class="testimonials">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Testimonials</h2>
          <p>What our clients are saying about us</p>
        </header>

        <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
          <div class="swiper-wrapper">
            <!-- Testimonial 1 -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="profile">
                  <img src="assets/img/testimonials/download (3).jpg" class="testimonial-img" alt="">
                  <h3>Tom Reynolds</h3>
                  <h4>Owner, CleanWave Pools</h4>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <p>
                  SwiftyResults helped us streamline our scheduling and customer communication. Our pool cleaning business has never been more efficient.
                </p>
              </div>
            </div>

            <!-- Testimonial 2 -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="profile">
                  <img src="assets/img/testimonials/download (4).jpg" class="testimonial-img" alt="">
                  <h3>Linda Harris</h3>
                  <h4>Owner, GreenThumb Lawn Care</h4>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <p>
                  Thanks to SwiftyResults, our lawn care service is now fully booked weeks in advance. Their marketing strategies really work for small businesses.
                </p>
              </div>
            </div>

            <!-- Testimonial 3 -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="profile">
                  <img src="assets/img/testimonials/download (12).jpg" class="testimonial-img" alt="">
                  <h3>Mark Stevens</h3>
                  <h4>Owner, SparkleClean Maid Service</h4>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <p>
                  SwiftyResults revamped our online presence, making it easier for customers to book our cleaning services. We've seen a big increase in new clients.
                </p>
              </div>
            </div>

            <!-- Testimonial 4 -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="profile">
                  <img src="assets/img/testimonials/download (22).jpg" class="testimonial-img" alt="">
                  <h3>Susan Miller</h3>
                  <h4>Owner, PetCare Plus</h4>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <p>
                  With SwiftyResults, we were able to optimize our pet sitting service scheduling system, saving us time and improving our service quality.
                </p>
              </div>
            </div>

            <!-- Testimonial 5 -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="profile">
                  <img src="assets/img/testimonials/download (25).jpg" class="testimonial-img" alt="">
                  <h3>Jim Thompson</h3>
                  <h4>Owner, Pristine Auto Detailing</h4>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <p>
                  SwiftyResults delivered a professional website that reflects the quality of our car detailing services. We've received numerous compliments from our customers.
                </p>
              </div>
            </div>

            <!-- Testimonial 6 -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="profile">
                  <img src="assets/img/testimonials/download (18).jpg" class="testimonial-img" alt="">
                  <h3>Rachel Peterson</h3>
                  <h4>Owner, FreshBake Bakery</h4>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <p>
                  Our business has grown significantly since we started working with SwiftyResults. Their digital marketing solutions are perfect for small bakeries like ours.
                </p>
              </div>
            </div>

            <!-- Testimonial 7 -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="profile">
                  <img src="assets/img/testimonials/download (1).jpg" class="testimonial-img" alt="">
                  <h3>David Rogers</h3>
                  <h4>Owner, ClearWater Pool Cleaning</h4>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <p>
                  SwiftyResults helped us simplify our billing and customer tracking. We're now running a much smoother operation.
                </p>
              </div>
            </div>

            <!-- Testimonial 8 -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="profile">
                  <img src="assets/img/testimonials/download (11).jpg" class="testimonial-img" alt="">
                  <h3>Karen White</h3>
                  <h4>Owner, Neighborhood Coffee Shop</h4>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <p>
                  We've been able to attract more customers and keep them coming back, thanks to the excellent online ordering system from SwiftyResults.
                </p>
              </div>
            </div>

            <!-- Testimonial 9 -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="profile">
                  <img src="assets/img/testimonials/download (32).jpg" class="testimonial-img" alt="">
                  <h3>Mike Dawson</h3>
                  <h4>Owner, Sparkling Cleaners</h4>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <p>
                  SwiftyResults provided us with the tools we needed to manage our dry cleaning business more effectively. Our clients have noticed the difference.
                </p>
              </div>
            </div>

            <!-- Testimonial 10 -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="profile">
                  <img src="assets/img/testimonials/download (31).jpg" class="testimonial-img" alt="">
                  <h3>Sarah Bennett</h3>
                  <h4>Owner, HomeFix Handyman Services</h4>
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                </div>
                <p>
                  The team at SwiftyResults truly understands the needs of small businesses. Their services have been invaluable to our handyman services company.
                </p>
              </div>
            </div>


            <!-- Continue with more testimonials -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section>
    <!-- End Testimonial Section -->














    <?php
    $showSection = false; // Set this to true to show the section, false to hide it

    if ($showSection) {
    ?>







      <!-- ======= Testimonials Section ======= -->
      <section id="testimonials" class="testimonials">

        <div class="container" data-aos="fade-up">

          <header class="section-header">
            <h2>Testimonials</h2>
            <p>What they are saying about us</p>
          </header>

          <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="200">
            <div class="swiper-wrapper">

              <div class="swiper-slide">
                <div class="testimonial-item">
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                      class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                  <p>
                    I've been thoroughly impressed with the Shopify setup service provided by this company. Their
                    attention to detail and professionalism exceeded my expectations. They made the entire process
                    seamless and stress-free. Highly recommend!
                  </p>
                  <div class="profile mt-auto">
                    <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                    <h3>David Carter</h3>
                    <h4>Business Owner</h4>
                  </div>
                </div>
              </div><!-- End testimonial item -->

              <div class="swiper-slide">
                <div class="testimonial-item">
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                      class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                  <p>
                    The marketing automation solutions provided by this team have been a game-changer for my business.
                    Their expertise in automation strategies has significantly improved our efficiency and customer
                    engagement. Couldn't be happier with the results!
                  </p>
                  <div class="profile mt-auto">
                    <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                    <h3>Emily Watson</h3>
                    <h4>Marketing Director</h4>
                  </div>
                </div>
              </div><!-- End testimonial item -->

              <div class="swiper-slide">
                <div class="testimonial-item">
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                      class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                  <p>
                    The CRM implementation service offered by this company was top-notch. From consultation to execution,
                    they demonstrated expertise and professionalism at every step. Our team now enjoys a more streamlined
                    and efficient workflow. Highly recommend their services!
                  </p>
                  <div class="profile mt-auto">
                    <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                    <h3>Lisa Smith</h3>
                    <h4>Operations Manager</h4>
                  </div>
                </div>
              </div><!-- End testimonial item -->

              <div class="swiper-slide">
                <div class="testimonial-item">
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                      class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                  <p>
                    The SMS and email marketing campaigns executed by this team have yielded outstanding results for our
                    business. Their strategic approach and attention to detail have significantly boosted our customer
                    engagement and conversions. Highly recommended!
                  </p>
                  <div class="profile mt-auto">
                    <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                    <h3>Daniel Adams</h3>
                    <h4>Marketing Manager</h4>
                  </div>
                </div>
              </div><!-- End testimonial item -->

              <div class="swiper-slide">
                <div class="testimonial-item">
                  <div class="stars">
                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                      class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                  </div>
                  <p>
                    The website development service provided by this company surpassed all expectations. They were
                    attentive to our needs, responsive to feedback, and delivered a website that perfectly reflects our
                    brand. Exceptional work!
                  </p>
                  <div class="profile mt-auto">
                    <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                    <h3>Michael Johnson</h3>
                    <h4>CEO</h4>
                  </div>
                </div>
              </div><!-- End testimonial item -->


            </div>
            <div class="swiper-pagination"></div>
          </div>

        </div>

      </section>
    <?php
    }
    ?><!-- End Testimonials Section -->



    <!-- ======= Clients Section ======= -->
    <!--
    <section id="clients" class="clients">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Our Clients</h2>
          <p>Temporibus omnis officia</p>
        </header>

        <div class="clients-slider swiper">
          <div class="swiper-wrapper align-items-center">
            <div class="swiper-slide"><img src="assets/img/clients/client-1.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-2.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-3.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-4.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-5.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-6.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-7.png" class="img-fluid" alt=""></div>
            <div class="swiper-slide"><img src="assets/img/clients/client-8.png" class="img-fluid" alt=""></div>
          </div>
          <div class="swiper-pagination"></div>
        </div>
      </div>

    </section>
    -->
    <!-- End Clients Section -->

    <!-- ======= Recent Blog Posts Section ======= -->
    <!--
    <section id="recent-blog-posts" class="recent-blog-posts">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Blog</h2>
          <p>Recent posts form our Blog</p>
        </header>

        <div class="row">

          <div class="col-lg-4">
            <div class="post-box">
              <div class="post-img"><img src="assets/img/blog/blog-1.jpg" class="img-fluid" alt=""></div>
              <span class="post-date">Tue, September 15</span>
              <h3 class="post-title">Eum ad dolor et. Autem aut fugiat debitis voluptatem consequuntur sit</h3>
              <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="post-box">
              <div class="post-img"><img src="assets/img/blog/blog-2.jpg" class="img-fluid" alt=""></div>
              <span class="post-date">Fri, August 28</span>
              <h3 class="post-title">Et repellendus molestiae qui est sed omnis voluptates magnam</h3>
              <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="post-box">
              <div class="post-img"><img src="assets/img/blog/blog-3.jpg" class="img-fluid" alt=""></div>
              <span class="post-date">Mon, July 11</span>
              <h3 class="post-title">Quia assumenda est et veritatis aut quae</h3>
              <a href="blog-single.html" class="readmore stretched-link mt-auto"><span>Read More</span><i class="bi bi-arrow-right"></i></a>
            </div>
          </div>

        </div>

      </div>

    </section>--><!-- End Recent Blog Posts Section -->
    <!-- ======= Team Section ======= -->
    <section id="team" class="team">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Team</h2>
          <p>Our hard working team</p>
        </header>

        <div class="row gy-4 justify-content-center">

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
                <div class="social">
                  <!--<a href=""><i class="bi bi-twitter"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>-->
                  <a href="https://www.linkedin.com/in/icpedrosa/" target="_blank"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Israel Pedrosa</h4>
                <span>Founder and Developer</span>
                <p>Israel is a seasoned technologist having worked with and delivered pivotal digital solutions from
                  small businesses to Fortune 500s.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">
                <div class="social">
                  <!--<a href=""><i class="bi bi-twitter"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>-->
                  <a href="https://www.linkedin.com/in/ysaenz/" target="_blank"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Yasmeen Saenz</h4>
                <span>Customer Success Manager</span>
                <p>Yasmeen ensures clients achieve their goals by understanding needs, guiding adoption, and building
                  strong relationships. 🚀</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
                <div class="social">
                  <!-- <a href=""><i class="bi bi-twitter"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a> -->
                  <a href="https://www.linkedin.com/in/bernardo-xmelo/"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Bernardo Melo</h4>
                <span>Director of Digital & eCommerce Solutions</span>
                <p>With a humble approach, Bernardo applies his expertise as a Shopify developer and digital strategist
                  to assist businesses of all sizes globally with e-commerce solutions.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="400">
            <div class="member">
              <div class="member-img">
                <img src="assets/img/team/team-4.png" class="img-fluid" alt="">
                <div class="social">
                  <!-- <a href=""><i class="bi bi-twitter"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a> -->
                  <a href="https://www.linkedin.com/in/marcus-wagner1"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Marcus Wagner</h4>
                <span>Director, Business Development</span>
                <p>"As a dedicated business guide, I work tirelessly to identify opportunities, streamline processes,
                  and build partnerships, ensuring your business thrives. Your success is my mission."</p>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- End Team Section -->
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">

      <div class="container" data-aos="fade-up">

        <header class="section-header">
          <h2>Contact</h2>
          <p>Contact Us</p>
        </header>

        <div class="row gy-4">

          <div class="col-lg-6">

            <div class="row gy-4">
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Address</h3>
                  <p>Cape Coral, FL<br>United States </p>
                </div>
              </div><!--
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-telephone"></i>
                  <h3>Call Us</h3>
                  <p>+1 5589 55488 55<br>+1 6678 254445 41</p>
                </div>
              </div>-->
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-envelope"></i>
                  <h3>Email Us</h3>
                  <p>icpedrosa@swiftyresults.com</p>
                  <p>bernardo.melo@swiftyresults.com</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box">
                  <i class="bi bi-clock"></i>
                  <h3>Open Hours</h3>
                  <p>Monday - Friday<br>9:00AM - 05:00PM</p>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-6">
            <form action="php/mail.php" method="post" class="php-email-form">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required>
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required>
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div>

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>

          </div>

        </div>

      </div>

    </section><!-- End Contact Section -->


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

  <div class="footer-newsletter">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-12 text-center">
        <h4>Our Newsletter</h4>
        <p>Elevate your business with exclusive insights and special offers.</p>
      </div>
      <div class="col-lg-6">
        <form id="newsletter-form" class="newsletter-form">
          <input type="email" name="emailaddy" required>
          <input type="hidden" name="OptedIn" value="1">
          <input type="submit" value="Subscribe">
        </form>
        <div id="newsletter-message"></div>
      </div>
    </div>
  </div>
</div>

<script>
document.getElementById('newsletter-form').addEventListener('submit', function(e) {
  e.preventDefault();
  
  var email = this.querySelector('input[name="emailaddy"]').value;
  var optedIn = this.querySelector('input[name="OptedIn"]').value;
  
  fetch('php/newsletter.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/form-data',
    },
    body: 'email=' + encodeURIComponent(email) + '&OptedIn=' + encodeURIComponent(optedIn)
  })
  .then(response => response.json())
  .then(data => {
    var messageElement = document.getElementById('newsletter-message');
    if (data.success) {
      messageElement.innerHTML = data.message;
      messageElement.style.color = 'green';
    } else {
      messageElement.innerHTML = 'Error: ' + data.message;
      messageElement.style.color = 'red';
    }
    console.log(data);
  })
  .catch((error) => {
    console.error('Error:', error);
    document.getElementById('newsletter-message').innerHTML = 'An error occurred. Please try again later.';
    document.getElementById('newsletter-message').style.color = 'red';
  });
});
</script>
    <div class="footer-top">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-5 col-md-12 footer-info">
            <a href="index.php" class="logo d-flex align-items-center">
              <img src="assets/img/logoswiftyresults.png" alt="">
              <span>SwiftyResults</span>
            </a>
            <p>Where success is just a click away.</p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <!-- <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li> -->
              <li><i class="bi bi-chevron-right"></i> <a href="#about">About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#services">Services</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-2 col-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#services">Shopify Setup</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#services">Website Development</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#services">Marketing Automation</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#services">CRM Implementation</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#services">SMS and Email Marketing</a></li>
            </ul>
          </div>


          <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
            <h4>Contact Us</h4>
            <p>
              Cape Coral, FL<br>
              United States <br><br>
              <!-- <strong>Phone:</strong> +1 5589 55488 55<br> -->
              <strong>Email:</strong> icpedrosa@swiftyresults.com<br>
            </p>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>SwiftyResults</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/SwiftyResults-bootstrap-startup-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <!-- <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a> -->

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/js/newsletter.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <?php include_once("php/analyticstracking.php") ?>
</body>

</html>