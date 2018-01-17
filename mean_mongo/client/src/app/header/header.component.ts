import { Component, OnInit } from '@angular/core';
import {ContactService} from '../contact.service';
import {Router} from '@angular/router';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css'],
  providers:[ContactService]
})
export class HeaderComponent implements OnInit {
  logout_user;
  constructor(private contactservice:ContactService,private router:Router) { }

  logout(){
    alert('hi');
    this.contactservice.logout()
    .subscribe( logout_user => {
      this.logout_user =logout_user;
      console.log(logout_user);
      if(logout_user.status=="200")
      {
        this.router.navigate(['/'])
      }
    });
  }
  ngOnInit() {
  }

}
