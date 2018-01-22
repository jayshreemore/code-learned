import { Component, OnInit } from '@angular/core';
import {ContactService} from '../contact.service';
import {Router} from '@angular/router';
import {UserService} from '../user.Service';

@Component({
  selector: 'app-contacts',
  templateUrl: './contacts.component.html',
  styleUrls: ['./contacts.component.css'],
  providers:[ContactService]
})
export class ContactsComponent implements OnInit {
  contacts;
  res;
  name;
  contact;
  constructor(private contactservice:ContactService,private router:Router,private userservice:UserService) { }

  showproducts(){
    this.router.navigate(['/productslist']);
  }

  addcontact(){
    var name = this.name;
    var contact = this.contact;
   // alert(name);
    var newcontact = {"name":name,"contact":contact};
      this.contactservice.addcontact(newcontact)
      .subscribe( res => {
        this.res = res;
        console.log(this.contacts.result);
        this.contacts.result.push({"name":name,contact:"contact"});
        console.log("I CANT SEE DATA HERE: ", this.res);
      });
  

  }

  deleterecord(id){
    var contacts = this.contacts;
    //alert(id);
    this.contactservice.deletecontact(id)
    .subscribe( res => {
      this.res = res;
      console.log("I CANT SEE DATA HERE: ", this.res);
      console.log("length is:"+contacts.result.length);
      for (var i = 0; i < contacts.result.length; i++) {
        if (contacts.result[i].id === id) {
          contacts.result.splice(i, 1);
          break;
        }
      }
    });

  }

  ngOnInit() {
        this.contactservice.getContacts()
        .subscribe( contacts => {
          this.contacts =contacts;
          /*
          if(contacts.status == "403")
          {
            this.router.navigate(['/']);
          }
          */
          console.log(contacts.status);
        });
   
  }

}
