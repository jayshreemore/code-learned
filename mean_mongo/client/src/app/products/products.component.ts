import { Component, OnInit } from '@angular/core';
import {Router} from '@angular/router';
import {ContactService} from '../contact.service';
import {CurrentuserinfoService} from '../currentuserinfo.service';

@Component({
  selector: 'app-products',
  templateUrl: './products.component.html',
  styleUrls: ['./products.component.css'],
  providers:[ContactService,CurrentuserinfoService],
  //pipes:[CatfilterPipe];

})
export class ProductsComponent implements OnInit {
  products;
  constructor(private router:Router,private contactservice:ContactService,private currentuserinfo:CurrentuserinfoService) { }
  res;
  arr=[1,2,3,4,5,6];
  userinfo;
  addtocart(selected_product,user_id=1){
    console.log("testing:"+user_id);
    var newcartproduct = {"user_id":user_id,"product_id":selected_product};
    console.log(newcartproduct);
    this.contactservice.addtocart(newcartproduct)
    .subscribe(res => {
      this.res = res;
      console.log(this.res);
      console.log("status is"+ this.res.status);
      if(this.res.status=='200')
      {
         alert('added to cart');
      }
      else if(this.res.status=='409')
      {
         alert('product is already in cart');
      }
    });
  }

  ngOnInit() {
    
    this.contactservice.productslist()
    .subscribe(products=>{
      this.products = products;
      console.log(products);
    });
    this.currentuserinfo.userinfo
    .subscribe(userinfo=>{this.userinfo = userinfo});
    console.log('hey from products');
    console.log(this.userinfo);
    
  }

}
