const express = require('express');
var mysql = require('mysql');
const router = express.Router();
var bodyparser = require('body-parser');
var app = express();
var cors = require('cors');

app.use(function(req, res, next) {
  res.header("Access-Control-Allow-Origin", "*");
  res.header("Access-Control-Allow-Headers", "Origin, X-Requested-With, Content-Type, Accept");
  res.header('Access-Control-Allow-Credentials', 'true');
  next();
});
var con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "mean"
  });

//**********************************************************************************************************


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
  
  var query = con.query("select * from tbl_user where (username='"+username +"' or email='"+username+"' or contact='"+username+"')and password='"+password+"'",function(err,result,fields){
    
    var rows = result.length;
    if(rows == 1)
    {
      postvalue = {
        "status":"200",
        "result":result
      }
     
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

//**********************************************************************************************************

router.get('/contacts',function(req,res){
   
    con.query("SELECT * FROM contacts", function (err, result, fields) {
        if (err) throw err;
       postvalue = {
         "status":"200",
         "result":result
       }
       //console.log(req.session);
        res.json(postvalue);
      });
   
   
});

//**********************************************************************************************************

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

//**********************************************************************************************************

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

//**********************************************************************************************************

router.post('/register',function(req,res){
  var check_count
  var username = req.body.username;
  var email = req.body.email;
  var contact = req.body.contact;
  var password = req.body.password;
  var contact = req.body.contact;

  var check = con.query("select * from tbl_user where (username='"+username +"' or email='"+username+"' or contact='"+username+"')",function(err,result,fields){
  this.check_count = result.length;
  });

  if(check_count==0)
  {

      var sql = "INSERT INTO tbl_user (username, contact,email,password) VALUES ?";
      var values = [
          [username,contact,email,password]
      ];
      var query = con.query(sql,[values], function (err, result) {
        if (err){
          postvalue = {
            "status":"204",
            "result":"error while inserting"
          }
        }
        else
        {
          postvalue = {
            "status":"200",
            "result":"ok"
          }
        }
        //res.json("postvalue");
        res.json(postvalue);
      // console.log("1 record inserted");
        //res.send('contact added successfully');
      });
      console.log(query.sql);
  }
  else
  {
    postvalue = {
      "status":"409",
      "result":"User with this username is already present"
    }
    res.json(postvalue);
  }
});

//**********************************************************************************************************



router.get('/logout',function(req,res){
  req.session.destroy();
  console.log("sessions are:"+ req.session);
  postvalue = {
    "status":"200"
  }
   res.json(postvalue);
 
});

//**********************************************************************************************************

router.get('/product_list',function(req,res){
   
  con.query("SELECT * FROM products", function (err, result, fields) {
      if (err)
      {
        postvalue = {
          "status":"204",
          "result":"error in query"
        }
      }
      else
      {
          postvalue = {
            "status":"200",
            "result":result
          }
      }
     //console.log(req.session);
      res.json(postvalue);
    });
 
 
});

//**********************************************************************************************************


router.post('/addtocart',function(req,res){
  var user_id = req.body.user_id;
  //console.log('user id'+ user_id);
  var product_id = req.body.product_id;
  var check_count;
var check = con.query("select * from cart where user_id='"+user_id +"' and product_id='"+product_id+"'",function(err,result,fields){
  check_count = result.length;
  
        console.log(check.sql);
        console.log(check_count);
        if(check_count >=1)
        {
          postvalue = {
            "status":"409",
            "result":"product is already in cart"
          }
          res.json(postvalue);
         
        }
        else
        {
          var sql = "INSERT INTO cart (user_id, product_id) VALUES ?";
          var values = [
              [user_id,product_id]
          ];
          con.query(sql,[values], function (err, result) {
            if (err) throw err;
            postvalue = {
              "status":"200",
              "result":"added to cart"
            }
            res.json(postvalue);
          });
        }
  });
});


//**********************************************************************************************************


router.post('/get_cart_products',function(req,res){
   user_id = req.body.user_id;
 var cart_list =  con.query("select * from cart as c inner join products as p on c.product_id=p.product_id where user_id='"+user_id+"'", function (err, result, fields) {
    rows = result.length;  
    if (rows == 0)
      {
        postvalue = {
          "status":"204",
          "result":"no products available in cart"
        }
      }
      else
      {
          postvalue = {
            "status":"200",
            "result":result
          }
      }
     //console.log(req.session);
      res.json(postvalue);
    });
    console.log(cart_list.sql);
});

//**********************************************************************************************************


router.delete('/removefromcart/:id',function(req,res){
  var id = req.params.id;
  var sql = "delete from cart where cart_id ="+id;
  con.query(sql, function (err, result) {
      if (err) throw err;
      postvalue = {
        "status":"200",
        "result":"ok"
      }
      res.json(postvalue);
     // console.log("1 record deleted");
     // res.send('record deleted successfully');
    });
});


//**********************************************************************************************************
var paypal = require('paypal-rest-sdk');
var config = {
  "port" : 3000,
  "api" : {
    "host" : "api.sandbox.paypal.com",
    "port" : "",            
    "client_id" : "AZjaFzSviZ6-QvyIPPhgETUTO301OdiXulwzY2rVXKye6SgAyQIFMkzOYu37VyE067XFA1ge-qt4mDv3",  // your paypal application client id
    "client_secret" : "EDxIJQitACq1aS8XlZ6NlJ2NYMCu9Z-h75LqcsD5UogRGWgVBOeWb1daVmIisVPYZRy_dLSfVVJD0UNF" // your paypal application secret id
  }
}
paypal.configure(config.api);
transaction_values = [];
router.post('/paynow', function(req, res) {
  // paypal payment configuration.
transaction_values['total'] = parseInt(req.body.amount);
transaction_values['currency'] = req.body.currency;
var payment = {
"intent": "sale",
"payer": {
 "payment_method": "paypal"
},
"redirect_urls": {
 "return_url": app.locals.baseurl+"/success",
 "cancel_url": app.locals.baseurl+"/cancel"
},
"transactions": [{
 "amount": {
 "currency":'USD' ,
   "total":'10'
   
 },
 "description": req.body.description
}]
};

paypal.payment.create(payment, function (error, payment) {
 var data = { "success":payment} 
res.end( JSON.stringify(data));

if (error) {
 console.log(error);
} else {
 
 if(payment.payer.payment_method === 'paypal') {
   req.paymentId = payment.id;
   var redirectUrl;
   res.send(payment);
   /*
   console.log(payment);
   for(var i=0; i < payment.links.length; i++) {
     var link = payment.links[i];
 console.log(link);
     if (link.method === 'REDIRECT') {
       redirectUrl = link.href;
 
     }
     
   }
   */
   //res.redirect(redirectUrl);
 }
}
});

});


module.exports = router;