<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interview Invitation</title>
    <style>
        /* Resetting some default styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9fafb; /* Light gray background for a soft, professional look */
            color: #4a4a4a; /* Neutral text color */
            padding: 40px 0;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .email-container {
            background-color: #ffffff; /* White background for the main email body */
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); /* Soft shadow for depth */
            border: 1px solid #e4e7eb; /* Light border for a clean look */
        }

        h3 {
            color: #2d3e50; /* Soft blue-gray color for headings */
            font-size: 28px;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            color: #555; /* Slightly darker gray for paragraphs */
        }

        h5 {
            font-size: 18px;
            color: #1e4e89; /* Professional dark blue for important headings */
            margin-top: 30px;
            margin-bottom: 10px;
        }

        ul {
            list-style-type: none;
            padding-left: 0;
            margin-bottom: 20px;
        }

        ul li {
            margin-bottom: 12px;
            font-size: 16px;
            color: #333; /* Standard text color for list items */
        }

        strong {
            color: #1e4e89; /* Matching color for labels */
        }

        .footer-text {
            font-size: 14px;
            color: #8c8c8c; /* Lighter gray for footer text */
            margin-top: 30px;
            text-align: center;
        }

        /* Button Styling */
        .btn-primary {
            background-color: #ff5722; /* Orange button for professionalism */
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
            font-size: 16px;
            text-decoration: none;
            margin-top: 20px;
        }

        .btn-primary:hover {
            background-color: #e64a19; /* Darker orange on hover */
            cursor: pointer;
        }

        /* Footer Section */
        .footer {
            background-color: #f1f1f1; /* Soft gray background for footer */
            color: #555;
            padding: 20px 0;
            text-align: center;
        }

        .footer p {
            font-size: 14px;
        }

        /* Signature styling */
        .signature {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #e4e7eb;
            color: #4a4a4a;
        }

        .signature p {
            font-size: 16px;
            line-height: 1.5;
        }

        .signature strong {
            color: #1e4e89; /* Matching color for the name and company */
        }

        .signature .contact-info {
            color: #ff5722; /* Orange color for the contact number */
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="email-container">
            <h3>Interview Invitation</h3>
            <p>Dear {{ $candidateName }},</p>
            <p>We are excited to invite you to interview for the <strong>{{ $jobTitle }}</strong> position at <strong>Rawsio.com</strong>. Below are the interview details:</p>

            <div class="interview-details">
                <h5>Interview Details:</h5>
                <ul>
                    <li><strong>Date:</strong> {{ $interviewDate }}</li>
                    <li><strong>Time:</strong> {{ $interviewTime }}</li>
                    <li><strong>Location:</strong> {{ $interviewLocation }}</li>
                </ul>
            </div>

            <p>We look forward to meeting you soon!</p>

            <p class="footer-text">
                Best regards,<br>
                <strong>{{ $candidateName }}</strong><br>
                PHP Developer<br>
                Rawsio.com
            </p>

            <div style="text-align: center;">
                <a href="rawsio.com" class="btn-primary text-white">Contact Us</a>
            </div>
        </div>
    </div>

    <!-- Signature Section -->
    <div class="signature">
        <p><strong>Sandhya Pandey</strong><br>
        HR Executive<br>
        <span class="contact-info">☎8657027042</span><br>
        Litmus Information Systems LLP<br>
        506/Options Primo | Sainath Nagar | Near Passport Office | Andheri(E) | Mumbai 400093.<br>
        <a href="https://www.litmusit.com" target="_blank" style="color: #ff5722;">www.litmusit.com</a></p>

        <p style="font-size: 12px; color: #8c8c8c;">CONFIDENTIAL: This email and any files transmitted with it are confidential and intended solely for the use of the individual or entity to whom they are addressed. If you have received this email in error please notify the system manager. This message contains confidential information and is intended only for the individual named. If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system.</p>
    </div>

    <div class="footer">
        <p>&copy; {{ date('Y') }} Litmus Information Systems LLP. All Rights Reserved.</p>
    </div>
</body>
</html>
