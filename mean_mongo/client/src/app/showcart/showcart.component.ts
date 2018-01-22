import { Component, OnInit } from '@angular/core';
import {ContactService} from '../contact.service';

@Component({
  selector: 'app-showcart',
  templateUrl: './showcart.component.html',
  styleUrls: ['./showcart.component.css'],
  providers:[ContactService]
})
export class ShowcartComponent implements OnInit {
  list;
  res;
  amount_to_pay = 0 ;
  user_id= {"user_id":1};
  payment_url;
  payment_result;
  constructor(private contactservice:ContactService) { }

  buyproducts(){
    this.to_calculate_amount();
    var product_bill = {"amount":this.amount_to_pay,"currency":"USD"};
    this.contactservice.paynow(product_bill)
    .subscribe(payment_result =>{
      this.payment_result = payment_result;
      this.payment_url = payment_result.msg.toString();
      console.log(this.payment_url);
      window.open(this.payment_url+"&total="+this.amount_to_pay+"&currency=USD","_blank");
    })
    alert('buy');
  }

  to_calculate_amount(){
    console.log('to calculate amount');
    var total =0 ;
    for(var i=0;i<this.list.result.length;i++)
    {
     // total =  parseFloat(total) + parseFloat(this.list.result[i].product_cost);
     this.amount_to_pay +=   parseInt(this.list.result[i].product_cost);
    }
    console.log("total prize" + this.amount_to_pay);
  }

  removefromcart(cart_id){
    //var list = this.list;
    console.log(cart_id);
    this.contactservice.removefromcart(cart_id)
    .subscribe(res => {
      this.res = res;
      console.log(this.res);
      console.log("status is"+ this.res.status);
      if(this.res.status=='200')
      {
         alert('removed from cart');
         for (var i = 0; i < this.list.result.length; i++) {
          if (this.list.result[i].cart_id === cart_id) {
            this.list.result.splice(i, 1);
            break;
          }
        }
      }
    });
  }


  ngOnInit() {
    this.contactservice.get_cart_products(this.user_id)
    .subscribe(list =>{
      this.list = list;
      console.log(this.list);
    })
  }

}
