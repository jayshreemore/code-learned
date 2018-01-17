const express = require('express');
var mysql = require('mysql');
const router = express.Router();
var bodyparser = require('body-parser');
var app = express();
var cors = require('cors');

app.use(function(req, res, next) {
  res.header("Access-Control-Allow-Origin", "*");
  res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
  next();
});
var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "mean"
  });
 
  var sess;
  app.get('/',function(req,res){
      sess=req.session;
      /*
      * Here we have assign the 'session' to 'sess'.
      * Now we can create any number of session variable we want.
      * in PHP we do as $_SESSION['var name'].
      * Here we do like this.
      */
      this.sess.user_id; 
      console.log("##########");
      console.log(sess);
      console.log("##########");
      // equivalent to $_SESSION['email'] in PHP.
       // equivalent to $_SESSION['username'] in PHP.
  });


router.post('/login',function(req,res){
  var username = req.body.username;
  var password = req.body.password;
  var result;
  var sess = {};
  if(!req.session.visitcount)
  {
    req.session.visitcount = 1;
  }
  else
  {
    req.session.visitcount++;
  }
  
  var query = con.query("select * from tbl_user where username='"+username +"'and password='"+password+"'",function(err,result,fields){
    
    var rows = result.length;
    if(rows == 1)
    {
      postvalue = {
        "status":"200",
        "msg":"user found"
      }
      //this.sess = "nik";
      this.sess=req.session;
      sess.user_id = result[0].id;
      console.log("__________");
      console.log(this.sess);
      console.log("__________");
      next();
      res.json(postvalue);
    }
    else if(rows>1)
    {
      postvalue = {
        "status":"409",
        "msg":"more than one user"
      }
      res.json(postvalue);
    }
    else
    {
      postvalue = {
        "status":"204",
        "msg":"no user found"
      }
      res.json(postvalue);
    }
  });
  console.log(query.sql);
})


router.get('/contacts',function(req,res){
  //sess=req.session;
  console.log("*********");
  console.log(sess);
  console.log("*********");
   if(req.session.user_id!=null || req.session.user_id!=undefined)
   {
    con.query("SELECT * FROM contacts", function (err, result, fields) {
        if (err) throw err;
       postvalue = {
         "status":"200",
         "result":result
       }
       //console.log(req.session);
        res.json(postvalue);
      });
    }
    else
    {
     postvalue = {
      "status":"403",
      "result":"user not logged in"
      }
      
      res.json(postvalue);
    }
   
});

router.post('/addcontact',function(req,res){

    var name = req.body.name;
    console.log('print name'+ name);
    var contact = req.body.contact;
    var sql = "INSERT INTO contacts (name, contact) VALUES ?";
    var values = [
        [name,contact]
    ];
    con.query(sql,[values], function (err, result) {
      if (err) throw err;
      
      res.json("hi");
     // console.log("1 record inserted");
      //res.send('contact added successfully');
    });
});

router.delete('/deletcontact/:id',function(req,res){
    var id = req.params.id;
    var sql = "delete from contacts where id ="+id;
    con.query(sql, function (err, result) {
        if (err) throw err;
        res.json(result);
       // console.log("1 record deleted");
       // res.send('record deleted successfully');
      });
});

router.get('/logout',function(req,res){
  req.session.destroy();
  console.log("sessions are:"+ req.session);
  postvalue = {
    "status":"200"
  }
   res.json(postvalue);
 
});

module.exports = router;