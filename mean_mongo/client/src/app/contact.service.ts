import { Injectable } from '@angular/core';
import {Http,Headers} from '@angular/http';
import 'rxjs/add/operator/map';


@Injectable()
export class ContactService {

  constructor(private http:Http) { }

  login(userCredentials)
  {
    var headers = new Headers();
    headers.append('Content-Type','application/json');
    return this.http.post('http://localhost:3000/api/login',userCredentials,{headers:headers})
    .map(res=>res.json());
  }

  register(newuser){
    var headers = new Headers();
    headers.append('Content-Type','application/json');
    return this.http.post('http://localhost:3000/api/register',newuser,{headers:headers})
    .map(res => res.json());
  }

  productslist(){
    return this.http.get('http://localhost:3000/api/product_list')
    .map(res=>res.json());
  }

  
  logout()
  {
    return this.http.get('http://localhost:3000/api/logout')
    .map(res=>res.json());
  }

  getContacts()
  {
    return this.http.get('http://localhost:3000/api/contacts')
    .map(res=>res.json());
  }

  addcontact(newContact)
  {
    var headers = new Headers();
    headers.append('Content-Type','application/json');
    return this.http.post('http://localhost:3000/api/addcontact',newContact,{headers:headers})
    .map(res => res.json());
  }

  deletecontact(id)
  {
    return this.http.delete('http://localhost:3000/api/deletcontact/'+id)
    .map(res => res.json());
  }

  addtocart(newcartproduct)
  {
    var headers = new Headers();
    headers.append('content-Type','application/json');
    return this.http.post('http://localhost:3000/api/addtocart',newcartproduct,{headers:headers})
    .map(res => res.json());
  }

  get_cart_products(user_id){
    var headers = new Headers();
    headers.append('content-Type','application/json');
    return this.http.post('http://localhost:3000/api/get_cart_products',user_id,{headers:headers})
    .map(res=>res.json());
  }
  removefromcart(id)
  {
    return this.http.delete('http://localhost:3000/api/removefromcart/'+id)
    .map(res => res.json());
  }

}
