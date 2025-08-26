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
              <td align="center" style="padding:40px 20px;">
                <table width="600" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:10px; overflow:hidden; box-shadow:0 4px 12px rgba(0,0,0,0.08);">
                  <tr>
                    <td align="center" style="padding:30px 20px; border-bottom:1px solid #eee;">
                      <h1 style="margin:0; font-size:24px; color:#333;">🚀 ' . esc_html($title) . '</h1>
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
        <p style="margin:0 0 20px;">Thank you for registering with <strong>' . get_bloginfo('name') . '</strong>! Please confirm your email address to activate your account and get started.</p>
        <table cellpadding="0" cellspacing="0" border="0" align="center" style="margin:25px auto;">
          <tr>
            <td bgcolor="#0073e6" style="border-radius:6px;">
              <a href="' . esc_url($verification_url) . '" 
                 style="display:inline-block; padding:12px 25px; font-size:16px; color:#ffffff; text-decoration:none; border-radius:6px; font-weight:bold;">
                 Verify Email Address
              </a>
            </td>
          </tr>
        </table>
        <p style="font-size:13px; color:#999; margin-top:20px;">Or copy and paste this link into your browser:</p>
        <p style="font-size:13px; color:#0073e6; word-break:break-all;">
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
            <td bgcolor="#0073e6" style="border-radius:6px;">
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