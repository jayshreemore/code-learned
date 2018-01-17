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

}
