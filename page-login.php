<?php
/* Template Name: Custom Login */
get_template_part('header', 'login'); ?>

<main class="site-main">
 <section class="login-form-container" style="max-width: 400px; margin: 0 auto; padding: 2em;">
    <h2>Login</h2>

    <?php
    // Show registration success message if redirected from registration
    if ( isset($_GET['registered']) && $_GET['registered'] == 1 ) :
        echo '<p class="success-message" style="color: green;">Registration successful. Please log in.</p>';
    endif;
    ?>

    <?php
    // show login errors if any
        if ( isset($_GET['login']) && $_GET['login'] === 'failed' ) {
            echo '<div class="error"><p>Login failed: Incorrect username or password.</p></div>';
        } elseif ( isset($_GET['login']) && $_GET['login'] === 'empty' ) {
            echo '<div class="error"><p>Login failed: Username and/or password is empty.</p></div>';
        } elseif ( isset($_GET['login']) && $_GET['login'] === 'false' ) {
            echo '<div class="error"><p>You are logged out.</p></div>';
        }
    ?>


    <?php
    if ( is_user_logged_in() ) {
        echo '<p>You are already logged in. <a href="' . esc_url( home_url() ) . '">Go to homepage</a></p>';
    } else {
        $args = [
            'echo' => true,
            'redirect' => home_url('/login/'),
            'form_id' => 'custom_login_form',
            'label_username' => 'Username',
            'label_password' => 'Password',
            'label_remember' => 'Remember Me',
            'label_log_in' => 'Log In',
        ];
        wp_login_form( $args );
    }
    ?>

    <?php if ( ! is_user_logged_in() ) : ?>
        <p>Don’t have an account? <a href="<?php echo esc_url( home_url( '/register/' ) ); ?>">Register here</a></p>
    <?php endif; ?>
</section>

<div class="edgar-intro">
    <p>
        The “Experimental Data and Geometric Analysis Repository”, or EDGAR is an Internet-based archive of curated data that are freely distributed to the international research community for the application and validation of electrocardiographic imaging (ECGI) techniques. The EDGAR project is a collaborative effort by the Consortium for ECG Imaging (CEI, ecg-imaging.org), and focused on two specific aims. One aim is to host an online repository that provides access to a wide spectrum of data , and the second aim is to provide a standard information format for the exchange of these diverse datasets.
    </p>
</div>

</main>

<?php get_template_part('footer', 'login'); ?>
