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
  user_id= {"user_id":1};
  constructor(private contactservice:ContactService) { }

  buyproducts(){
    alert('buy');
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
