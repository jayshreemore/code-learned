var express = require('express');
var mysql = require('mysql');
var bodyparser = require('body-parser');
var cors = require('cors');
var app = express();
var Session = require('express-session');
var MemoryStore =Session.MemoryStore;
app.use(Session({secret: 'rtrtrgrter', saveUninitialized: true, resave: false,store: new MemoryStore(),cookie: {
  path: '/',
  httpOnly: true,
  secure: true,
  maxAge: 24 * 60 * 60 * 1000,
  signed: false
},}));
app.use(function(req, res, next) {
  res.header("Access-Control-Allow-Origin", "*");
  res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
  next();
});
var path = require('path');

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "mean"
});

con.connect(function(err) {
  
  console.log(err);
});




const port = 3000;

app.use(cors());
app.use(bodyparser.json());
app.use(express.static(path.join(__dirname,'public')));

// Add headers
app.use(function (req, res, next) {

    // Website you wish to allow to connect
    res.header('Access-Control-Allow-Origin', '*');

    // Request methods you wish to allow
    res.header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS, PUT, PATCH, DELETE');

    // Request headers you wish to allow
    res.header('Access-Control-Allow-Headers', 'content-type');

    // Set to true if you need the website to include cookies in the requests sent
    // to the API (e.g. in case you use sessions)
    //res.header('Access-Control-Allow-Credentials', true);

    // Pass to next layer of middleware
    next();
});


const route = require('./routes/route');

app.use('/api',route);

app.get('/',function(req,res){
res.send('works');
});

app.listen(port,()=>{
console.log('listing to port'+port);
});