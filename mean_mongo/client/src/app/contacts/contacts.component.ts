import { Component, OnInit } from '@angular/core';
import {ContactService} from '../contact.service';
import {Router} from '@angular/router';

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
  constructor(private contactservice:ContactService,private router:Router) { }

  addcontact(){
    var name = this.name;
    var contact = this.contact;
   // alert(name);
    var newcontact = {"name":name,"contact":contact};
      this.contactservice.addcontact(newcontact)
      .subscribe( res => {
        this.res = res;
        this.contacts.result.push({"newcontact":newcontact});
        console.log("I CANT SEE DATA HERE: ", this.res);
      });
  

  }

  deleterecord(id){
    var contacts = this.contacts;
    alert(id);
    this.contactservice.deletecontact(id)
    .subscribe( res => {
      this.res = res;
      console.log("I CANT SEE DATA HERE: ", this.res);
      for (var i = 0; i < contacts.length; i++) {
        if (contacts[i].id === id) {
          contacts.splice(i, 1);
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
