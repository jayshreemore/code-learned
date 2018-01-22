import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot } from '@angular/router';
import { Observable } from 'rxjs/Observable';
import {UserService} from './user.Service';
import {Router} from '@angular/router';

@Injectable()
export class AuthGuard implements CanActivate {
  loggedIn;
  constructor(private userservice:UserService,private router:Router){
   
  }
  canActivate(
    
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean> | Promise<boolean> | boolean {
      

      this.userservice.isLoggedIn()
    .subscribe(res =>{this.loggedIn = res;})
    if(this.loggedIn)
    {  
      return this.loggedIn;
    }
    else
    {
      console.log('here');
      this.router.navigate(['/']);
      return this.loggedIn;
    }

  }
}
