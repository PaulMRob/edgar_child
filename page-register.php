<?php
/* Template Name: Custom Register */

// Handle registration first — before any HTML is output
if (
    $_SERVER['REQUEST_METHOD'] === 'POST' &&
    isset($_POST['custom_registration_nonce']) &&
    wp_verify_nonce($_POST['custom_registration_nonce'], 'register_user')
) {
    $username = sanitize_user($_POST['username']);
    $email = sanitize_email($_POST['email']);
    $password = $_POST['password'];
    $errors = [];

    if ( empty($username) || username_exists($username) ) {
        $errors[] = 'Invalid or existing username.';
    }

    if ( empty($email) || !is_email($email) || email_exists($email) ) {
        $errors[] = 'Invalid or already registered email.';
    }

    if ( empty($password) || strlen($password) < 6 ) {
        $errors[] = 'Password must be at least 6 characters.';
    }

    if ( empty($errors) ) {
        $user_id = wp_create_user($username, $password, $email);
        if ( ! is_wp_error($user_id) ) {
            // Redirect to login page after registration
            wp_redirect(home_url('/login/?registered=1'));
            exit;
        } else {
            $errors[] = 'Registration failed: ' . $user_id->get_error_message();
        }
    }
}

get_template_part( 'header', 'login' ); ?>
<body <?php body_class(); ?>>
  <div class="register-page-wrapper">
    <main class="site-main">
      <section class="register-form-container">

        <form method="post">
            <?php wp_nonce_field('register_user', 'custom_registration_nonce'); ?>
            <p>
                <label>Username<br>
                <input type="text" name="username" required></label>
            </p>
            <p>
                <label>Email<br>
                <input type="email" name="email" required></label>
            </p>
            <p>
                <label>Password<br>
                <input type="password" name="password" required></label>
            </p>
            <p>
                <button type="submit">Register</button>
            </p>
        </form>
    </section>
</main>
</div>
<div>
    <h4>DISCLAIMER!</h4>
    <p>
        By creating an account, you consent to the collection and processing of your personal data in accordance with our Privacy Policy. We use this data to provide and improve our services. You have the right to access, modify, or delete your data at any time. Read our [Privacy Policy] for more information.
    </p>
</div>
<div class="edgar-intro">
    <p>
        The “Experimental Data and Geometric Analysis Repository”, or EDGAR is an Internet-based archive of curated data that are freely distributed to the international research community for the application and validation of electrocardiographic imaging (ECGI) techniques. The EDGAR project is a collaborative effort by the Consortium for ECG Imaging (CEI, ecg-imaging.org), and focused on two specific aims. One aim is to host an online repository that provides access to a wide spectrum of data , and the second aim is to provide a standard information format for the exchange of these diverse datasets.
    </p>
</div>
</body>
<?php get_template_part( 'footer', 'login' ); ?>
