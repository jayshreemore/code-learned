/*
* Author: Rohit Kumar
* Date: 24-06-2015
* Website: iamrohit.in
* App Name: Node Emailer
* Description: NodeJs script to send emails
*/
var http=require('http');
var express=require('express');
var nodemailer = require("nodemailer");
var bodyParser = require('body-parser');
var app=express();
var port = Number(process.env.PORT || 5000);
app.use(bodyParser.json()); // to support JSON-encoded bodies
app.use(bodyParser.urlencoded({
  extended: true
}));
 
// Home page
app.get('/',function(req,res){
    res.sendFile(__dirname+'/index.html');
});

app.post('/test',function(req,res){
    res.send('');
});

 
// sending mail function
app.post('/send', function(req, res){
if(req.body.email == "" || req.body.subject == "") {
  res.send("Error: Email & Subject should not blank");
  return false;
}
// Sending Email Without SMTP


var transporter = nodemailer.createTransport({
    service: 'gmail',
	 auth: {
            user: 'nikita.somawar@gmail.ccm', // generated ethereal user
            pass: 'sangamesh'  // generated ethereal password
        }
});


 let mailOptions = {
        from: '"Fred Foo 👻" <nikita.somawar59@gmail.com>', // sender address
        to: req.body.email, // list of receivers
        subject: req.body.subject, // Subject line
        text: req.body.description, // plain text body
        html: '<b>Hello world?</b>' // html body
    };
	
	
	

 transporter.sendMail(mailOptions, (error, info) => {
        if (error) {
            return console.log(error);
        }
        console.log('Message sent: %s', info.messageId);
        // Preview only available when sending through an Ethereal account
        console.log('Preview URL: %s', nodemailer.getTestMessageUrl(info));

        // Message sent: <b658f8ca-6296-ccf4-8306-87d57a0b4321@blurdybloop.com>
        // Preview URL: https://ethereal.email/message/WaQKMgKddxQDoou...
    });


//res.send("Email has been sent successfully");
 
   // Sending Emails with SMTP, Configuring SMTP settings
 
    /*var smtpTransport = nodemailer.createTransport("SMTP",{
             host: "smtp.gmail.com", // hostname
    secureConnection: true, // use SSL
    port: 465, // port for secure SMTP
            auth: {
                 user: "rohit0kumar@hotmail.com",
                 pass: "['YourHotmailPassword']"
            }
        });
        var mailOptions = {
            from: "Node Emailer ✔ <no-reply@iamrohit.in>", // sender address
            to: req.body.email, // list of receivers
            subject: req.body.subject+" ✔", // Subject line
            //text: "Hello world ✔", // plaintext body
            html: "<b>"+req.body.description+"</b>" // html body
        }
        smtpTransport.sendMail(mailOptions, function(error, response){
        if(error){
             res.send("Email could not sent due to error: "+error);
        }else{
             res.send("Email has been sent successfully");
        } 
    }); */
});
 
// Starting server
var server = http.createServer(app).listen(port, function() {
console.log("Listening on " + port);
});