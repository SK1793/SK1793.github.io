const sgMail = require('./@sendgrid/mail'); // Or use nodemailer for other providers

exports.handler = async (event) => {
    const { name, email, message } = JSON.parse(event.body).payload.data;

    const msg = {
        to: 'manjusk017@gmail.com',
        from: 'manjusk1793@gmail.com',
        subject: 'New message from website',
        text: `Name: ${name}\nEmail: <span class="math-inline">\{email\}\\nMessage\:\\n</span>{message}`
    };

    sgMail.setApiKey(process.env.SENDGRID_API_KEY); // Use environment variable for security
    await sgMail.send(msg);

    return { statusCode: 200, body: 'Email sent successfully!' };
};
