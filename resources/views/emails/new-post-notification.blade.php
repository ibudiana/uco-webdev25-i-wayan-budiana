<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Blog Post</title>
    <style>
        /* Menggunakan font dari Google Fonts untuk tampilan yang lebih baik */
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

        /* Reset dasar */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        /* Style utama */
        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            background-color: #cde2f7;
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px 0;
        }

        .logo-container {
            text-align: center;
            padding: 20px 0;
        }

        .logo-container img {
            width: 100px;
        }

        .main-panel {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 40px;
            text-align: left;
        }

        .content h1 {
            font-size: 22px;
            font-weight: 700;
            color: #111827;
            margin: 0 0 15px 0;
        }

        .content p {
            font-size: 16px;
            line-height: 1.6;
            color: #374151;
            margin: 0 0 25px 0;
        }

        .post-title {
            font-size: 20px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 8px;
        }

        .post-excerpt {
            font-size: 16px;
            color: #4b5563;
            margin-bottom: 30px;
        }

        .btn-container {
            text-align: left;
        }

        .btn {
            display: inline-block;
            background-color: #9ca3af;
            color: #ffffff;
            padding: 14px 28px;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            font-size: 16px;
        }

        .fallback-link-container {
            padding-top: 20px;
            font-size: 12px;
            color: #6b7280;
            word-break: break-all;
        }

        .fallback-link-container a {
            color: #111827;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            color: #9ca3af;
            padding: 20px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="logo-container">
            <img src="https://ci3.googleusercontent.com/meips/ADKq_NaNYSs0xVcf3AXCpX2hBjaP3fEHUGgmZllmnytu9OXDRvD0sdhPLhPW8kISOZivoCj8DPtFCHnFTFzPiSABcGnU4SA=s0-d-e1-ft#https://laravel.com/img/notification-logo.png">
        </div>

        <div class="main-panel">
            <div class="content">
                <h1>New Post Alert!</h1>
                <p>Hello,</p>
                <p>We have just published a new article that you might like. Here is a snippet:</p>

                <h2 class="post-title">{{ $post->title }}</h2>

                <div class="btn-container">
                    <a href="{{ url('/blogs/' . $post->slug) }}" target="_blank" class="btn">Read Full Article</a>
                </div>

                <div class="fallback-link-container">
                    <p>If you're having trouble clicking the button above, copy and paste the URL below into your browser:</p>
                    <p><a href="{{ url('/blogs/' . $post->slug) }}">{{ url('/blogs/' . $post->slug) }}</a></p>
                </div>
                 <p style="margin-top: 30px;">Thank you,<br>Your Blog Team</p>
            </div>
        </div>

        <div class="footer">
            You are receiving this email because you subscribed to our blog.<br>
            &copy; {{ date('Y') }} Ibudiana. All Rights Reserved.
        </div>
    </div>
</body>
</html>
