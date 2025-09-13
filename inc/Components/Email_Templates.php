<?php 

namespace Engispace\Components;

// File Security Check
if ( ! defined( 'ABSPATH' ) ) exit;

class Email_Templates {
    
    /**
     * Generate email template wrapper
     * 
     * @param string $title Email title
     * @param string $content Email content HTML
     * @return string Complete HTML email template
     */
    public static function get_template_wrapper($title, $content) {
        return '
        <!DOCTYPE html>
        <html>
        <head>
          <meta charset="UTF-8">
          <title>' . esc_html($title) . '</title>
        </head>
        <body style="margin:0; padding:0; background-color:#f5f7fa; font-family:Arial, sans-serif;">

          <table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f5f7fa">
            <tr>
              <td align="center" style="padding:40px 20px 20px 20px;">
                <!-- Logo above main table -->
                <table width="600" cellpadding="0" cellspacing="0" border="0" bgcolor="#3C3F41" style="border-radius:10px 10px 0 0; margin-bottom:0;">
                  <tr>
                    <td align="center" style="padding:30px 20px;">
                      <img src="https://engispace.com/wp-content/uploads/2024/05/engispace-logo-white-2@2x.png" 
                           alt="' . esc_attr(get_bloginfo('name')) . '" 
                           style="max-width:200px; height:auto; display:block;">
                    </td>
                  </tr>
                </table>
                <!-- Main content table -->
                <table width="600" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:0 0 10px 10px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.08); margin-top:0;">
                  <!-- Title Header -->
                  <tr>
                    <td align="center" style="padding:30px 20px; border-bottom:1px solid #eee;">
                      <h1 style="margin:0; font-size:24px; color:#333;">' . esc_html($title) . '</h1>
                    </td>
                  </tr>

                  <tr>
                    <td style="padding:30px 40px; color:#555; font-size:15px; line-height:1.6;">
                      ' . $content . '
                    </td>
                  </tr>

                  <tr>
                    <td align="center" style="padding:20px; background:#f9fafc; font-size:13px; color:#999;">
                      <p style="margin:0;">Best regards, <br> The ' . get_bloginfo('name') . ' Team</p>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>

        </body>
        </html>
        ';
    }
    
    /**
     * Generate verification email content
     * 
     * @param string $first_name User's first name
     * @param string $verification_url Verification URL
     * @return string HTML email content
     */
    public static function get_verification_email_content($first_name, $verification_url) {
        $content = '
        <p style="margin:0 0 15px;">Hi <strong>' . esc_html($first_name) . '</strong>,</p>
        <p style="margin:0 0 20px;">Thank you for registering with <strong>EngiSpace</strong>! Please confirm your email address to activate your account and get started.</p>
        <table cellpadding="0" cellspacing="0" border="0" align="center" style="margin:25px auto;">
          <tr>
            <td bgcolor="#f24c00" style="border-radius:6px;">
              <a href="' . esc_url($verification_url) . '" 
                 style="display:inline-block; padding:12px 25px; font-size:16px; color:#ffffff; text-decoration:none; border-radius:6px; font-weight:bold;">
                 Verify Email Address
              </a>
            </td>
          </tr>
        </table>
        <p style="font-size:13px; color:#999; margin-top:20px;">Or copy and paste this link into your browser:</p>
        <p style="font-size:13px; color:#f24c00; word-break:break-all;">
          ' . esc_url($verification_url) . '
        </p>
        <p style="font-size:13px; color:#999;">⚠️ This link will expire in 24 hours.</p>
        ';
        
        return $content;
    }
    
    /**
     * Generate welcome email content
     * 
     * @param string $first_name User's first name
     * @return string HTML email content
     */
    public static function get_welcome_email_content($first_name) {
        $content = '
        <p style="margin:0 0 15px;">Hi <strong>' . esc_html($first_name) . '</strong>,</p>
        <p style="margin:0 0 20px;">Welcome to <strong>' . get_bloginfo('name') . '</strong>! Your email has been successfully verified and your account is now active.</p>
        <p style="margin:0 0 20px;">You can now access all our features and start your learning journey with us.</p>
        <table cellpadding="0" cellspacing="0" border="0" align="center" style="margin:25px auto;">
          <tr>
            <td bgcolor="#f24c00" style="border-radius:6px;">
              <a href="' . home_url() . '" 
                 style="display:inline-block; padding:12px 25px; font-size:16px; color:#ffffff; text-decoration:none; border-radius:6px; font-weight:bold;">
                 Start Learning Now
              </a>
            </td>
          </tr>
        </table>
        <p style="font-size:13px; color:#999; margin-top:20px;">If you have any questions, feel free to contact our support team.</p>
        ';
        
        return $content;
    }
    
    /**
     * Generate password reset email content
     * 
     * @param string $first_name User's first name
     * @param string $reset_url Password reset URL
     * @return string HTML email content
     */
    public static function get_password_reset_email_content($first_name, $reset_url) {
        $content = '
        <p style="margin:0 0 15px;">Hi <strong>' . esc_html($first_name) . '</strong>,</p>
        <p style="margin:0 0 20px;">We received a request to reset your password for your <strong>EngiSpace</strong> account.</p>
        <p style="margin:0 0 20px;">Click the button below to reset your password:</p>
        <table cellpadding="0" cellspacing="0" border="0" align="center" style="margin:25px auto;">
          <tr>
            <td bgcolor="#f24c00" style="border-radius:6px;">
              <a href="' . esc_url($reset_url) . '" 
                 style="display:inline-block; padding:12px 25px; font-size:16px; color:#ffffff; text-decoration:none; border-radius:6px; font-weight:bold;">
                 Reset Password
              </a>
            </td>
          </tr>
        </table>
        <p style="font-size:13px; color:#999; margin-top:20px;">Or copy and paste this link into your browser:</p>
        <p style="font-size:13px; color:#f24c00; word-break:break-all;">
          ' . esc_url($reset_url) . '
        </p>
        <p style="font-size:13px; color:#999;">⚠️ This link will expire in 24 hours.</p>
        <p style="font-size:13px; color:#999; margin-top:20px;">If you did not request a password reset, please ignore this email.</p>
        ';
        
        return $content;
    }
    
    /**
     * Generate course purchase confirmation email content
     * 
     * @param string $first_name User's first name
     * @param string $course_title Course title
     * @param string $course_url Course URL
     * @return string HTML email content
     */
    public static function get_course_purchase_email_content($first_name, $course_title, $course_url = '') {
        $content = '
        <p style="margin:0 0 15px;">Hi <strong>' . esc_html($first_name) . '</strong>,</p>
        <p style="margin:0 0 20px;">Thank you for purchasing <strong>' . esc_html($course_title) . '</strong> from <strong>EngiSpace</strong>!</p>
        <p style="margin:0 0 20px;">Your payment has been successfully processed and you now have full access to the course content.</p>
        <p style="margin:0 0 20px;">Here\'s what you can do now:</p>
        <ul style="margin:0 0 20px 0; padding-left:20px; color:#555;">
            <li style="margin-bottom:8px;">Access all course materials and videos</li>
            <li style="margin-bottom:8px;">Download course resources</li>
            <li style="margin-bottom:8px;">Participate in course discussions</li>
            <li style="margin-bottom:8px;">Track your learning progress</li>
        </ul>';
        
        if ($course_url) {
            $content .= '
            <table cellpadding="0" cellspacing="0" border="0" align="center" style="margin:25px auto;">
              <tr>
                <td bgcolor="#f24c00" style="border-radius:6px;">
                  <a href="' . esc_url($course_url) . '" 
                     style="display:inline-block; padding:12px 25px; font-size:16px; color:#ffffff; text-decoration:none; border-radius:6px; font-weight:bold;">
                     Start Learning Now
                  </a>
                </td>
              </tr>
            </table>';
        }
        
        $content .= '
        <p style="font-size:13px; color:#999; margin-top:20px;">If you have any questions about the course, feel free to contact our support team.</p>
        <p style="font-size:13px; color:#999;">Happy learning!</p>
        ';
        
        return $content;
    }
    
    /**
     * Generate course review notification email content
     * 
     * @param string $author_name Course author's name
     * @param string $course_title Course title
     * @param string $reviewer_name Reviewer's name
     * @param string $review_content Review content
     * @param string $review_url URL to view review in admin
     * @return string HTML email content
     */
    public static function get_course_review_email_content($author_name, $course_title, $reviewer_name, $review_content, $review_url = '') {
        $content = '
        <p style="margin:0 0 15px;">Hi <strong>' . esc_html($author_name) . '</strong>,</p>
        <p style="margin:0 0 20px;">Thanks for creating a course on our EngiSpace platform. After reviewing your course, we think these changes are required before we publish the course on our platform. Please review the course and make the necessary changes.</p>
        
        <div style="background:#f9fafc; border-left:4px solid #f24c00; padding:20px; margin:20px 0;">
            <p style="margin:0 0 10px; font-weight:bold; color:#333;">Reviewed by ' . esc_html($reviewer_name) . ':</p>
            <p style="margin:0; color:#555; font-style:italic;">"' . esc_html($review_content) . '"</p>
        </div>
        
        <p style="margin:0 0 20px;">This feedback helps build trust with potential students and improves your course visibility on our platform.</p>';
        
        if ($review_url) {
            $content .= '
            <table cellpadding="0" cellspacing="0" border="0" align="center" style="margin:25px auto;">
              <tr>
                <td bgcolor="#f24c00" style="border-radius:6px;">
                  <a href="' . esc_url($review_url) . '" 
                     style="display:inline-block; padding:12px 25px; font-size:16px; color:#ffffff; text-decoration:none; border-radius:6px; font-weight:bold;">
                     Update your course
                  </a>
                </td>
              </tr>
            </table>';
        }
        
        $content .= '
        <p style="font-size:13px; color:#999; margin-top:20px;">Keep up the great work creating valuable content for the EngiSpace community!</p>
        ';
        
        return $content;
    }
    
    /**
     * Generate membership subscription confirmation email content
     * 
     * @param string $first_name User's first name
     * @param string $membership_type Membership type (creator or pro)
     * @return string HTML email content
     */
    public static function get_membership_subscription_email_content($first_name, $membership_type) {
        $membership_title = ucfirst($membership_type);
        $benefits = [];
        $cta_url = home_url();
        $cta_text = 'Get Started';
        
        if ($membership_type === 'creator') {
            $benefits = [
                'Create and sell unlimited courses',
                'Access to instructor dashboard and analytics',
                'Priority support for course creation',
                'Revenue sharing opportunities',
                'Community access to connect with other creators'
            ];
            $cta_url = home_url('/instructor-dashboard');
            $cta_text = 'Start Creating Courses';
        } elseif ($membership_type === 'pro') {
            $benefits = [
                'Access to all premium courses',
                'Download course materials and resources',
                'Priority customer support',
                'Exclusive webinars and live sessions',
                'Community access and networking opportunities'
            ];
            $cta_url = home_url('/courses');
            $cta_text = 'Browse Premium Courses';
        }
        
        $content = '
        <p style="margin:0 0 15px;">Hi <strong>' . esc_html($first_name) . '</strong>,</p>
        <p style="margin:0 0 20px;">🎉 Congratulations! Your payment has been successfully processed and you are now a <strong>' . esc_html($membership_title) . '</strong> member of <strong>EngiSpace</strong>!</p>
        <p style="margin:0 0 20px;">Your membership gives you access to exclusive benefits:</p>
        <ul style="margin:0 0 20px 0; padding-left:20px; color:#555;">';
        
        foreach ($benefits as $benefit) {
            $content .= '<li style="margin-bottom:8px;">' . esc_html($benefit) . '</li>';
        }
        
        $content .= '
        </ul>
        <p style="margin:0 0 20px;">We\'re excited to have you as part of our community!</p>
        <table cellpadding="0" cellspacing="0" border="0" align="center" style="margin:25px auto;">
          <tr>
            <td bgcolor="#f24c00" style="border-radius:6px;">
              <a href="' . esc_url($cta_url) . '" 
                 style="display:inline-block; padding:12px 25px; font-size:16px; color:#ffffff; text-decoration:none; border-radius:6px; font-weight:bold;">
                 ' . esc_html($cta_text) . '
              </a>
            </td>
          </tr>
        </table>
        <p style="font-size:13px; color:#999; margin-top:20px;">If you have any questions about your membership, feel free to contact our support team.</p>
        <p style="font-size:13px; color:#999;">Welcome to the EngiSpace community!</p>
        ';
        
        return $content;
    }
    
    /**
     * Send email with template
     * 
     * @param string $to Email address
     * @param string $subject Email subject
     * @param string $title Email title (for header)
     * @param string $content Email content HTML
     * @param string $from_name From name (optional)
     * @param string $from_email From email (optional)
     * @return bool Success status
     */
    public static function send_email($to, $subject, $title, $content, $from_name = null, $from_email = null) {
        // Sanitize email address
        $to_email = sanitize_email($to);
        if (!is_email($to_email)) {
            return false;
        }
        
        // Generate complete email HTML
        $message = self::get_template_wrapper($title, $content);
        
        // Set default from values
        if (!$from_name) {
            $from_name = get_bloginfo('name');
        }
        if (!$from_email) {
            $from_email = get_option('admin_email');
        }
        
        $headers = [
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $from_name . ' <' . $from_email . '>'
        ];
        
        return wp_mail($to_email, $subject, $message, $headers);
    }
}